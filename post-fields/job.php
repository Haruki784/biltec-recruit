<?php

/**
 * 募集要項（CPT job）の入力項目
 * 一覧・TOPのカード・詳細ページで使う。ACF 無料版なので、表の行や箇条書きは固定数の項目で持つ。
 */

$detail_block = function ($label) {
    return array('label' => $label, 'type' => 'group', 'sub_fields' => array(
        'heading' => array('label' => '見出し', 'type' => 'text', 'default' => $label),
        'lead'    => array('label' => 'リード（太字）', 'type' => 'textarea', 'rows' => 2),
        'list'    => array('label' => '箇条書き（1行1項目）', 'type' => 'textarea', 'rows' => 5, 'instructions' => '行頭の「〇」は自動で付きます。「項目名｜説明」と書くと、項目名の後ろで改行します。'),
        'image'   => array('label' => '画像', 'type' => 'image'),
    ));
};

return array(
    'title'          => '募集要項の内容',
    'location'       => array(array(array('param' => 'post_type', 'operator' => '==', 'value' => 'job'))),
    'hide_on_screen' => array('the_content'),
    'fields'         => array(

        'tab_job_card' => array('label' => 'カード・ナビ', 'type' => 'tab'),
        'job_note' => array('label' => '', 'type' => 'message', 'message' => 'タイトルには職種名（募集要項の原稿の表記。例：意匠設計）を入れ、後ろの（リーダー候補）などは下の欄に入れてください。カードの写真は「アイキャッチ画像」を使います。'),
        'card_title_sub' => array('label' => '職種名の後ろ（例：（リーダー候補））', 'type' => 'text'),
        'nav_label' => array('label' => 'メニューでの表示名', 'type' => 'text', 'instructions' => '空欄ならタイトルを使います。'),
        'catch' => array('label' => 'キャッチ', 'type' => 'text'),
        'tags' => array('label' => '特徴（1行ずつ表示）', 'type' => 'textarea', 'rows' => 2),
        'badge' => array('label' => '丸バッジ（任意。最後の行が大きく出ます）', 'type' => 'textarea', 'rows' => 3, 'instructions' => '例：チーム負担／軽減のため／増員'),

        'tab_job_mv' => array('label' => '詳細：MV', 'type' => 'tab'),
        'job_mv_image' => array('label' => 'MV画像', 'type' => 'image'),
        'job_mv_catch' => array('label' => 'キャッチ（2行）', 'type' => 'textarea', 'rows' => 2),
        'job_mv_tags' => array('label' => '青い文字（例：CAD経験者歓迎／業界未経験OK）', 'type' => 'text'),
        'job_mv_text' => array('label' => '説明', 'type' => 'textarea', 'rows' => 2),

        'tab_job_intro' => array('label' => '詳細：紹介文', 'type' => 'tab'),
        'job_intro_heading' => array('label' => '見出し（2行）', 'type' => 'textarea', 'rows' => 2),
        'job_intro_text' => array('label' => '本文', 'type' => 'textarea', 'rows' => 8),

        'tab_job_table' => array('label' => '詳細：募集要項', 'type' => 'tab'),
        'job_req_heading' => array('label' => '見出し', 'type' => 'text', 'default' => '募集要項'),
        'job_req_note' => array('label' => '', 'type' => 'message', 'message' => '表の左の項目名は、下の各項目のラベルがそのまま出ます。空欄の行は表示しません。'),
        'req_title' => array('label' => '職種名', 'type' => 'textarea', 'rows' => 2),
        'req_work' => array('label' => '仕事内容', 'type' => 'textarea', 'rows' => 3),
        'req_condition' => array('label' => '応募条件', 'type' => 'textarea', 'rows' => 4),
        'req_place' => array('label' => '勤務地', 'type' => 'textarea', 'rows' => 2),
        'req_salary' => array('label' => '給与', 'type' => 'textarea', 'rows' => 3),
        'req_time' => array('label' => '勤務時間', 'type' => 'textarea', 'rows' => 2),
        'req_holiday' => array('label' => '休日・休暇', 'type' => 'textarea', 'rows' => 3),
        'req_welfare' => array('label' => '待遇・福利厚生', 'type' => 'textarea', 'rows' => 3),
        'req_extra_1' => array('label' => '追加の行1（任意）', 'type' => 'group', 'sub_fields' => array(
            'label' => array('label' => '項目名', 'type' => 'text'),
            'value' => array('label' => '内容', 'type' => 'textarea', 'rows' => 2),
        )),
        'req_extra_2' => array('label' => '追加の行2（任意）', 'type' => 'group', 'sub_fields' => array(
            'label' => array('label' => '項目名', 'type' => 'text'),
            'value' => array('label' => '内容', 'type' => 'textarea', 'rows' => 2),
        )),

        'job_entry_btn' => array('label' => '表の下の応募ボタン（1行目は小さく出ます）', 'type' => 'textarea', 'rows' => 2, 'default' => "最速1分\n直応募エントリーフォーム"),

        'tab_job_detail' => array('label' => '詳細：仕事の中身', 'type' => 'tab'),
        'job_fit' => $detail_block('こんな方にピッタリ'),
        'job_person' => $detail_block('求める人物像'),
        'job_duties' => $detail_block('主な業務内容'),
        'job_appeal' => $detail_block('この仕事の魅力・やりがい'),
    ),
);
