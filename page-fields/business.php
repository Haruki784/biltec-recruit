<?php

/**
 * 事業紹介（固定ページ slug: business）の入力項目
 * 強み3つ・製品4つは ACF 無料版なので固定数の group で持つ。
 */

$bz_strength = function ($label, $title, $text) {
    return array('label' => $label, 'type' => 'group', 'sub_fields' => array(
        'image' => array('label' => '画像（720×400）', 'type' => 'image', 'instructions' => '未設定ならテーマの画像を表示します。'),
        'title' => array('label' => '見出し（改行ごとに1行）', 'type' => 'textarea', 'rows' => 2, 'default' => $title),
        'text'  => array('label' => '本文', 'type' => 'textarea', 'rows' => 4, 'default' => $text),
    ));
};

$bz_product = function ($label, $title, $text) {
    return array('label' => $label, 'type' => 'group', 'sub_fields' => array(
        'image' => array('label' => '画像（420×330）', 'type' => 'image', 'instructions' => '未設定ならテーマの画像を表示します。'),
        'title' => array('label' => '製品名（改行ごとに1行）', 'type' => 'textarea', 'rows' => 2, 'default' => $title),
        'text'  => array('label' => '説明', 'type' => 'textarea', 'rows' => 2, 'default' => $text),
    ));
};

