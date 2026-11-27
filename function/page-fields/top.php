<?php

/**
 * TOP（固定ページ slug: top、ホームに設定）の編集項目。4つ目の値が初期値（＝今の表示）、5つ目は管理画面の説明
 * 「共通：〜」タブ（common_*）は全ページで使う（theme_common('名前')）。会社情報は company.php の「会社基本情報」タブ
 */
return [
    ['tab', 'MV'],
    ['mv_title', 'キャッチ（改行ごとに1行）', 'textarea', "守るために、\n挑む。"],
    ['mv_lead', 'リード文', 'textarea', "大手ゼネコンに選ばれ続けてきた、\nアルミ手すり専門メーカー・ビルテック。\n培ってきた品質と技術を土台に、\nいま、組織を進化させる「第2創業」へ。\n次のビルテックを、あなたの経験とともに。"],
    ['mv_slide_1', 'スライド1', 'group', [
        ['pc', '画像（PC 1440×780）', 'image', 'top/main01.webp'],
        ['sp', '画像（SP 750×1360）', 'image', 'top/main01_sp.webp', 'PC だけ選んだときは、SP でも PC の画像を出します。'],
    ]],
    ['mv_slide_2', 'スライド2', 'group', [
        ['pc', '画像（PC 1440×780）', 'image', 'top/main02.webp'],
        ['sp', '画像（SP 750×1360）', 'image', 'top/main02_sp.webp', 'PC だけ選んだときは、SP でも PC の画像を出します。'],
    ]],
    ['mv_slide_3', 'スライド3', 'group', [
        ['pc', '画像（PC 1440×780）', 'image', 'top/main03.webp'],
        ['sp', '画像（SP 750×1360）', 'image', 'top/main03_sp.webp', 'PC だけ選んだときは、SP でも PC の画像を出します。'],
    ]],
    ['mv_scroll', 'スクロールの文字', 'text', 'Scroll Down'],
    ['opening_text', 'オープニング（白い画面）のロゴの下の文字', 'textarea', "アルミ手すり専門メーカー\nビルテック"],

    ['tab', 'ビルテックは今、'],
    ['intro_title', '見出し（改行ごとに1行）', 'textarea', "ビルテックは今、\n一緒に会社をつくる「新しい仲間」を\n本気で探しています！"],
    ['intro_accent', '見出しで赤くする言葉', 'text', '「新しい仲間」', '見出しの中にこの言葉があれば赤で表示します。'],
    ['intro_text', '本文', 'textarea', "45年の歴史を持つ私たちが、いま取り組んでいるのは「第2創業」としての組織改革。\n個人の頑張りに頼るのではなく、みんなで支え合うチームをつくるために、新しい仲間を必要としています。\n派手なアピールや口上手さは必要ありません。\n黙々と図面に向き合うのが好きな方や、地元で長く技術を身につけたい方。\nそんなあなたの真面目さを活かして、一緒により良い会社を作っていきませんか。\nまずは一度、気軽にお話ししてみましょう。"],
    ['intro_bg', '背景の写真（1220×1038）', 'image', 'top/sec1_bg.webp'],
    ['intro_card_1', '職種カード1', 'group', [
        ['job', '募集要項のスラッグ', 'text', 'ishou', 'リンク先と表示名はこの募集要項の投稿（タイトル）。空にするとカードを出しません。'],
        ['image', '画像（720×260）', 'image', 'top/sec1_bnr01.webp'],
    ]],
    ['intro_card_2', '職種カード2', 'group', [
        ['job', '募集要項のスラッグ', 'text', 'kouzu', 'リンク先と表示名はこの募集要項の投稿（タイトル）。空にするとカードを出しません。'],
        ['image', '画像（720×260）', 'image', 'top/sec1_bnr02.webp'],
    ]],
    ['intro_card_3', '職種カード3', 'group', [
        ['job', '募集要項のスラッグ', 'text', 'factory', 'リンク先と表示名はこの募集要項の投稿（タイトル）。空にするとカードを出しません。'],
        ['image', '画像（720×260）', 'image', 'top/sec1_bnr03.webp'],
    ]],

    ['tab', '代表メッセージ'],
    ['message_image', '画像（PC 440×648）', 'image', 'top/sec2_bnr01.webp'],
    ['message_image_sp', '画像（SP 750×440）', 'image', 'top/sec2_bnr01_sp.webp', 'PC だけ選んだときは、SP でも PC の画像を出します。'],
    ['message_label', '小見出し', 'text', '代表メッセージ'],
    ['message_title', '見出し', 'textarea', "生まれ変わるビルテック。\n仕組みとチームで、人が輝く会社へ。"],
    ['message_text', '本文', 'textarea', "45年の歴史を持つビルテックはいま、「第2創業」として組織の生まれ変わりを進めています。\n個人の頑張りに頼る体制から、チームで支え合い成長できる環境へ。\nこの文章はダミーです。この文章はダミーです。この文章はダミーです。この文章はダミーです。この文章はダミーです。この文章はダミーです。この文章はダミーです。この文章はダミーです。この文章はダミーです。この文章はダミーです。この文章はダミーです。この文章はダミーです。"],
    ['message_name', '代表名', 'text', '代表 名前が入ります。'],
    ['message_btn_label', 'ボタンの文字', 'text', 'もっと見る'],
    ['message_btn_link', 'ボタンのリンク先', 'text', '/philosophy/', '/philosophy/ のようなサイト内のパス、または https:// から始まるURL'],

    ['tab', 'ビルテックの強み'],
    ['strength_heading', '見出し', 'text', 'ビルテックの強み'],
    ['strength_sub', 'サブコピー', 'text', 'ニッチだから、強い。設計から製造まで「完全自社完結」のモノづくり'],
    ['strength_lead', 'リード文', 'textarea', "なぜ、ビルテックは半世紀近く選ばれ続けているのか。\nそれは、設計から製造・施工までをすべて自社で完結できる「完全一貫体制」があるから。\n大手ゼネコンとの45年におよぶ信頼関係と独自の技術力が、他社には真似できない\n圧倒的な安定性を生み出しています。"],
    ['strength_1', '強み1', 'group', [
        ['image', '画像（正方形 720×720）', 'image', 'top/sec3_bnr01.webp'],
        ['title', 'タイトル', 'textarea', "創業45年\n大手ゼネコンと直接取引"],
    ]],
    ['strength_2', '強み2', 'group', [
        ['image', '画像（正方形 720×720）', 'image', 'top/sec3_bnr02.webp'],
        ['title', 'タイトル', 'textarea', "100%自社一貫！\n設計・工図・工場・施工まで"],
    ]],
    ['strength_3', '強み3', 'group', [
        ['image', '画像（正方形 720×720）', 'image', 'top/sec3_bnr03.webp'],
        ['title', 'タイトル', 'textarea', "暮らしの安全と\n景観を守る専門技術"],
    ]],
    ['strength_btn_label', 'ボタンの文字', 'text', '事業紹介を一覧で見る'],
    ['strength_btn_link', 'ボタンのリンク先', 'text', '/business/'],

    ['tab', '募集職種'],
    ['message', '職種のカードは「募集要項」の投稿から自動で表示されます。並び順は各投稿の「順序」で変えられます。'],
    ['recruit_heading', '見出し', 'text', '募集職種'],
    ['recruit_sub', 'サブコピー', 'text', 'あなたに合った役割で、一生モノの技術を身につける'],
    ['recruit_btn_label', 'ボタンの文字', 'text', '募集一覧を見る'],
    ['recruit_btn_link', 'ボタンのリンク先', 'text', '/job/'],

    ['tab', '先輩インタビュー'],
    ['message', 'インタビューのカードは「先輩インタビュー」の投稿から自動で表示されます。'],
    ['interview_heading', '見出し', 'text', '先輩インタビュー'],
    ['interview_lead', 'リード文', 'textarea', "リアルな声を届けたい。\n等身大の社員ストーリーをお伝えします。\nダミーテキスト。ダミーテキスト。ダミーテキスト。\nダミーテキスト。ダミーテキスト。\nダミーテキスト。ダミーテキスト。\nダミーテキスト。ダミーテキスト。"],
    ['interview_btn_label', 'ボタンの文字', 'text', 'インタビュー一覧を見る'],
    ['interview_btn_link', 'ボタンのリンク先', 'text', '/interview/'],

    // ここから全ページ共通（theme_common('名前') で取り出す。名前の common_ は付けない）
    ['tab', '共通：ヘッダー'],
    ['common_logo', 'ロゴ（色付き）', 'image', 'logo.svg', 'フッター・オープニング・手すりができるまで にも使います。SVG・PNG・WebP で入れられます（SVG は Safe SVG プラグインが必要）。'],
    ['common_logo_white', 'ロゴ（白）', 'image', 'logo_w.svg', 'TOP の MV の上（透明のヘッダー）で使います。'],
    ['common_logo_alt', 'ロゴの代替テキスト（会社名）', 'text', 'BILTEC ビルテック株式会社'],
    ['common_site_name', 'ロゴ横の文字', 'text', '中途採用サイト', '空欄なら出しません。'],
    ['common_btn1_label', 'ボタン1（黒）の文字', 'text', '募集要項', 'ヘッダー・SPメニュー・SP下部の固定ボタンに出します。'],
    ['common_btn1_link', 'ボタン1（黒）のリンク先', 'text', '/job/'],
    ['common_btn2_label', 'ボタン2（グラデーション）の文字', 'text', 'まずは話を聞いてみる'],
    ['common_btn2_link', 'ボタン2（グラデーション）のリンク先', 'text', '/entry/?type=casual'],

    ['tab', '共通：メニュー'],
    ['message', 'メニューは「外観 → メニュー」（または 外観 → カスタマイズ → メニュー）で編集します。位置は「グローバルメニュー」（ヘッダー・SPメニュー・フッターの列）と「フッター右の太字リンク」の2つです。'],

    ['tab', '共通：CTA'],
    ['message', '全ページの下に出る「流れる英文 → 街並み → ここまで読んでくださって〜」の部分です。'],
    ['common_loop_text', '流れる英文', 'text', 'CONTRIBUTING TO URBAN LANDSCAPES AND THE ENVIRONMENT.'],
    ['common_city', '街並みの画像（2400×412）', 'image', 'top/sec6_bg.webp', '事業紹介のページにも使います。'],
    ['common_cta_bg', '背景画像 PC（1440×600）', 'image', 'top/ft_bg.webp'],
    ['common_cta_bg_sp', '背景画像 SP', 'image', 'top/ft_bg_sp.webp', 'PC だけ選んだときは、SP でも PC の画像を出します。'],
    ['common_cta_title', '見出し', 'textarea', "ここまで読んでくださって\nありがとうございます。"],
    ['common_cta_text', '本文', 'textarea', "「まずは実際の工場を見てみたい」「選考前に話を聞いてみたい」という方も大歓迎です。\nこの文章はダミーです。　この文章はダミーです。　この文章はダミーです。\nこの文章はダミーです。　この文章はダミーです。　この文章はダミーです。　この文章はダミーです。"],
    ['common_cta_btn1_small', 'ボタン1（白）の上の小さい文字', 'text', '', '空欄なら出しません。'],
    ['common_cta_btn1_label', 'ボタン1（白）の文字', 'text', 'カジュアル面談を申し込む', '空欄ならボタンを出しません。'],
    ['common_cta_btn1_link', 'ボタン1（白）のリンク先', 'text', '/entry/?type=casual'],
    ['common_cta_btn2_small', 'ボタン2（グラデーション）の上の小さい文字', 'text', '最速1分', '空欄なら出しません。'],
    ['common_cta_btn2_label', 'ボタン2（グラデーション）の文字', 'text', '直応募エントリーフォーム', '空欄ならボタンを出しません。'],
    ['common_cta_btn2_link', 'ボタン2（グラデーション）のリンク先', 'text', '/entry/'],

    ['tab', '共通：フォーム'],
    ['message', 'チョク採フォーム（iframe）のURLです。エントリーページ（/entry/）の埋め込みに使います。'],
    ['common_form_entry_url', 'エントリーフォームのURL', 'url', ''],
    ['common_form_casual_url', 'カジュアル面談フォームのURL', 'url', '', 'エントリーと同じフォームなら空欄のままにしてください。'],

    ['tab', '共通：募集職種一覧'],
    ['message', '募集職種一覧（/job/）には編集画面がないので、ここで編集します。'],
    ['common_job_archive_title', 'MVの見出し（H1）', 'text', '募集職種一覧'],
    ['common_job_archive_image', 'MV画像（PC 1440×380）', 'image', 'job/3_0_main.webp'],
    ['common_job_archive_image_sp', 'MV画像（SP）', 'image', 'job/3_0_main_sp.webp', 'PC だけ選んだときは、SP でも PC の画像を出します。'],
];
