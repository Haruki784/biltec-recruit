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
 * 未入力なら page-fields/*.php に書いた初期値を返す（$default を渡したときはそちらを優先）。
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
 * TOP（共通タブ）の入力値
 */
function theme_option($name)
{
    return theme_field($name, null, theme_top_id());
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
 * TOP 用固定ページ（slug: top）の ID。共通パーツの入力値はここに持たせる。
 */
function theme_top_id()
{
    static $id = null;
    if ($id === null) {
        $page = get_page_by_path('top');
        $id = $page ? (int) $page->ID : 0;
    }
    return $id;
}

/**
 * 会社情報（フッター・プライバシーポリシーで共用）
 */
function theme_company()
{
    // 値は TOP の「共通：会社情報」タブ（page-fields/top.php）
    return array(
        'name'      => theme_option('company_name'),
        'name_en'   => theme_option('company_name_en'),
        'zip'       => theme_option('company_zip'),
        'address'   => theme_option('company_address'),
        'building'  => theme_option('company_building'),
    );
}

/**
 * チョク採フォーム（iframe）の src（TOP の「共通：フォーム」タブ）。エントリーページで埋め込みに使う。
 * $type：'entry' か 'casual'。カジュアル面談が空ならエントリーと同じURL。
 */
function theme_form_src($type = 'entry')
{
    if ($type === 'casual') {
        $casual = theme_option('form_casual_url');
        if ($casual) {
            return $casual;
        }
    }
    return theme_option('form_entry_url');
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
 * テキストエリアの値を、エスケープして改行を <br> にして返す（前後の空白は取る）
 */
function theme_text($value)
{
    return nl2br(esc_html(trim((string) $value)));
}

/**
 * ナビゲーション（ヘッダー・ドロワー・フッターで共用）
 * 募集職種の子は CPT job から自動で作る。
 */
function theme_nav()
{
    $jobs = array();
    foreach (get_posts(array('post_type' => 'job', 'numberposts' => -1, 'orderby' => 'menu_order', 'order' => 'ASC')) as $job) {
        $jobs[] = array('label' => theme_field('nav_label', $job->post_title, $job->ID), 'url' => get_permalink($job));
    }

    return array(
        array('label' => '会社を知る', 'children' => array(
            array('label' => 'わたしたちの想い', 'url' => home_url('/philosophy/')),
            array('label' => '事業紹介', 'url' => home_url('/business/')),
            array('label' => '会社概要', 'url' => home_url('/company/')),
        )),
        array('label' => '仕事を知る', 'children' => array(
            array('label' => '先輩インタビュー', 'url' => home_url('/interview/')),
            array('label' => '手すりができるまで', 'url' => home_url('/process/')),
            array('label' => '教育・キャリアパス', 'url' => home_url('/career/')),
        )),
        array('label' => '募集職種', 'children' => $jobs),
    );
}

/**
 * 共通の矢印アイコン（›）
 */
function theme_chevron()
{
    return '<svg class="icon-chevron" width="8" height="12" viewBox="0 0 8 12" aria-hidden="true"><path d="M1.5 1l5 5-5 5" fill="none" stroke="currentColor" stroke-width="1.6"/></svg>';
}