return array(
    'title'          => '事業紹介の内容',
    'page_slug'      => 'business',
    'hide_on_screen' => array('the_content'),
    'fields'         => array(

        'bz_tab_mv' => array('label' => 'MV', 'type' => 'tab'),
        'bz_mv_label' => array('label' => '小ラベル', 'type' => 'text', 'default' => '事業紹介'),
        'bz_mv_title' => array('label' => '見出し（H1）', 'type' => 'text', 'default' => 'ビルテックについて'),
        'bz_mv_lead' => array('label' => 'リード（改行可）', 'type' => 'textarea', 'rows' => 2, 'default' => "設計から製造・施工までを自社で完結する、\nアルミ手摺（てすり）専門メーカーです。"),
        'bz_mv_image' => array('label' => '画像（1440×380）', 'type' => 'image', 'instructions' => '未設定ならテーマの画像を表示します。'),

        'bz_tab_about' => array('label' => 'ビルテックについて', 'type' => 'tab'),
        'bz_about_en' => array('label' => '英字の小見出し', 'type' => 'text', 'default' => 'About'),
        'bz_about_heading' => array('label' => '見出し', 'type' => 'text', 'default' => 'ビルテックについて'),
        'bz_about_lead' => array('label' => 'リード（青字）', 'type' => 'textarea', 'rows' => 2, 'default' => '目立たないけれど、暮らしと街の景観を支える専門メーカー'),
        'bz_about_text' => array('label' => '本文', 'type' => 'textarea', 'rows' => 6, 'default' => "私たちが作っているのは、マンションのバルコニーに設置される「アルミ手摺（てすり）」です。\n一見するとシンプルな製品に見えますが、住む人の命を守る「安全性」と、建物の表情や街の美しさを決定づける「デザイン性」の双方を併せ持つ、建築において欠かせない重要部材です。\nビルテックは1972年の創業以来、半世紀近くにわたり集合住宅用アルミ手すりに特化し、大手ゼネコン様をはじめとする多くのお客様から厚い信頼をいただいてきました。"),

        'bz_tab_mission' => array('label' => 'ミッション', 'type' => 'tab'),
        'bz_mission_en' => array('label' => '英字の小見出し', 'type' => 'text', 'default' => 'Mission'),
        'bz_mission_heading' => array('label' => '見出し', 'type' => 'text', 'default' => '私たちのミッション'),
        'bz_mission_lead' => array('label' => 'リード（青字）', 'type' => 'textarea', 'rows' => 2, 'default' => '「人と空のあいだに、安心と美しさを」届けること'),
        'bz_mission_text' => array('label' => '本文', 'type' => 'textarea', 'rows' => 6, 'default' => "バルコニーは、居住者が風を感じ、空を見上げてふと息をつく、暮らしの中で最も空に近い場所です。\n私たちのミッションは、単に決められたアルミ部材を加工・納品することではありません。\n住まいと空が接するその場所で、「家族の命と日々の安心を守り、建物の表情を整え、街の景観を美しくすること」。\n長年培った技術と誠実なモノづくりを通じて、一つひとつの住まいに変わらない安心と時代を超えて愛される美しさを届けることが、私たちの存在意義です。"),
        'bz_mission_image_1' => array('label' => '画像1（420×330）', 'type' => 'image', 'instructions' => '未設定ならテーマの画像を表示します。'),
        'bz_mission_image_2' => array('label' => '画像2（420×330）', 'type' => 'image', 'instructions' => '未設定ならテーマの画像を表示します。'),

        'bz_tab_strength' => array('label' => 'ビルテックの強み', 'type' => 'tab'),
        'bz_strength_en' => array('label' => '英字の小見出し', 'type' => 'text', 'default' => 'Advantage'),
        'bz_strength_heading' => array('label' => '見出し', 'type' => 'text', 'default' => 'ビルテックの強み'),
        'bz_strength_1' => $bz_strength(
            '強み1（画像は左）',
            "半世紀培った確かな技術と、\n大手ゼネコン案件を支え続ける信頼",
            '創業から45年間にわたり、集合住宅のアルミ手すりに特化して事業を展開してきました。長年培った設計・製造のノウハウがあるからこそ、大手ゼネコン様の数多くのマンション建設を陰で支え続けており、景気に左右されない安定した経営を続けています。'
        ),
        'bz_strength_2' => $bz_strength(
            '強み2（画像は右）',
            "外注トラブルに振り回されない\n「社内ダイレクト連携」",
            "設計・工図・工場・施工管理のすべての機能が自社内に揃っています。\nそのため、多くの競合他社のように外部の加工業者や外注設計に振り回されることがありません。\n「工場で加工しやすい図面への修正」や「納期の調整」も社内で直接顔を合わせて協議・解決できる、自社一貫メーカーならではの働きやすさがあります。"
        ),
        'bz_strength_3' => $bz_strength(
            '強み3（画像は左）',
            "新築から大規模改修まで対応する\n「確かな技術開発力」",
            "新築マンションへの納品はもちろん、建物の資産価値を保つ「大規模改修工事」用の手すりや避難用パーテーションなど、独自の製品開発にも注力しています。\n長年培った豊富な施工データと独自の品質基準に基づいた高い技術力で、多様化する建築ニーズに応え続けています。"
        ),

        'bz_tab_product' => array('label' => '製品紹介', 'type' => 'tab'),
        'bz_product_en' => array('label' => '英字の小見出し', 'type' => 'text', 'default' => 'Product'),
        'bz_product_heading' => array('label' => '見出し', 'type' => 'text', 'default' => '手すりとは？'),
        'bz_product_heading_sub' => array('label' => '見出しの後ろの小さい文字', 'type' => 'text', 'default' => '（私たちの製品紹介）'),
        'bz_product_lead' => array('label' => 'リード（青字）', 'type' => 'textarea', 'rows' => 2, 'default' => '建物の「安全」と「美しさ」をつくるプロダクト'),
        'bz_product_text' => array('label' => '本文', 'type' => 'textarea', 'rows' => 4, 'default' => "「手すり」とひとくちに言っても、そのバリエーションは実に多彩です。\n縦格子タイプから、開放感のあるガラス支持タイプ、プライバシーを守るルーバータイプ、隣戸との境目になる避難パーテーション（隔て板）まで、住まいの用途に合わせて様々な仕様を自社工場で組み上げています。"),
        'bz_product_1' => $bz_product('製品1', "アルミ縦格子手すり\n（ベーシック・スマートライン）", "優れた耐久性とシンプルな美しさを兼ね備えた、\nロングセラー製品。"),
        'bz_product_2' => $bz_product('製品2', "ガラス手すり\n（ハンガー・スマートハンガーライン）", "バルコニーの眺望と採光を高め、\n現代的なマンション外観を彩るデザイン手すり。"),
        'bz_product_3' => $bz_product('製品3', 'ルーフバルコニー用スライド手すり', "基礎石が不要で、水勾配にも柔軟に対応できる\n自社独自工法の手すりユニット。"),
        'bz_product_4' => $bz_product('製品4', 'バルコニー用パーテーション（隔て板）', "居住者のプライバシーを確保しつつ、\n非常時には破破・開閉して安全に避難できる防災部材。"),
    ),
);
