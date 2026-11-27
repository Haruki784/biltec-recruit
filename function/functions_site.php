<?php

/**
 * ビルテック案件用：カスタム投稿・共通データ・入力値の取得
 */

/**
 * カスタム投稿「募集要項（job）」「先輩インタビュー（interview）」
 * - /job/        一覧（archive-job.php。デザイン待ち）
 * - /job/<slug>/ 詳細（single-job.php）
 * - /interview/  一覧（archive-interview.php）
 */
function theme_register_site_post_types()
{
    $common = array(
        'public'        => true,
        'show_in_rest'  => true,
        'menu_position' => 5,
        'capability_type' => 'post',
        'hierarchical'  => false,
        'query_var'     => true,
        'can_export'    => true,
    );

    register_post_type('job', $common + array(
        'labels'      => array(
            'name'          => '募集要項',
            'singular_name' => '募集要項',
            'add_new_item'  => '募集要項を追加',
            'edit_item'     => '募集要項を編集',
        ),
        'menu_icon'   => 'dashicons-id',
        'has_archive' => 'job',
        'rewrite'     => array('slug' => 'job', 'with_front' => false),
        'supports'    => array('title', 'thumbnail', 'page-attributes', 'custom-fields'),
    ));

    register_post_type('interview', $common + array(
        'labels'      => array(
            'name'          => '先輩インタビュー',
            'singular_name' => '先輩インタビュー',
            'add_new_item'  => 'インタビューを追加',
            'edit_item'     => 'インタビューを編集',
        ),
        'menu_icon'   => 'dashicons-groups',
        'has_archive' => 'interview',
        'rewrite'     => array('slug' => 'interview', 'with_front' => false),
        'supports'    => array('title', 'thumbnail', 'excerpt', 'custom-fields'),
    ));
}
add_action('init', 'theme_register_site_post_types');

/**
 * 入力値を取得する。ACF があれば get_field、なければ投稿メタ。
 * カスタム投稿用（固定ページは theme_pf()）。未入力なら post-fields/*.php に書いた初期値を返す（$default を渡したときはそちらを優先）。
 * group 項目は配列で返し、未入力の子項目は初期値で埋める。
 */
function theme_field($name, $default = null, $post_id = null)
{
    if ($post_id === null) {
        $post_id = get_the_ID();
    }
    if ($default === null) {
        $default = theme_field_default($name);
    }
    if (function_exists('get_field')) {
        $value = get_field($name, $post_id);
    } else {
        $value = $post_id ? get_post_meta($post_id, $name, true) : '';
    }

    if (is_array($default)) {
        $value = is_array($value) ? $value : array();
        foreach ($default as $key => $sub_default) {
            if (!isset($value[$key]) || $value[$key] === '' || $value[$key] === null || $value[$key] === false) {
                $value[$key] = $sub_default;
            }
        }
        return $value;
    }

    return ($value === '' || $value === null || $value === false) ? $default : $value;
}

/**
 * 画像項目（添付ファイルID）を <img> で出す。未設定ならテーマ内の画像を出す。
 * $fallback は img/ からのパス、$attr は width / height / alt / loading など。
 */
function theme_image($attachment_id, $fallback, $attr = array(), $size = 'large')
{
    $attr = array_merge(array('alt' => '', 'loading' => 'lazy'), $attr);
    if ($attachment_id) {
        return wp_get_attachment_image((int) $attachment_id, $size, false, $attr);
    }
    $html = '<img src="' . esc_url(theme_img($fallback)) . '"';
    foreach ($attr as $key => $val) {
        $html .= ' ' . esc_attr($key) . '="' . esc_attr($val) . '"';
    }
    return $html . '>';
}

/**
 * 応募ボタンの飛び先（エントリーページ）。カジュアル面談は ?type=casual を付ける。
 * 別ページにするか同じフォームかは未定（指示書 Q5）。決まったらここだけ直す。
 */
function theme_entry_url($type = 'entry')
{
    $url = home_url('/entry/');
    return $type === 'casual' ? add_query_arg('type', 'casual', $url) : $url;
}

/**
 * テーマ内の画像URL
 */
function theme_img($path)
{
    return get_stylesheet_directory_uri() . '/img/' . ltrim($path, '/');
}

/**
 * テーマ内の CSS / JS の URL。更新日時を ?ver= に付けて、ブラウザのキャッシュで古いファイルが残らないようにする。
 * 例：theme_asset('add.css')、theme_asset('assets/pages/top.css')
 */
function theme_asset($path)
{
    $path = ltrim($path, '/');
    $file = get_stylesheet_directory() . '/' . $path;
    $url  = get_stylesheet_directory_uri() . '/' . $path;
    return file_exists($file) ? add_query_arg('ver', filemtime($file), $url) : $url;
}

/**
 * テキストエリアの値を、エスケープして改行を <br> にして返す（前後の空白は取る）。カスタム投稿の項目（theme_field()）用。
 * 固定ページの項目（theme_pf()）は改行がすでに <br> になっているので、<br> を含む値は theme_pf_kses()（改行・強調タグだけ許可）で出す。
 */
function theme_text($value)
{
    $value = trim((string) $value);
    if (stripos($value, '<br') !== false) {
        return theme_pf_kses($value);
    }
    return nl2br(esc_html($value));
}

/**
 * 入力された URL をリンク先にする。「/job/」のようなサイト内のパスは home_url を付け、https:// などはそのまま返す。
 * 空なら $fallback を返す。
 */
function theme_link($url, $fallback = '')
{
    $url = trim((string) $url);
    if ($url === '') {
        return $fallback;
    }
    if ($url[0] === '/' && strpos($url, '//') !== 0) {
        return home_url($url);
    }
    return $url;
}

/**
 * 共通の矢印アイコン（›）
 */
function theme_chevron()
{
    return '<svg class="icon-chevron" width="8" height="12" viewBox="0 0 8 12" aria-hidden="true"><path d="M1.5 1l5 5-5 5" fill="none" stroke="currentColor" stroke-width="1.6"/></svg>';
}
