<?php

/**
 * わたしたちの想い（固定ページ slug: philosophy）の入力項目
 * テンプレート：page-philosophy.php（theme_field('ph_…') で取り出す）
 *
 * 「改行ごとに1行」の項目は、PC では1行に収まる分だけつなげて表示し、SP では改行どおりに表示します。
 */

/** VALUES の1枚分 */
$ph_value = function ($no, $title, $text) {
    return array('label' => 'VALUE 0' . $no, 'type' => 'group', 'sub_fields' => array(
        'image' => array('label' => '丸写真（正方形 440×440）', 'type' => 'image', 'instructions' => '未設定ならテーマの画像を表示します。'),
        'title' => array('label' => 'タイトル', 'type' => 'text', 'default' => $title),
        'text'  => array('label' => '本文', 'type' => 'textarea', 'rows' => 3, 'default' => $text),
    ));
};

/** MISSION / VISION の1ブロック分 */
$ph_block = function ($en, $sub, $catch, $text) {
    return array(
        'image' => array('label' => '背景写真（PC 1440×660〜740。暗めに加工したもの）', 'type' => 'image', 'instructions' => '未設定ならテーマの画像を表示します。'),
        'en'    => array('label' => '英字見出し', 'type' => 'text', 'default' => $en),
        'sub'   => array('label' => '和文の小見出し', 'type' => 'text', 'default' => $sub),
        'catch' => array('label' => 'キャッチ（改行ごとに1行）', 'type' => 'textarea', 'rows' => 3, 'default' => $catch),
        'text'  => array('label' => '本文', 'type' => 'textarea', 'rows' => 6, 'default' => $text),
    );
};

