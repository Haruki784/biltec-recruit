<?php

/**
 * 固定ページの文言・画像を管理画面（ACF）で編集できるようにする仕組み（チョク採共通・基準の実装は内野建設）
 *
 * - 各ページの項目は function/page-fields/<スラッグ>.php に「ラベル・種類・今の文言（初期値）」で書く
 *   ここが文言の置き場所。テンプレートには文言を直書きしない
 * - ACF は初期値（default_value）を編集画面に表示し、まだ保存していない項目は初期値を返す
 *   → 管理画面で変えるまでは今の表示のまま。連番の行（faq_1 …）は1つ目の欄を空にして保存すると消える
 * - テンプレートでは theme_pf('mv_title') / theme_pf_img(theme_pf('mv_img_pc')) で値を取り出す
 * - 全ページ共通のパーツ（ヘッダー・CTA など）は top.php の common_*（theme_common('名前')）、会社情報は company.php の company_*（theme_company()）
 * - カスタム投稿（募集要項・インタビュー）の項目は別の仕組み（function/functions_post_fields.php と post-fields/*.php）
 *
 * 項目の書き方（page-fields/*.php の配列）：
 *   ['tab', 'MV']                                         … 管理画面のタブ
 *   ['message', '説明文']                                  … 管理画面に出す説明（ビルテックで追加）
 *   ['mv_title', 'タイトル', 'text', '会社を知る / 企業情報'] … text / textarea（改行はそのまま <br> になる）
 *   ['mv_img_pc', 'MV画像（PC）', 'image', 'about/kigyou_main.webp'] … 初期値はテーマ内の画像パス
 *   ['feature_1', '横並び 1', 'group', [ …上と同じ形の子項目… ]]
 *   5つ目に文字列を書くと、入力欄の下の説明になる（ビルテックで追加）
 */

/**
 * ページ別の項目定義（スラッグ => 定義の配列）
 */
function theme_page_fields_config()
{
    static $config = null;
    if ($config !== null) {
        return $config;
    }
    $config = [];
    foreach (glob(get_template_directory() . '/function/page-fields/*.php') as $file) {
        $config[basename($file, '.php')] = require $file;
    }
    return $config;
}

/**
 * スラッグ → 固定ページID
 */
function theme_page_id($slug)
{
    static $ids = [];
    if (!isset($ids[$slug])) {
        $page = get_page_by_path($slug);
        $ids[$slug] = $page ? $page->ID : 0;
    }
    return $ids[$slug];
}

/**
 * 今表示しているページのスラッグ（TOPは 'top'）
 */
function theme_current_page_slug()
{
    if (is_front_page()) {
        return 'top';
    }
    $post = get_queried_object();
    return ($post instanceof WP_Post) ? $post->post_name : '';
}

/**
 * 定義1件を ACF のフィールド配列にする
 */
function theme_pf_to_acf($def, $prefix)
{
    list($name, $label, $type) = $def;
    $value = $def[3] ?? '';
    $field = ['key' => $prefix . '_' . $name, 'name' => $name, 'label' => $label, 'type' => $type, 'instructions' => $def[4] ?? ''];
    if ($type === 'tab') {
        return ['key' => $prefix . '_tab_' . md5($name), 'label' => $name, 'type' => 'tab', 'placement' => 'top'];
    }
    if ($type === 'message') {
        return ['key' => $prefix . '_msg_' . md5($name), 'label' => '', 'type' => 'message', 'message' => $name];
    }
    if ($type === 'group') {
        $field['layout'] = 'block';
        $field['sub_fields'] = array_map(function ($sub) use ($field) {
            return theme_pf_to_acf($sub, $field['key']);
        }, array_values(array_filter($value, 'theme_pf_is_field')));
        return $field;
    }
    if ($type === 'image') {
        $field['return_format'] = 'id';
        $field['preview_size']  = 'medium';
        // 説明：初期画像があれば「今の画像」を案内。初期画像がなく説明を書いていれば説明だけ（SP 用の任意の画像など）
        $field['instructions']  = $value !== ''
            ? trim(($def[4] ?? '') . ' 未設定のときは今の画像（' . $value . '）を表示します')
            : (($def[4] ?? '') !== '' ? $def[4] : '未設定のときは表示しません');
        return $field;
    }
    if ($type === 'textarea') {
        $field['rows'] = 3;
        $field['new_lines'] = 'br';
    }
    $field['default_value'] = $value;
    return $field;
}

/**
 * 値を持つ項目か（tab・message は除く）
 */
