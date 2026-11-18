<?php

/**
 * TOP（固定ページ slug: top、ホームに設定）の入力項目
 * 「共通：〜」タブは全ページの CTA・フッターなどで使う。
 */
return array(
    'title'          => 'TOPページの内容',
    'location'       => array(array(array('param' => 'page_type', 'operator' => '==', 'value' => 'front_page'))),
    'hide_on_screen' => array('the_content'),
    'fields'         => array(

        'tab_mv' => array('label' => 'MV', 'type' => 'tab'),
        'mv_title' => array('label' => 'キャッチ（改行ごとに1行）', 'type' => 'textarea', 'rows' => 2, 'default' => "守るために、\n挑む。"),
        'mv_lead' => array('label' => 'リード文', 'type' => 'textarea', 'rows' => 5, 'default' => "大手ゼネコンに選ばれ続けてきた、\nアルミ手すり専門メーカー・ビルテック。\n培ってきた品質と技術を土台に、\nいま、組織を進化させる「第2創業」へ。\n次のビルテックを、あなたの経験とともに。"),

        'tab_intro' => array('label' => 'ビルテックは今、', 'type' => 'tab'),
        'intro_title' => array('label' => '見出し（改行ごとに1行）', 'type' => 'textarea', 'rows' => 3, 'default' => "ビルテックは今、\n一緒に会社をつくる「新しい仲間」を\n本気で探しています！"),
        'intro_accent' => array('label' => '見出しで赤くする言葉', 'type' => 'text', 'default' => '「新しい仲間」', 'instructions' => '見出しの中にこの言葉があれば赤で表示します。'),
        'intro_text' => array('label' => '本文', 'type' => 'textarea', 'rows' => 6, 'default' => "45年の歴史を持つ私たちが、いま取り組んでいるのは「第2創業」としての組織改革。\n個人の頑張りに頼るのではなく、みんなで支え合うチームをつくるために、新しい仲間を必要としています。\n派手なアピールや口上手さは必要ありません。\n黙々と図面に向き合うのが好きな方や、地元で長く技術を身につけたい方。\nそんなあなたの真面目さを活かして、一緒により良い会社を作っていきませんか。\nまずは一度、気軽にお話ししてみましょう。"),

        'tab_message' => array('label' => '代表メッセージ', 'type' => 'tab'),
        'message_image' => array('label' => '画像（PC 440×648）', 'type' => 'image', 'instructions' => '未設定ならテーマの画像を表示します。'),
        'message_title' => array('label' => '見出し', 'type' => 'textarea', 'rows' => 2, 'default' => "生まれ変わるビルテック。\n仕組みとチームで、人が輝く会社へ。"),
        'message_text' => array('label' => '本文', 'type' => 'textarea', 'rows' => 5, 'default' => "45年の歴史を持つビルテックはいま、「第2創業」として組織の生まれ変わりを進めています。\n個人の頑張りに頼る体制から、チームで支え合い成長できる環境へ。\nこの文章はダミーです。この文章はダミーです。この文章はダミーです。この文章はダミーです。この文章はダミーです。この文章はダミーです。この文章はダミーです。この文章はダミーです。この文章はダミーです。この文章はダミーです。この文章はダミーです。この文章はダミーです。"),
        'message_name' => array('label' => '代表名', 'type' => 'text', 'default' => '代表 名前が入ります。'),

        'tab_strength' => array('label' => 'ビルテックの強み', 'type' => 'tab'),
        'strength_heading' => array('label' => '見出し', 'type' => 'text', 'default' => 'ビルテックの強み'),
        'strength_sub' => array('label' => 'サブコピー', 'type' => 'text', 'default' => 'ニッチだから、強い。設計から製造まで「完全自社完結」のモノづくり'),
        'strength_lead' => array('label' => 'リード文', 'type' => 'textarea', 'rows' => 4, 'default' => "なぜ、ビルテックは半世紀近く選ばれ続けているのか。\nそれは、設計から製造・施工までをすべて自社で完結できる「完全一貫体制」があるから。\n大手ゼネコンとの45年におよぶ信頼関係と独自の技術力が、他社には真似できない\n圧倒的な安定性を生み出しています。"),
        'strength_1' => array('label' => '強み1', 'type' => 'group', 'sub_fields' => array(
            'image' => array('label' => '画像（正方形）', 'type' => 'image'),
            'title' => array('label' => 'タイトル', 'type' => 'textarea', 'rows' => 2, 'default' => "創業45年\n大手ゼネコンと直接取引"),
        )),
        'strength_2' => array('label' => '強み2', 'type' => 'group', 'sub_fields' => array(
            'image' => array('label' => '画像（正方形）', 'type' => 'image'),
            'title' => array('label' => 'タイトル', 'type' => 'textarea', 'rows' => 2, 'default' => "100%自社一貫！\n設計・工図・工場・施工まで"),
        )),
        'strength_3' => array('label' => '強み3', 'type' => 'group', 'sub_fields' => array(
            'image' => array('label' => '画像（正方形）', 'type' => 'image'),
            'title' => array('label' => 'タイトル', 'type' => 'textarea', 'rows' => 2, 'default' => "暮らしの安全と\n景観を守る専門技術"),
        )),

        'tab_recruit' => array('label' => '募集職種', 'type' => 'tab'),
        'recruit_note' => array('label' => '', 'type' => 'message', 'message' => '職種のカードは「募集要項」の投稿から自動で表示されます。並び順は各投稿の「順序」で変えられます。'),
        'recruit_heading' => array('label' => '見出し', 'type' => 'text', 'default' => '募集職種'),
        'recruit_sub' => array('label' => 'サブコピー', 'type' => 'text', 'default' => 'あなたに合った役割で、一生モノの技術を身につける'),

        'tab_interview' => array('label' => '先輩インタビュー', 'type' => 'tab'),
        'interview_heading' => array('label' => '見出し', 'type' => 'text', 'default' => '先輩インタビュー'),
        'interview_lead' => array('label' => 'リード文', 'type' => 'textarea', 'rows' => 6, 'default' => "リアルな声を届けたい。\n等身大の社員ストーリーをお伝えします。\nダミーテキスト。ダミーテキスト。ダミーテキスト。\nダミーテキスト。ダミーテキスト。\nダミーテキスト。ダミーテキスト。\nダミーテキスト。ダミーテキスト。"),
        'loop_text' => array('label' => '流れる英文', 'type' => 'text', 'default' => 'CONTRIBUTING TO URBAN LANDSCAPES AND THE ENVIRONMENT.'),

        'tab_cta' => array('label' => '共通：CTA', 'type' => 'tab'),
        'cta_note' => array('label' => '', 'type' => 'message', 'message' => '全ページの下に出る「ここまで読んでくださって〜」の部分です。'),
        'cta_title' => array('label' => '見出し', 'type' => 'textarea', 'rows' => 2, 'default' => "ここまで読んでくださって\nありがとうございます。"),
        'cta_text' => array('label' => '本文', 'type' => 'textarea', 'rows' => 3, 'default' => "「まずは実際の工場を見てみたい」「選考前に話を聞いてみたい」という方も大歓迎です。\nこの文章はダミーです。　この文章はダミーです。　この文章はダミーです。\nこの文章はダミーです。　この文章はダミーです。　この文章はダミーです。　この文章はダミーです。"),

        'tab_form' => array('label' => '共通：フォーム', 'type' => 'tab'),
        'form_note' => array('label' => '', 'type' => 'message', 'message' => 'チョク採フォーム（iframe）のURLです。ボタンの飛び先とエントリーページの埋め込みに使います。'),
        'form_entry_url' => array('label' => 'エントリーフォームのURL', 'type' => 'url', 'default' => ''),
        'form_casual_url' => array('label' => 'カジュアル面談フォームのURL', 'type' => 'url', 'default' => '', 'instructions' => 'エントリーと同じフォームなら空欄のままにしてください。'),

        'tab_company' => array('label' => '共通：会社情報', 'type' => 'tab'),
        'company_name' => array('label' => '会社名', 'type' => 'text', 'default' => 'ビルテック株式会社'),
        'company_name_en' => array('label' => '会社名（英語・Copyright用）', 'type' => 'text', 'default' => 'BILTEC CO.,LTD.'),
        'company_zip' => array('label' => '郵便番号', 'type' => 'text', 'default' => '〒260-0028'),
        'company_address' => array('label' => '住所', 'type' => 'text', 'default' => '千葉県千葉市中央区新町18-10'),
        'company_building' => array('label' => '建物名', 'type' => 'text', 'default' => '千葉第一生命ビルディング2F'),
        'company_ceo' => array('label' => '代表者（役職と名前）', 'type' => 'text', 'default' => '代表取締役 大吉 弘', 'instructions' => 'プライバシーポリシーに表示します。'),
        'company_tel' => array('label' => 'お問い合わせ窓口の電話番号', 'type' => 'text', 'default' => '', 'instructions' => 'プライバシーポリシーの窓口に表示します。空欄なら表示しません。'),
        'company_mail' => array('label' => 'お問い合わせ窓口のメールアドレス', 'type' => 'text', 'default' => '', 'instructions' => '空欄なら表示しません。'),
        'privacy_date' => array('label' => 'プライバシーポリシーの施行日', 'type' => 'text', 'default' => '2026年12月1日', 'instructions' => '公開日に合わせて変更してください。'),
    ),
);
