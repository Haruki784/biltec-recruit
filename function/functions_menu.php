<?php

/**
 * メニュー（チョク採テンプレート共通）
 *
 * メニューは WordPress 標準のメニューで編集する（外観 → カスタマイズ → メニュー、または 外観 → メニュー）。
 * 位置は2つ：
 *   global … ヘッダー（PC のドロップダウン）・SP メニュー・フッターの列
 *   footer … フッター右の太字のリンク
 *
 * global の組み方（2階層まで）：
 *   - 子のない1段目 … そのままリンク（例：HOME）。フッターには出さない
 *   - 子のある1段目 … 見出し（ドロップダウン）。URL を「#」以外にすると、ヘッダーと SP メニューで子の先頭に
 *                     一覧ページへのリンクを出す。表示名は「タイトル属性」、空なら「見出し＋一覧」
 *   - 子に URL「#job」のカスタムリンク … 投稿タイプ job の投稿を並び順（menu_order）どおりに展開する
 *                     （表示名は投稿の nav_label 項目、なければタイトル）。新しい職種を足してもメニューの編集はいらない
 *
 * 位置にメニューが割り当てられていないときは theme_menu_defaults() の内容で表示する。
 * テーマを有効にしたとき（after_switch_theme）、割り当てのない位置には初期値からメニューを作って割り当てる。
 * 案件ごとに変えるのは theme_menu_defaults() だけ。
 */

add_action('after_setup_theme', function () {
    register_nav_menus(array(
        'global' => 'グローバルメニュー（ヘッダー・SPメニュー・フッター）',
        'footer' => 'フッター右の太字リンク',
    ));
});

/**
 * メニューの初期値。URL はサイト内のパス、子の '#job' は投稿の自動展開。
 * 1段目：array('label', 'url', 'index' => 一覧リンクの表示名, 'children' => array(array(表示名, URL), ...))
 */
function theme_menu_defaults()
{
    return array(
        'global' => array(
            array('label' => 'HOME', 'url' => '/'),
            array('label' => '会社を知る', 'url' => '#', 'children' => array(
                array('わたしたちの想い', '/philosophy/'),
                array('事業紹介', '/business/'),
                array('会社概要', '/company/'),
            )),
            array('label' => '仕事を知る', 'url' => '#', 'children' => array(
                array('先輩インタビュー', '/interview/'),
                array('手すりができるまで', '/process/'),
                array('教育・キャリアパス', '/career/'),
            )),
            array('label' => '募集職種', 'url' => '/job/', 'index' => '募集職種一覧', 'children' => array(
                array('募集要項の投稿（自動）', '#job'),
            )),
        ),
        'footer' => array(
            array('label' => '募集要項', 'url' => '/job/'),
            array('label' => 'エントリーフォーム', 'url' => '/entry/'),
            array('label' => 'プライバシーポリシー', 'url' => '/privacy/'),
        ),
    );
}

/**
 * 子の URL が「#投稿タイプ名」なら、その投稿のリンクの配列を返す。違えば null。
 */
function theme_menu_expand($url)
{
    if (!preg_match('/^#([a-z0-9_\-]+)$/', (string) $url, $m) || !post_type_exists($m[1])) {
        return null;
    }
    $links = array();
    foreach (get_posts(array('post_type' => $m[1], 'numberposts' => -1, 'orderby' => 'menu_order', 'order' => 'ASC')) as $p) {
        $links[] = array('label' => theme_field('nav_label', $p->post_title, $p->ID), 'url' => get_permalink($p));
    }
    return $links;
}

/**
 * 1段目の項目をテンプレートで使う形にそろえる
 * 返す形：array('label', 'url'（子がないときのリンク先）, 'index' => 一覧リンク or null, 'children' => array(array('label', 'url'), ...))
 */
function theme_menu_item($label, $url, $index_label, $children)
{
    $links = array();
    foreach ($children as $child) {
        $expanded = theme_menu_expand($child['url']);
        if ($expanded !== null) {
            $links = array_merge($links, $expanded);
        } else {
            $links[] = $child;
        }
    }
    $has_url = $url !== '' && $url !== '#';
    return array(
        'label'    => $label,
        'url'      => $has_url ? $url : '',
        'index'    => $links && $has_url ? array('label' => $index_label !== '' ? $index_label : $label . '一覧', 'url' => $url) : null,
        'children' => $links,
    );
}

