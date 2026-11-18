<?php

/**
 * 会社概要（固定ページ slug: company）の入力項目
 * デザインは他社サイト（トータル環境）のレイアウト流用。文言はビルテックのもの。
 * 会社概要の表の初期値は、募集要項の原稿（.docx）末尾の「会社概要」から。
 */

$business = function ($n, $title, $text, $url) {
    return array('label' => '事業' . $n, 'type' => 'group', 'sub_fields' => array(
        'title' => array('label' => '事業名', 'type' => 'text', 'default' => $title),
        'text'  => array('label' => '説明', 'type' => 'textarea', 'rows' => 3, 'default' => $text),
        'image' => array('label' => '写真（590×240）', 'type' => 'image', 'instructions' => '未設定ならテーマの画像を表示します。'),
        'url'   => array('label' => 'ボタンのリンク先', 'type' => 'url', 'default' => $url),
    ));
};

$row = function ($label, $value = '') {
    return array('label' => $label === '' ? '（空き行）' : '行：' . $label, 'type' => 'group', 'sub_fields' => array(
        'label' => array('label' => '項目名', 'type' => 'text', 'default' => $label),
        'value' => array('label' => '内容', 'type' => 'textarea', 'rows' => 2, 'default' => $value),
    ));
};

return array(
    'title'          => '会社概要の内容',
    'page_slug'      => 'company',
    'hide_on_screen' => array('the_content'),
    'fields'         => array(

        'cp_tab_mv' => array('label' => 'MV', 'type' => 'tab'),
        'cp_mv_title' => array('label' => 'ページタイトル（H1）', 'type' => 'text', 'default' => '会社概要'),
        'cp_mv_image' => array('label' => '画像（1440×380）', 'type' => 'image', 'instructions' => '未設定ならテーマの画像（仮）を表示します。'),

        'cp_tab_message' => array('label' => 'TOP MESSAGE', 'type' => 'tab'),
        'cp_msg_catch' => array('label' => 'キャッチ（改行ごとに1行）', 'type' => 'textarea', 'rows' => 3, 'default' => "暮らしの安全と、街の景観を守る。\n設計から製造・施工までの一貫体制で、\n次の時代の手すりをつくります。"),
        'cp_msg_name' => array('label' => '会社名・代表者名（改行ごとに1行）', 'type' => 'textarea', 'rows' => 2, 'default' => "ビルテック株式会社\n代表取締役　大吉 弘"),
        'cp_msg_image' => array('label' => '代表の写真（400×300）', 'type' => 'image', 'instructions' => '未設定なら仮の画像を表示します。'),
        'cp_msg_text' => array('label' => '本文', 'type' => 'textarea', 'rows' => 10, 'default' => "この文章はダミーです。代表メッセージの本文が入ります。この文章はダミーです。この文章はダミーです。\nこの文章はダミーです。この文章はダミーです。この文章はダミーです。この文章はダミーです。この文章はダミーです。\n\nこの文章はダミーです。この文章はダミーです。この文章はダミーです。この文章はダミーです。この文章はダミーです。この文章はダミーです。\nこの文章はダミーです。この文章はダミーです。この文章はダミーです。"),

        'cp_tab_business' => array('label' => '事業紹介', 'type' => 'tab'),
        'cp_biz_heading' => array('label' => '見出し', 'type' => 'text', 'default' => '事業紹介'),
        'cp_biz_sub' => array('label' => '見出しの後ろの小さい文字', 'type' => 'text', 'default' => '／ ビルテックの3つの主な事業'),
        'cp_biz_1' => $business(1, 'アルミ手すりの設計', '新築・改修工事のマンションに設置するアルミ製手すりを、意匠性と安全性の両面から設計します。', home_url('/business/')),
        'cp_biz_2' => $business(2, '自社工場での製造', '千葉の自社工場で、工図（加工製作図）をもとに切断・加工・溶接・組み立てまでを行います。', home_url('/process/')),
        'cp_biz_3' => $business(3, '施工・販売', '完成した製品を現場へ納め、施工管理チームと職人が安全・確実に取り付けます。', home_url('/process/')),

        'cp_tab_table' => array('label' => '会社概要の表', 'type' => 'tab'),
        'cp_table_note' => array('label' => '', 'type' => 'message', 'message' => '項目名が空の行は表示しません。行は12行まで。'),
        'cp_row_1' => $row('会社名', 'ビルテック株式会社'),
        'cp_row_2' => $row('設立', '1982年1月20日'),
        'cp_row_3' => $row('代表者', '大吉 弘'),
        'cp_row_4' => $row('資本金', '2,000万円'),
        'cp_row_5' => $row('本社所在地', "〒260-0028\n千葉県千葉市中央区新町18-10 千葉第一生命ビルディング2F"),
        'cp_row_6' => $row('事業内容', '新築、改修工事のアルミ製手すりなどの設計、施工、販売、製造'),
        'cp_row_7' => $row(''),
        'cp_row_8' => $row(''),
        'cp_row_9' => $row(''),
        'cp_row_10' => $row(''),
        'cp_row_11' => $row(''),
        'cp_row_12' => $row(''),

        'cp_tab_recruit' => array('label' => '採用情報', 'type' => 'tab'),
        'cp_rec_heading' => array('label' => '見出し', 'type' => 'text', 'default' => '採用情報'),
        'cp_rec_sub' => array('label' => '見出しの後ろの小さい文字', 'type' => 'text', 'default' => '／ 建築の“顔”を任せたい'),
        'cp_rec_lead' => array('label' => 'リード', 'type' => 'textarea', 'rows' => 2, 'default' => "この文章はダミーです。この文章はダミーです。この文章はダミーです。\nこの文章はダミーです。この文章はダミーです。"),
    ),
);
