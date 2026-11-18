<?php

/**
 * 先輩インタビュー（CPT interview）の入力項目
 * 本文は ACF 無料版なので「セクション1〜8」の固定数。見出しが空のセクションは表示しない。
 */

$fields = array(
    'tab_iv_profile' => array('label' => 'プロフィール・カード', 'type' => 'tab'),
    'iv_note' => array('label' => '', 'type' => 'message', 'message' => 'カードの写真は「アイキャッチ画像」（縦長 360×420 目安）を使います。'),
    'catch_1' => array('label' => 'キャッチ1行目（青帯）', 'type' => 'text'),
    'catch_2' => array('label' => 'キャッチ2行目（青帯）', 'type' => 'text'),
    'person_name' => array('label' => '名前', 'type' => 'text'),
    'name_en' => array('label' => '名前（英字）', 'type' => 'text'),
    'join_year' => array('label' => '入社年（例：2013年入社）', 'type' => 'text'),
    'position' => array('label' => '職種・役職', 'type' => 'text'),

    'tab_iv_mv' => array('label' => '詳細：MV・リード', 'type' => 'tab'),
    'iv_mv_image' => array('label' => 'MV画像（横長）', 'type' => 'image'),
    'iv_lead' => array('label' => 'リード文', 'type' => 'textarea', 'rows' => 4),

    'tab_iv_body' => array('label' => '詳細：本文', 'type' => 'tab'),
);

for ($i = 1; $i <= 8; $i++) {
    $fields['iv_section_' . $i] = array('label' => 'セクション' . $i, 'type' => 'group', 'sub_fields' => array(
        'heading'  => array('label' => '見出し（目次にも出ます）', 'type' => 'textarea', 'rows' => 2),
        'question' => array('label' => '質問', 'type' => 'textarea', 'rows' => 2),
        'answer'   => array('label' => '回答', 'type' => 'textarea', 'rows' => 5),
        'image'    => array('label' => '写真（任意）', 'type' => 'image'),
    ));
}

return array(
    'title'          => 'インタビューの内容',
    'location'       => array(array(array('param' => 'post_type', 'operator' => '==', 'value' => 'interview'))),
    'hide_on_screen' => array('the_content', 'excerpt'),
    'fields'         => $fields,
);