/**
 * メニューの位置（global / footer）の項目を、1段目の配列で返す
 */
function theme_menu($location)
{
    static $cache = array();
    if (isset($cache[$location])) {
        return $cache[$location];
    }

    $menu      = array();
    $locations = get_nav_menu_locations();
    $items     = !empty($locations[$location]) ? wp_get_nav_menu_items($locations[$location]) : false;

    if ($items) {
        // WordPress のメニュー（2階層まで）
        $children = array();
        foreach ($items as $item) {
            if ($item->menu_item_parent) {
                // サイト内パス（/company/ など）で登録したリンクは theme_link() で home_url を付ける
                $children[$item->menu_item_parent][] = array('label' => $item->title, 'url' => theme_link($item->url));
            }
        }
        foreach ($items as $item) {
            if (!$item->menu_item_parent) {
                $menu[] = theme_menu_item($item->title, theme_link($item->url),trim((string) $item->attr_title), $children[$item->ID] ?? array());
            }
        }
    } else {
        // 割り当てがなければ初期値
        $defaults = theme_menu_defaults();
        foreach ($defaults[$location] ?? array() as $d) {
            $children = array();
            foreach ($d['children'] ?? array() as $c) {
                $children[] = array('label' => $c[0], 'url' => strpos($c[1], '#') === 0 ? $c[1] : theme_link($c[1]));
            }
            $url    = $d['url'] ?? '#';
            $menu[] = theme_menu_item($d['label'], $url === '#' ? '#' : theme_link($url), $d['index'] ?? '', $children);
        }
    }

    return $cache[$location] = $menu;
}

/**
 * ヘッダー・SPメニュー・フッターの列（位置 global）
 */
function theme_nav()
{
    return theme_menu('global');
}

/**
 * テーマを有効にしたとき、割り当てのない位置に初期値からメニューを作る。リンクはサイト内パスのカスタムリンクで登録する。
 * 上書きアップロードで有効化が起きないときは、下の admin_init で管理画面を開いたときに作る（WP-CLI なら `wp eval 'theme_install_menus();'`）。
 */
function theme_install_menus()
{
    $locations = get_nav_menu_locations();
    $names     = get_registered_nav_menus();
    foreach (theme_menu_defaults() as $location => $items) {
        if (!empty($locations[$location]) || !isset($names[$location])) {
            continue;
        }
        $name = preg_replace('/（.*$/u', '', $names[$location]);
        $menu = wp_get_nav_menu_object($name);
        $menu_id = $menu ? $menu->term_id : wp_create_nav_menu($name);
        if (is_wp_error($menu_id)) {
            continue;
        }
        if (!$menu) {
            $order = 1;
            foreach ($items as $d) {
                $parent = wp_update_nav_menu_item($menu_id, 0, array(
                    'menu-item-title'     => $d['label'],
                    'menu-item-url'       => $d['url'] ?? '#', // サイト内パスのまま登録（ドメインや https 化で切れない）
                    'menu-item-attr-title' => $d['index'] ?? '',
                    'menu-item-type'      => 'custom',
                    'menu-item-status'    => 'publish',
                    'menu-item-position'  => $order++,
                ));
                foreach ($d['children'] ?? array() as $c) {
                    wp_update_nav_menu_item($menu_id, 0, array(
                        'menu-item-title'     => $c[0],
                        'menu-item-url'       => $c[1],
                        'menu-item-parent-id' => is_wp_error($parent) ? 0 : $parent,
                        'menu-item-type'      => 'custom',
                        'menu-item-status'    => 'publish',
                        'menu-item-position'  => $order++,
                    ));
                }
            }
        }
        $locations[$location] = $menu_id;
    }
    set_theme_mod('nav_menu_locations', $locations);
}
add_action('after_switch_theme', 'theme_install_menus');

/**
 * 同じ名前のテーマを上書きしたときは「有効化」が起きないので、管理画面（カスタマイズを含む）を開いたときに1回だけ作る。
 * 作ったあとにメニューを消しても、もう一度は作らない（theme_menus_installed で覚える）。
 */
add_action('admin_init', function () {
    if (get_option('theme_menus_installed') || !current_user_can('edit_theme_options')) {
        return;
    }
    theme_install_menus();
    update_option('theme_menus_installed', 1);
});