return array(
    'title'          => 'わたしたちの想いの内容',
    'page_slug'      => 'philosophy',
    'hide_on_screen' => array('the_content'),
    'fields'         => array(

        'ph_tab_mv' => array('label' => 'MV', 'type' => 'tab'),
        'ph_mv_label' => array('label' => '小ラベル', 'type' => 'text', 'default' => '人と空のあいだに、安心と美しさを。'),
        'ph_mv_title' => array('label' => '見出し（H1）', 'type' => 'text', 'default' => '私たちの想い'),
        'ph_mv_sub'   => array('label' => 'サブ見出し', 'type' => 'text', 'default' => 'MVV・第2創業'),
        'ph_mv_lead'  => array('label' => 'リード文', 'type' => 'textarea', 'rows' => 2, 'default' => "45年の歴史と自社工場を持つ安定基盤のもと、\n仕組みとチームで誰もが輝ける「第2創業」を推進しています。"),
        'ph_mv_image' => array('label' => '背景写真（PC 1440×380）', 'type' => 'image', 'instructions' => '未設定ならテーマの画像（PC・SP）を表示します。'),

        'ph_tab_intro' => array('label' => 'なぜ今「第2創業」なのか', 'type' => 'tab'),
        'ph_intro_title' => array('label' => '見出し（改行ごとに1行）', 'type' => 'textarea', 'rows' => 2, 'default' => "なぜ今、ビルテックは\n「第2創業」なのか？"),
        'ph_intro_lead'  => array('label' => '青のリード', 'type' => 'textarea', 'rows' => 2, 'default' => "変えるべきは「事業」ではなく、\n「組織のあり方」でした。"),
        'ph_intro_text'  => array('label' => '本文', 'type' => 'textarea', 'rows' => 8, 'default' => "ビルテックは創業以来45年にわたり、集合住宅のアルミ手摺（てすり）専門メーカーとして歴史を重ねてきました。大手ゼネコン様との深い信頼関係や、設計から製造まで完結できる完全自社一貫体制など、私たちが守り続けてきた強みは変わりません。\n\nでは、なぜ今「第2創業」と掲げるのか。\nそれは、これまでベテラン社員の個人の勘や職人技に頼ってきた組織から、「誰もが役割を持ち、チームと仕組みによって再現性高く成長できる組織」へと生まれ変わるためです。\n個人の頑張りに負担をかけるのではなく、技術や知識を標準化・データ化し、互いに支え合えるチームワークを創る。\nこれが、私たちが進める「第2創業」の本質です。"),
        'ph_loop_text'   => array('label' => '流れる英文', 'type' => 'text', 'default' => 'Second founding'),

        'ph_tab_message' => array('label' => '代表メッセージ', 'type' => 'tab'),
        'ph_message_heading' => array('label' => '見出し', 'type' => 'text', 'default' => '代表メッセージ'),
        'ph_message_text'    => array('label' => '本文', 'type' => 'textarea', 'rows' => 6, 'default' => "45年の歴史を持つビルテックはいま、「第2創業」として組織の生まれ変わりを進めています。\n個人の頑張りに頼る体制から、チームで支え合い成長できる環境へ。\nこの文章はダミーです。この文章はダミーです。この文章はダミーです。この文章はダミーです。この文章はダミーです。この文章はダミーです。この文章はダミーです。この文章はダミーです。この文章はダミーです。この文章はダミーです。この文章はダミーです。この文章はダミーです。この文章はダミーです。この文章はダミーです。"),
        'ph_message_image'   => array('label' => '写真（440×300）', 'type' => 'image', 'instructions' => '未設定ならテーマの画像を表示します。'),
        'ph_message_name'    => array('label' => '代表名', 'type' => 'text', 'default' => '代表 名前が入ります。'),

        'ph_tab_mvv' => array('label' => 'ビルテックの想い', 'type' => 'tab'),
        'ph_mvv_heading' => array('label' => '見出し', 'type' => 'text', 'default' => 'ビルテックの想い'),
        'ph_mission' => array('label' => 'MISSION', 'type' => 'group', 'sub_fields' => $ph_block(
            'MISSION',
            '存在意義',
            "人と空のあいだに、\n安心と美しさを。",
            "ビルテックのアルミ手すりは、建物の縁にありながら、暮らしのすぐそばにあります。家族の命と日々の安心を守り、建物の表情を整え、街の景観を美しくする。時には空を見上げ、風を感じ、ふと立ち止まって思いを巡らせる時間にも、静かに寄り添っています。\n私たちは、長年培った技術と誠実なモノづくりを通じて、一つひとつの住まいと向き合い、暮らしの縁に、これからも変わらない安心と、時代を超えて愛される美しさを届け続けます。"
        )),
        'ph_vision' => array('label' => 'VISION', 'type' => 'group', 'sub_fields' => $ph_block(
            'VISION',
            '目指す姿',
            "守り抜く品質と、\n進化し続ける組織で、\n手すりの未来をつくる。",
            "ビルテックのアルミ手すりの品質は、時代を越えて最高峰でなくてはなりません。私たちはその品質を、守り抜く義務があります。\nそのためには、私たちビルテック自身が、そしてチーム全体が進化し続けなければなりません。\n熟練の知恵を次の世代へつなぎ、部門や立場を越えて学び合い、一人ひとりが力を発揮できる組織こそが、「人と空のあいだに安心と美しさを」実現できると信じています。\n私たちがつくるのは、安心と美しさに新たな価値を加え、時代に求められ続ける手すりの未来です。"
        )),
        'ph_values' => array('label' => 'VALUES（見出し部分）', 'type' => 'group', 'sub_fields' => array(
            'image' => array('label' => '背景写真（PC 1440×1470。暗めに加工したもの）', 'type' => 'image', 'instructions' => '未設定ならテーマの画像を表示します。'),
            'en'    => array('label' => '英字見出し', 'type' => 'text', 'default' => 'VALUES'),
            'sub'   => array('label' => '和文の小見出し', 'type' => 'text', 'default' => '5つの行動指針'),
            'catch' => array('label' => 'キャッチ（改行ごとに1行）', 'type' => 'textarea', 'rows' => 2, 'default' => "私たちが大切にする\n5つの行動指針"),
            'lead'  => array('label' => 'リード（改行ごとに1行）', 'type' => 'textarea', 'rows' => 2, 'default' => "日々の業務で迷ったとき、判断に悩んだとき、\n全員が立ち返る共通の価値観です。"),
        )),
        'ph_value_1' => $ph_value(1, '品質と安全に、近道をつくらない', '人の命を守る手すりを作るメーカーとして、工程の簡略化や妥協による近道は絶対に行いません。基本動作とルールを徹底します。'),
        'ph_value_2' => $ph_value(2, '個人の正解より、“みんな”にとってのいいことを', '部署や個人の都合だけに囚われず、自社一貫体制のチーム全体、そしてお客様や社会にとって最善となる選択を行います。'),
        'ph_value_3' => $ph_value(3, '現在地を知り、次のステップを積み上げよう', '自分の得意・不得意や課題（現在地）を謙虚に受け止め、焦らずコツコツと日々の成長を重ねていきます。'),
        'ph_value_4' => $ph_value(4, '挑戦を讃え、失敗を次の知恵にしよう', '新しいことへの挑戦を応援します。もし失敗しても誰かを責めるのではなく、チームの改善や標準化（次の知恵）へとつなげます。'),
        'ph_value_5' => $ph_value(5, '立場に関係なく、互いに敬意を持って向き合おう', '役職や年齢、職種に関わらず、全員を「さん付け」で呼び合い、一人の人間としてリスペクトを持って誠実に対話します。'),
    ),
);
