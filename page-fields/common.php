<?php

/**
 * サイト共通の入力項目（ヘッダー・フッター・CTA・フォーム・会社情報）
 *
 * - TOP（ホームに設定した固定ページ）の編集画面に、TOP の内容の下に出る。テンプレートでは theme_option('項目名') で取り出す。
 * - チョク採テンプレート共通の仕組み。案件ごとに変えるのは default（初期値）だけにする。
 * - URL の項目は「/job/」のようにサイト内のパスで書ける（theme_link() が home_url を付ける）。https:// から始まればそのまま。
 * - メニューはここではなく WordPress 標準のメニュー（外観 → カスタマイズ → メニュー）。仕組みは function/functions_menu.php。
 * - 画像は未設定ならテーマ内の画像（コメントのパス）を出す。ロゴは SVG をアップロードできないので PNG / WebP で入れる。
 */

/** ボタン（表示名・小さい文字・飛び先） */
$btn = function ($label, $text, $url, $url_note, $small = null) {
    $sub = array(
        'text' => array('label' => 'ボタンの文字', 'type' => 'text', 'default' => $text),
    );
    if ($small !== null) {
        $sub['small'] = array('label' => 'ボタンの上の小さい文字', 'type' => 'text', 'default' => $small, 'instructions' => '空欄なら出しません。');
    }
    $sub['url'] = array('label' => '飛び先', 'type' => 'text', 'default' => $url, 'instructions' => $url_note);
    return array('label' => $label, 'type' => 'group', 'sub_fields' => $sub);
};

$entry_note  = '空欄ならエントリーフォーム（/entry/）。';
$casual_note = '空欄ならカジュアル面談（/entry/?type=casual）。';

return array(
    'title'          => 'サイト共通（ヘッダー・フッター）',
    'location'       => array(array(array('param' => 'page_type', 'operator' => '==', 'value' => 'front_page'))),
    'menu_order'     => 10,
    'fields'         => array(

        'tab_header' => array('label' => '共通：ヘッダー', 'type' => 'tab'),
        'logo_image' => array('label' => 'ロゴ（色付き）', 'type' => 'image', 'instructions' => '未設定ならテーマの img/logo.svg。フッター・オープニングにも使います。'),
        'logo_image_white' => array('label' => 'ロゴ（白）', 'type' => 'image', 'instructions' => 'TOP の MV の上（透明ヘッダー）で使います。未設定ならテーマの img/logo_w.svg。'),
        'logo_alt' => array('label' => 'ロゴの代替テキスト（会社名）', 'type' => 'text', 'default' => 'BILTEC ビルテック株式会社'),
        'logo_sub' => array('label' => 'ロゴ横の文字', 'type' => 'text', 'default' => '中途採用サイト', 'instructions' => '空欄なら出しません。'),
        'header_btn_1' => $btn('ボタン1（黒）', '募集要項', '/job/', 'ヘッダー・SPメニュー・SP下部の固定ボタンに出します。'),
        'header_btn_2' => $btn('ボタン2（グラデーション）', 'まずは話を聞いてみる', '', $casual_note),

        'tab_nav' => array('label' => '共通：メニュー', 'type' => 'tab'),
        'nav_note' => array('label' => '', 'type' => 'message', 'message' => 'メニューは「外観 → カスタマイズ → メニュー」（または 外観 → メニュー）で編集します。位置は「グローバルメニュー」（ヘッダー・SPメニュー・フッターの列）と「フッター右の太字リンク」の2つです。'),

        'tab_cta' => array('label' => '共通：CTA', 'type' => 'tab'),
        'cta_note' => array('label' => '', 'type' => 'message', 'message' => '全ページの下に出る「流れる英文 → 街並み → ここまで読んでくださって〜」の部分です。'),
        'loop_text' => array('label' => '流れる英文', 'type' => 'text', 'default' => 'CONTRIBUTING TO URBAN LANDSCAPES AND THE ENVIRONMENT.'),
        'city_image' => array('label' => '街並みの画像（2400×412）', 'type' => 'image', 'instructions' => '未設定ならテーマの img/top/sec6_bg.webp。'),
        'cta_bg' => array('label' => '背景画像 PC（1440×600）', 'type' => 'image', 'instructions' => '未設定ならテーマの img/top/ft_bg.webp。'),
        'cta_bg_sp' => array('label' => '背景画像 SP', 'type' => 'image', 'instructions' => '未設定なら PC の画像（PC も未設定ならテーマの img/top/ft_bg_sp.webp）。'),
        'cta_title' => array('label' => '見出し', 'type' => 'textarea', 'rows' => 2, 'default' => "ここまで読んでくださって\nありがとうございます。"),
        'cta_text' => array('label' => '本文', 'type' => 'textarea', 'rows' => 3, 'default' => "「まずは実際の工場を見てみたい」「選考前に話を聞いてみたい」という方も大歓迎です。\nこの文章はダミーです。　この文章はダミーです。　この文章はダミーです。\nこの文章はダミーです。　この文章はダミーです。　この文章はダミーです。　この文章はダミーです。"),
        'cta_btn_1' => $btn('ボタン1（白）', 'カジュアル面談を申し込む', '', $casual_note, ''),
        'cta_btn_2' => $btn('ボタン2（グラデーション）', '直応募エントリーフォーム', '', $entry_note, '最速1分'),

        'tab_form' => array('label' => '共通：フォーム', 'type' => 'tab'),
        'form_note' => array('label' => '', 'type' => 'message', 'message' => 'チョク採フォーム（iframe）のURLです。エントリーページの埋め込みに使います。'),
        'form_entry_url' => array('label' => 'エントリーフォームのURL', 'type' => 'url', 'default' => ''),
        'form_casual_url' => array('label' => 'カジュアル面談フォームのURL', 'type' => 'url', 'default' => '', 'instructions' => 'エントリーと同じフォームなら空欄のままにしてください。'),

        'tab_company' => array('label' => '共通：会社情報', 'type' => 'tab'),
        'company_note' => array('label' => '', 'type' => 'message', 'message' => 'フッターとプライバシーポリシーに出します。'),
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
