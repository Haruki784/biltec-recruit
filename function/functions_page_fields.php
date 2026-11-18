<?php

/**
 * 入力項目（ACF）の仕組み
 *
 * - 項目は page-fields/<名前>.php に配列で書く（1ファイル＝1つのフィールドグループ）。
 * - ここで ACF に登録し、同時に「項目名 → 初期値」の一覧を作る。
 * - テンプレートでは theme_field('項目名') で取り出す。未入力なら初期値が返る。
 *   文言はテンプレートに直書きせず、page-fields/*.php の default に書く。
 * - ACF が無効でも初期値で表示されるので、ページは崩れない。
 *
 * 項目の書き方（'fields' の中）：
 *   'mv_title' => array('label' => 'キャッチ', 'type' => 'textarea', 'default' => "1行目\n2行目"),
 *   'tab_mv'   => array('label' => 'MV', 'type' => 'tab'),
 *   'item_1'   => array('label' => '項目1', 'type' => 'group', 'sub_fields' => array(...)),
 * type：text / textarea / url / image / number / tab / group / message
 *
 * 固定ページ用は 'location' の代わりに 'page_slug' => '<スラッグ>' と書ける。
 * 例：return array('title' => '事業紹介の内容', 'page_slug' => 'business', 'hide_on_screen' => array('the_content'), 'fields' => array(...));
 * 項目名はテーマ全体で重ならないようにする（初期値の一覧を共有するため）。
 */

/**
 * page-fields/*.php を読み込む（1回だけ）
 */
function theme_field_groups()
{
    static $groups = null;
    if ($groups !== null) {
        return $groups;
    }
    $groups = array();
    foreach (glob(get_template_directory() . '/page-fields/*.php') as $file) {
        $group = include $file;
        if (is_array($group)) {
            $groups[basename($file, '.php')] = $group;
        }
    }
    return $groups;
}

/**
 * 項目名 → 初期値 の一覧
 */
function theme_field_defaults()
{
    static $defaults = null;
    if ($defaults !== null) {
        return $defaults;
    }
    $defaults = array();
    foreach (theme_field_groups() as $group) {
        foreach ($group['fields'] as $name => $field) {
            if (isset($field['default'])) {
                $defaults[$name] = $field['default'];
            }
            if (($field['type'] ?? '') === 'group' && !empty($field['sub_fields'])) {
                $sub = array();
                foreach ($field['sub_fields'] as $sub_name => $sub_field) {
                    $sub[$sub_name] = $sub_field['default'] ?? '';
                }
                $defaults[$name] = $sub;
            }
        }
    }
    return $defaults;
}

/**
 * 項目の初期値を返す
 */
function theme_field_default($name)
{
    $defaults = theme_field_defaults();
    return $defaults[$name] ?? '';
}

/**
 * 配列の項目定義を ACF の形式に変換する
 */
function theme_acf_field($group_key, $name, $field)
{
    $type = $field['type'] ?? 'text';
    $acf  = array(
        'key'          => 'field_' . $group_key . '_' . $name,
        'label'        => $field['label'] ?? $name,
        'name'         => $type === 'tab' || $type === 'message' ? '' : $name,
        'type'         => $type,
        'instructions' => $field['instructions'] ?? '',
    );

    switch ($type) {
        case 'textarea':
            $acf['rows']          = $field['rows'] ?? 4;
            $acf['new_lines']     = ''; // 改行はテンプレート側で nl2br する
            $acf['default_value'] = $field['default'] ?? '';
            break;
        case 'image':
            $acf['return_format'] = 'id';
            $acf['preview_size']  = 'medium';
            $acf['library']       = 'all';
            break;
        case 'tab':
            $acf['placement'] = 'top';
            break;
        case 'message':
            $acf['message'] = $field['message'] ?? '';
            break;
        case 'group':
            $acf['layout']     = 'block';
            $acf['sub_fields'] = array();
            foreach ($field['sub_fields'] as $sub_name => $sub_field) {
                $acf['sub_fields'][] = theme_acf_field($group_key . '_' . $name, $sub_name, $sub_field);
            }
            break;
        default:
            $acf['default_value'] = $field['default'] ?? '';
    }

    return $acf;
}

/**
 * ACF にフィールドグループを登録する
 */
add_action('acf/include_fields', function () {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    foreach (theme_field_groups() as $key => $group) {
        // 'page_slug' => 'business' と書けば、そのスラッグの固定ページに表示する
        if (!empty($group['page_slug'])) {
            $page = get_page_by_path($group['page_slug']);
            $group['location'] = array(array(array('param' => 'page', 'operator' => '==', 'value' => $page ? (string) $page->ID : '0')));
        }
        $fields = array();
        foreach ($group['fields'] as $name => $field) {
            $fields[] = theme_acf_field($key, $name, $field);
        }
        acf_add_local_field_group(array(
            'key'            => 'group_theme_' . $key,
            'title'          => $group['title'],
            'fields'         => $fields,
            'location'       => $group['location'],
            'menu_order'     => $group['menu_order'] ?? 0,
            'position'       => 'acf_after_title',
            'style'          => 'default',
            'label_placement' => 'top',
            'hide_on_screen' => $group['hide_on_screen'] ?? array(),
            'active'         => true,
        ));
    }
});