function theme_pf_is_field($def)
{
    return !in_array($def[0], ['tab', 'message'], true);
}

/**
 * 定義から ACF のフィールドグループを登録する（ページごとに1つ）
 */
function theme_register_page_fields()
{
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    foreach (theme_page_fields_config() as $slug => $defs) {
        $page_id = theme_page_id($slug);
        if (!$page_id) {
            continue;
        }
        $prefix = 'field_pf_' . $slug;
        acf_add_local_field_group([
            'key'            => 'group_pf_' . $slug,
            'title'          => 'ページの文言・画像',
            'fields'         => array_map(function ($def) use ($prefix) {
                // tab の定義は ['tab', 'ラベル']、message は ['message', '説明文']
                if ($def[0] === 'tab' || $def[0] === 'message') {
                    return theme_pf_to_acf([$def[1], $def[1], $def[0]], $prefix);
                }
                return theme_pf_to_acf($def, $prefix);
            }, $defs),
            'location'       => [[['param' => 'page', 'operator' => '==', 'value' => (string) $page_id]]],
            'position'       => 'acf_after_title',
            'hide_on_screen' => ['the_content'],
        ]);
    }
}
add_action('acf/init', 'theme_register_page_fields');

/**
 * 定義を名前で探す
 */
function theme_pf_def($slug, $name)
{
    $defs = theme_page_fields_config()[$slug] ?? [];
    foreach ($defs as $def) {
        if ($def[0] === $name) {
            return $def;
        }
    }
    return null;
}

/**
 * 文言を取り出す。未入力なら定義の初期値。group は子の配列（子も未入力なら初期値）を返す
 * 例：theme_pf('mv_title') / theme_pf('feature_1')['title'] / theme_pf('mv_title', 'about')（別ページの値）
 */
function theme_pf($name, $slug = null)
{
    $slug = $slug ?: theme_current_page_slug();
    $def  = theme_pf_def($slug, $name);
    if (!$def) {
        return '';
    }
    $page_id = theme_page_id($slug);
    // ACF が使えないとき・固定ページがないときは、定義の初期値で表示する
    $use_acf = $page_id && function_exists('get_field');
    // 名前ではなくキーで取る（一度も保存していないページだと、名前では初期値が返らないため）
    $value   = $use_acf ? get_field('field_pf_' . $slug . '_' . $name, $page_id) : null;
    if ($def[2] === 'group') {
        $out = [];
        foreach (array_filter($def[3], 'theme_pf_is_field') as $sub) {
            $out[$sub[0]] = theme_pf_pick($sub, $use_acf, is_array($value) ? ($value[$sub[0]] ?? null) : null);
        }
        return $out;
    }
    return theme_pf_pick($def, $use_acf, $value);
}

/**
 * ACF の値か初期値かを選ぶ
 * 文言は ACF の値をそのまま使う（未保存なら ACF が初期値を返す。空にして保存したら空＝その行を消せる）
 * 画像だけは、未選択なら初期画像（テーマ内）を使う
 */
function theme_pf_pick($def, $use_acf, $value)
{
    if (!$use_acf || ($def[2] === 'image' && !$value)) {
        return theme_pf_default($def);
    }
    return $value === null || $value === false ? '' : $value;
}

/**
 * 連番の group（faq_1, faq_2 …）をまとめて取り出す。1つ目の子項目が空の行は出さない
 * 例：foreach (theme_pf_list('faq') as $faq) { $faq['q'] … }
 */
function theme_pf_list($prefix, $slug = null)
{
    $slug = $slug ?: theme_current_page_slug();
    $rows = [];
    foreach (theme_page_fields_config()[$slug] ?? [] as $def) {
        if (($def[2] ?? '') === 'group' && preg_match('/^' . preg_quote($prefix, '/') . '_\d+$/', $def[0])) {
            $row = theme_pf($def[0], $slug);
            if (trim(strip_tags((string) reset($row))) !== '' || is_numeric(reset($row))) {
                $rows[] = $row;
            }
        }
    }
    return $rows;
}

/**
 * 連番の group 定義を作る（page-fields/*.php 用）
 * theme_pf_rows('faq', 'よくある質問', [['q','質問','text'], ['a','回答','textarea']], [[ 'q初期値', 'a初期値' ], …], 6)
 * $count が初期値の数より多いときは、空の予備枠を作る（入力すると表示される）
 */
