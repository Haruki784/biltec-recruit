<?php

/**
 * カスタム投稿タイプ「お知らせ（news）」の登録
 *
 * もともと Custom Post Type UI で作成していたが、インポートの不具合を避けるため
 * テーマ側のコードで直接登録する方式に変更している。
 * 設定値（スラッグ・アーカイブ・対応機能など）は CPT UI 時の内容を踏襲。
 *
 * - アーカイブ: /news/        （archive-news.php）
 * - 個別ページ: /news/{slug}/ （single-news.php）
 * - 分類: news_category（お知らせカテゴリー）と連携
 *
 * ※ お知らせカテゴリー（news_category）は引き続き CPT UI 側で登録されており、
 *   object_types に "news" が指定されているため、この投稿タイプに自動で紐づく。
 */
function theme_register_news_post_type()
{
    $labels = array(
        'name'                  => 'お知らせ',
        'singular_name'         => 'お知らせ',
        'menu_name'             => 'お知らせ',
        'name_admin_bar'        => 'お知らせ',
        'all_items'             => 'お知らせ一覧',
        'add_new'               => '新規追加',
        'add_new_item'          => 'お知らせを追加',
        'edit_item'             => 'お知らせを編集',
        'new_item'              => '新しいお知らせ',
        'view_item'             => 'お知らせを表示',
        'view_items'            => 'お知らせ一覧を表示',
        'search_items'          => 'お知らせを検索',
        'not_found'             => 'お知らせが見つかりません',
        'not_found_in_trash'    => 'ゴミ箱にお知らせはありません',
        'archives'              => 'お知らせアーカイブ',
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_rest'        => true,
        'rest_base'           => 'news',
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-megaphone',
        'capability_type'     => 'post',
        'hierarchical'        => false,
        'has_archive'         => 'news',
        'rewrite'             => array('slug' => 'news', 'with_front' => true),
        'query_var'           => true,
        'exclude_from_search' => false,
        'can_export'          => true,
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt'),
    );

    register_post_type('news', $args);
}
add_action('init', 'theme_register_news_post_type');