function theme_pf_rows($prefix, $label, $subs, $defaults, $count = null)
{
    $count = max($count ?? 0, count($defaults));
    $out = [];
    for ($i = 0; $i < $count; $i++) {
        $out[] = [$prefix . '_' . ($i + 1), $label . ' ' . ($i + 1) . '（1つ目の欄が空なら表示しない）', 'group', array_map(function ($sub, $j) use ($defaults, $i) {
            return [$sub[0], $sub[1], $sub[2], $defaults[$i][$j] ?? ''];
        }, $subs, array_keys($subs))];
    }
    return $out;
}

/**
 * 全ページ共通パーツの文言（トップページの「共通：〜」タブで編集。項目は page-fields/top.php の common_*）
 */
function theme_common($name)
{
    return theme_pf('common_' . $name, 'top');
}

/**
 * 会社情報（会社概要ページの「会社基本情報」タブで編集）。フッター・プライバシーポリシーで共通に使う
 */
function theme_company()
{
    static $c = null;
    if ($c === null) {
        $tel = theme_pf('company_tel', 'company');
        $c = [
            'name'     => theme_pf('company_name', 'company'),
            'name_en'  => theme_pf('company_name_en', 'company'),
            'zip'      => theme_pf('company_zip', 'company'),
            'address'  => theme_pf('company_address', 'company'),
            'building' => theme_pf('company_building', 'company'),
            'ceo'      => theme_pf('company_ceo', 'company'),
            'tel'      => $tel,
            'tel_link' => 'tel:' . preg_replace('/\D/', '', $tel),
            'mail'     => theme_pf('company_mail', 'company'),
        ];
    }
    return $c;
}

/**
 * チョク採フォーム（iframe）の src（トップページの「共通：フォーム」タブ）。$type：'entry' か 'casual'。
 * カジュアル面談が空ならエントリーと同じURL。
 */
function theme_form_src($type = 'entry')
{
    if ($type === 'casual' && theme_common('form_casual_url')) {
        return theme_common('form_casual_url');
    }
    return theme_common('form_entry_url');
}

/**
 * 定義の初期値（textarea の改行は ACF と同じく <br> にする。画像はテーマ内のパス）
 */
function theme_pf_default($def)
{
    $value = $def[3] ?? '';
    if ($def[2] === 'textarea') {
        return nl2br($value, false);
    }
    return $value; // 画像は theme_pf_img() で URL にする
}

/**
 * 画像のURL。ACF で画像を選んでいればその画像、なければテーマ内の初期画像
 * $value は theme_pf() で取った値（添付ファイルID または初期のパス）
 */
function theme_pf_img($value, $size = 'full')
{
    if (is_numeric($value) && $value) {
        $url = wp_get_attachment_image_url((int) $value, $size);
        if ($url) {
            return $url;
        }
    }
    return $value ? theme_img($value) : '';
}

/**
 * 画像の <img>（ビルテックで追加）。選んだ画像なら srcset 付き、初期画像ならテーマ内の画像。
 * $attr は width / height / alt / loading など
 */
function theme_pf_image($value, $attr = [], $size = 'large')
{
    if (is_numeric($value) && $value) {
        return theme_image((int) $value, '', $attr, $size);
    }
    return $value ? theme_image(0, $value, $attr, $size) : '';
}

/**
 * SP 用画像の URL（ビルテックで追加。<source media="(max-width: 768px)"> に使う）。
 * SP を選んでいればその画像。SP が未選択で PC だけ選んでいるときは ''（PC の画像を SP でも出す）。どちらも未選択なら初期の SP 画像
 */
function theme_pf_sp($pc_value, $sp_value)
{
    if (is_numeric($sp_value) && $sp_value) {
        return theme_pf_img($sp_value);
    }
    if (is_numeric($pc_value) && $pc_value) {
        return '';
    }
    return theme_pf_img($sp_value);
}

/**
 * textarea の値を1行ずつの配列にする（ビルテックで追加。1行ずつ span で囲む見出しなどに使う）
 */
function theme_pf_lines($value)
{
    return array_values(array_filter(array_map('trim', preg_split('/<br\s*\/?>|\R/u', (string) $value)), 'strlen'));
}

/**
 * リンク欄の値をURLにする（/work/ のようなサイト内パスは home_url を付ける）
 */
function theme_pf_url($value)
{
    return (is_string($value) && strpos($value, '/') === 0) ? home_url($value) : $value;
}

/**
 * 文言を出すときの許可タグ（改行・強調だけ）
 */
function theme_pf_kses($text)
{
    return wp_kses($text, ['br' => ['class' => []], 'em' => [], 'strong' => [], 'small' => []]);
}
