<?php

/**
 * functions_form.php を読み込む
 * テーマ固有の追加機能（フォームなど）を別ファイルに分離して管理している
 */
require_once get_template_directory() . '/function/functions_form.php';
require_once get_template_directory() . '/function/functions_page_fields.php';
require_once get_template_directory() . '/function/functions_site.php';

/**
 * テーマの基本機能を有効化（theme_setup）
 *
 * after_setup_theme フックで実行される初期設定。以下の機能を有効にしている：
 * - title-tag          : WordPressが<title>タグを自動管理する
 * - disable-layout-styles : Gutenbergが自動出力するレイアウト用CSSクラス（is-layout-flow等）を無効化
 * - post-thumbnails    : アイキャッチ画像機能を有効化
 * - html5              : 検索フォーム・コメント欄・ギャラリーなどをHTML5形式で出力
 * - custom-logo        : 管理画面からロゴ画像を設定できるようにする（最大400×100px、フレキシブルサイズ対応）
 * - responsive-embeds  : YouTube等の埋め込みコンテンツをレスポンシブ表示に対応させる
 * - automatic-feed-links : RSSフィードのリンクを<head>に自動追加する
 */
function theme_setup()
{
    add_theme_support('title-tag');
    add_theme_support('disable-layout-styles');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    add_theme_support('responsive-embeds');
    add_theme_support('automatic-feed-links');
}
add_action('after_setup_theme', 'theme_setup');

/**
 * CSS・JSの読み込み
 *
 * wp_enqueue_scripts フックを使い、テーマのJS（main.js）を正しく登録する。
 * jQueryはWordPressにバンドル済みのものを依存関係として指定することで、
 * CDNから重複読み込みせず、wp_footer() のタイミングで自動出力される。
 */
function theme_enqueue_scripts()
{
    wp_enqueue_script(
        'splide',
        'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js',
        [],
        null,
        true
    );
    // 更新日時をバージョンにして、修正後にブラウザのキャッシュが残らないようにする
    wp_enqueue_script(
        'theme-main',
        get_stylesheet_directory_uri() . '/assets/main.js',
        ['jquery'],
        filemtime(get_stylesheet_directory() . '/assets/main.js'),
        true
    );
    wp_enqueue_script(
        'theme-add',
        get_stylesheet_directory_uri() . '/add.js',
        ['jquery', 'splide'],
        filemtime(get_stylesheet_directory() . '/add.js'),
        true
    );
}
add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');

/**
 * 固定ページに抜粋機能を追加
 */
add_post_type_support('page', 'excerpt');


/**
 * アーカイブページのメインクエリを調整
 *
 * カスタム WP_Query でページネーションを使う場合、
 * メインクエリが同じ posts_per_page を持っていないと
 * 存在しないページとして404になる。
 */
add_action('pre_get_posts', function ($query) {
    if (!is_admin() && $query->is_main_query() && $query->is_archive()) {
        // 先輩インタビュー一覧は4列なので12件、ほかは9件
        $query->set('posts_per_page', $query->is_post_type_archive('interview') ? 12 : 9);
    }
});

/*
 * 先輩インタビューは CPT「interview」（function/functions_site.php）に移した。
 * 以前の「投稿（post）に /interview/ のアーカイブを付けるフィルター」は削除。
 */

/**
 * 抜粋テキストの文字数と末尾記号をカスタマイズ
 *
 * WordPressが自動生成する投稿の抜粋（excerpt）を日本語向けに調整している。
 * - 文字数を80文字に変更（デフォルトは55単語）
 * - 末尾に付く「[…]」を「...」（三点リーダー）に変更
 */
function custom_excerpt_length($length)
{
    return 80;
}
add_filter('excerpt_length', 'custom_excerpt_length');

function custom_excerpt_more($more)
{
    return '...';
}
add_filter('excerpt_more', 'custom_excerpt_more');

/**
 * カスタム画像サイズの追加
 *
 * メディアアップロード時に自動生成するリサイズ済み画像のサイズを独自に定義している。
 * 第4引数の true はトリミング（クロップ）あり＝指定サイズに切り抜きを行うことを意味する。
 * - custom-thumbnail : 300×200px（一覧サムネイル用）
 * - custom-medium    : 600×400px（中サイズ表示用）
 * - custom-large     : 1200×800px（大サイズ・メインビジュアル用）
 */
add_image_size('custom-thumbnail', 300, 200, true);
add_image_size('custom-medium', 600, 400, true);
add_image_size('custom-large', 1200, 800, true);

/**
 * 固定ページでの自動pタグ・brタグ挿入を無効化
 *
 * WordPressはデフォルトでコンテンツ内の改行を自動的に<p>や<br>に変換する（wpautop）。
 * 固定ページ（is_page()）ではHTMLを直接書くケースが多く、
 * 意図しないタグ挿入でレイアウトが崩れやすいため、固定ページのみ無効化している。
 * 通常の投稿（ブログ記事）は引き続き自動変換が有効のまま。
 */
function disable_wpautop_for_pages()
{
    if (is_page()) {
        remove_filter('the_content', 'wpautop');
        remove_filter('the_excerpt', 'wpautop');
    }
}
add_action('wp', 'disable_wpautop_for_pages');

/**
 * Contact Form 7 の自動pタグ・brタグ挿入を無効化
 *
 * Contact Form 7 プラグインもデフォルトでフォームのHTMLに<p>や<br>を自動挿入するが、
 * これによりフォームのレイアウトが崩れることがあるため、無効化している。
 */
add_filter('wpcf7_autop_or_not', '__return_false');

/**
 * カスタムブロックパターンカテゴリの登録
 */

function theme_register_patterns()
{
    register_block_pattern_category('interview', ['label' => 'インタビュー']);

    register_block_pattern('theme/interview-section', [
        'title'      => 'インタビュー：質問・回答',
        'categories' => ['interview'],
        'content'    => '<!-- wp:group {"anchor":"index01","className":"article","tagName":"article"} --><article class="wp-block-group article" id="index01"><!-- wp:group {"className":"container"} --><div class="wp-block-group container"><!-- wp:heading {"level":2,"className":"heading-4 article__title py-1 px-2 mb-4"} --><h2 class="wp-block-heading heading-4 article__title py-1 px-2 mb-4">セクションタイトル</h2><!-- /wp:heading --><!-- wp:group {"className":"article__content grid grid-1 gap-y-2"} --><div class="wp-block-group article__content grid grid-1 gap-y-2"><!-- wp:paragraph {"className":"article__question bold"} --><p class="article__question bold">質問テキスト</p><!-- /wp:paragraph --><!-- wp:paragraph {"className":"article__answer"} --><p class="article__answer">回答テキスト</p><!-- /wp:paragraph --><!-- wp:group {"className":"article__img"} --><div class="wp-block-group article__img"><!-- wp:image --><figure class="wp-block-image"><img src="" alt=""/></figure><!-- /wp:image --></div><!-- /wp:group --></div><!-- /wp:group --></div><!-- /wp:group --></article><!-- /wp:group -->',
    ]);

    register_block_pattern('theme/interview-schedule', [
        'title'      => 'インタビュー：スケジュール',
        'categories' => ['interview'],
        'content'    => '<!-- wp:group {"anchor":"index-schedule","className":"article","tagName":"article"} --><article class="wp-block-group article" id="index-schedule"><!-- wp:group {"className":"schedule schedule-typeA"} --><div class="wp-block-group schedule schedule-typeA"><!-- wp:group {"className":"container"} --><div class="wp-block-group container"><!-- wp:heading {"level":2,"className":"heading-4 article__heading mb-4 pb-2"} --><h2 class="wp-block-heading heading-4 article__heading mb-4 pb-2">一日のスケジュール</h2><!-- /wp:heading --><!-- wp:group {"className":"schedule__items flex flex-1 gap-x-4","tagName":"ul"} --><ul class="wp-block-group schedule__items flex flex-1 gap-x-4"><!-- wp:group {"className":"schedule__item flex pb-4 col","tagName":"li"} --><li class="wp-block-group schedule__item flex pb-4 col"><!-- wp:paragraph {"className":"schedule__time heading-4"} --><p class="schedule__time heading-4">10:00</p><!-- /wp:paragraph --><!-- wp:group {"className":"schedule__box"} --><div class="wp-block-group schedule__box"><!-- wp:heading {"level":2,"className":"schedule__title heading-4 mb-1"} --><h2 class="wp-block-heading schedule__title heading-4 mb-1">タイトル</h2><!-- /wp:heading --><!-- wp:paragraph {"className":"schedule__text"} --><p class="schedule__text">テキスト</p><!-- /wp:paragraph --></div><!-- /wp:group --></li><!-- /wp:group --><!-- wp:group {"className":"schedule__item flex pb-4 col","tagName":"li"} --><li class="wp-block-group schedule__item flex pb-4 col"><!-- wp:paragraph {"className":"schedule__time heading-4"} --><p class="schedule__time heading-4">11:00</p><!-- /wp:paragraph --><!-- wp:group {"className":"schedule__box"} --><div class="wp-block-group schedule__box"><!-- wp:heading {"level":2,"className":"schedule__title heading-4 mb-1"} --><h2 class="wp-block-heading schedule__title heading-4 mb-1">タイトル</h2><!-- /wp:heading --><!-- wp:paragraph {"className":"schedule__text"} --><p class="schedule__text">テキスト</p><!-- /wp:paragraph --></div><!-- /wp:group --></li><!-- /wp:group --><!-- wp:group {"className":"schedule__item flex pb-4 col","tagName":"li"} --><li class="wp-block-group schedule__item flex pb-4 col"><!-- wp:paragraph {"className":"schedule__time heading-4"} --><p class="schedule__time heading-4">12:00</p><!-- /wp:paragraph --><!-- wp:group {"className":"schedule__box"} --><div class="wp-block-group schedule__box"><!-- wp:heading {"level":2,"className":"schedule__title heading-4 mb-1"} --><h2 class="wp-block-heading schedule__title heading-4 mb-1">タイトル</h2><!-- /wp:heading --><!-- wp:paragraph {"className":"schedule__text"} --><p class="schedule__text">テキスト</p><!-- /wp:paragraph --></div><!-- /wp:group --></li><!-- /wp:group --><!-- wp:group {"className":"schedule__item flex pb-4 col","tagName":"li"} --><li class="wp-block-group schedule__item flex pb-4 col"><!-- wp:paragraph {"className":"schedule__time heading-4"} --><p class="schedule__time heading-4">13:00</p><!-- /wp:paragraph --><!-- wp:group {"className":"schedule__box"} --><div class="wp-block-group schedule__box"><!-- wp:heading {"level":2,"className":"schedule__title heading-4 mb-1"} --><h2 class="wp-block-heading schedule__title heading-4 mb-1">タイトル</h2><!-- /wp:heading --><!-- wp:paragraph {"className":"schedule__text"} --><p class="schedule__text">テキスト</p><!-- /wp:paragraph --></div><!-- /wp:group --></li><!-- /wp:group --><!-- wp:group {"className":"schedule__item flex pb-4 col","tagName":"li"} --><li class="wp-block-group schedule__item flex pb-4 col"><!-- wp:paragraph {"className":"schedule__time heading-4"} --><p class="schedule__time heading-4">14:00</p><!-- /wp:paragraph --><!-- wp:group {"className":"schedule__box"} --><div class="wp-block-group schedule__box"><!-- wp:heading {"level":2,"className":"schedule__title heading-4 mb-1"} --><h2 class="wp-block-heading schedule__title heading-4 mb-1">タイトル</h2><!-- /wp:heading --><!-- wp:paragraph {"className":"schedule__text"} --><p class="schedule__text">テキスト</p><!-- /wp:paragraph --></div><!-- /wp:group --></li><!-- /wp:group --><!-- wp:group {"className":"schedule__item flex pb-4 col","tagName":"li"} --><li class="wp-block-group schedule__item flex pb-4 col"><!-- wp:paragraph {"className":"schedule__time heading-4"} --><p class="schedule__time heading-4">15:00</p><!-- /wp:paragraph --><!-- wp:group {"className":"schedule__box"} --><div class="wp-block-group schedule__box"><!-- wp:heading {"level":2,"className":"schedule__title heading-4 mb-1"} --><h2 class="wp-block-heading schedule__title heading-4 mb-1">タイトル</h2><!-- /wp:heading --><!-- wp:paragraph {"className":"schedule__text"} --><p class="schedule__text">テキスト</p><!-- /wp:paragraph --></div><!-- /wp:group --></li><!-- /wp:group --></ul><!-- /wp:group --></div><!-- /wp:group --></div><!-- /wp:group --></article><!-- /wp:group -->',
    ]);
    register_block_pattern('theme/interview-schedule-c', [
        'title'      => 'インタビュー：スケジュール（テーブル型）',
        'categories' => ['interview'],
        'content'    => '<!-- wp:group {"anchor":"index-schedule-c","className":"article","tagName":"article"} --><article class="wp-block-group article" id="index-schedule-c"><!-- wp:group {"className":"schedule schedule-typeC"} --><div class="wp-block-group schedule schedule-typeC"><!-- wp:group {"className":"container"} --><div class="wp-block-group container"><!-- wp:group {"className":"schedule__items","tagName":"ul"} --><ul class="wp-block-group schedule__items"><!-- wp:group {"className":"schedule__item","tagName":"li"} --><li class="wp-block-group schedule__item"><!-- wp:html --><p class="schedule__time"><span class="px-1">10:00～10:30</span></p><!-- /wp:html --><!-- wp:group {"className":"schedule__body pb-4 grid grid-1 gap-y-1"} --><div class="wp-block-group schedule__body pb-4 grid grid-1 gap-y-1"><!-- wp:heading {"level":2,"className":"schedule__title heading-4"} --><h2 class="wp-block-heading schedule__title heading-4">タイトル</h2><!-- /wp:heading --><!-- wp:paragraph {"className":"schedule__text"} --><p class="schedule__text">テキスト</p><!-- /wp:paragraph --></div><!-- /wp:group --></li><!-- /wp:group --><!-- wp:group {"className":"schedule__item","tagName":"li"} --><li class="wp-block-group schedule__item"><!-- wp:html --><p class="schedule__time"><span class="px-1">11:00～11:30</span></p><!-- /wp:html --><!-- wp:group {"className":"schedule__body pb-4 grid grid-1 gap-y-1"} --><div class="wp-block-group schedule__body pb-4 grid grid-1 gap-y-1"><!-- wp:heading {"level":2,"className":"schedule__title heading-4"} --><h2 class="wp-block-heading schedule__title heading-4">タイトル</h2><!-- /wp:heading --><!-- wp:paragraph {"className":"schedule__text"} --><p class="schedule__text">テキスト</p><!-- /wp:paragraph --></div><!-- /wp:group --></li><!-- /wp:group --><!-- wp:group {"className":"schedule__item","tagName":"li"} --><li class="wp-block-group schedule__item"><!-- wp:html --><p class="schedule__time"><span class="px-1">12:00～13:00</span></p><!-- /wp:html --><!-- wp:group {"className":"schedule__body pb-4 grid grid-1 gap-y-1"} --><div class="wp-block-group schedule__body pb-4 grid grid-1 gap-y-1"><!-- wp:heading {"level":2,"className":"schedule__title heading-4"} --><h2 class="wp-block-heading schedule__title heading-4">タイトル</h2><!-- /wp:heading --><!-- wp:paragraph {"className":"schedule__text"} --><p class="schedule__text">テキスト</p><!-- /wp:paragraph --></div><!-- /wp:group --></li><!-- /wp:group --><!-- wp:group {"className":"schedule__item","tagName":"li"} --><li class="wp-block-group schedule__item"><!-- wp:html --><p class="schedule__time"><span class="px-1">13:00～14:00</span></p><!-- /wp:html --><!-- wp:group {"className":"schedule__body pb-4 grid grid-1 gap-y-1"} --><div class="wp-block-group schedule__body pb-4 grid grid-1 gap-y-1"><!-- wp:heading {"level":2,"className":"schedule__title heading-4"} --><h2 class="wp-block-heading schedule__title heading-4">タイトル</h2><!-- /wp:heading --><!-- wp:paragraph {"className":"schedule__text"} --><p class="schedule__text">テキスト</p><!-- /wp:paragraph --></div><!-- /wp:group --></li><!-- /wp:group --><!-- wp:group {"className":"schedule__item","tagName":"li"} --><li class="wp-block-group schedule__item"><!-- wp:html --><p class="schedule__time"><span class="px-1">14:00～15:00</span></p><!-- /wp:html --><!-- wp:group {"className":"schedule__body pb-4 grid grid-1 gap-y-1"} --><div class="wp-block-group schedule__body pb-4 grid grid-1 gap-y-1"><!-- wp:heading {"level":2,"className":"schedule__title heading-4"} --><h2 class="wp-block-heading schedule__title heading-4">タイトル</h2><!-- /wp:heading --><!-- wp:paragraph {"className":"schedule__text"} --><p class="schedule__text">テキスト</p><!-- /wp:paragraph --></div><!-- /wp:group --></li><!-- /wp:group --></ul><!-- /wp:group --></div><!-- /wp:group --></div><!-- /wp:group --></article><!-- /wp:group -->',
    ]);

    register_block_pattern('theme/interview-schedule-b', [
        'title'      => 'インタビュー：スケジュール（縦型）',
        'categories' => ['interview'],
        'content'    => '<!-- wp:group {"anchor":"index-schedule-b","className":"article","tagName":"article"} --><article class="wp-block-group article" id="index-schedule-b"><!-- wp:group {"className":"schedule schedule-typeB"} --><div class="wp-block-group schedule schedule-typeB"><!-- wp:group {"className":"container"} --><div class="wp-block-group container"><!-- wp:heading {"level":2,"className":"heading-4 article__heading mb-4 pb-2"} --><h2 class="wp-block-heading heading-4 article__heading mb-4 pb-2">一日のスケジュール</h2><!-- /wp:heading --><!-- wp:group {"className":"schedule__items","tagName":"ul"} --><ul class="wp-block-group schedule__items"><!-- wp:group {"className":"schedule__item flex","tagName":"li"} --><li class="wp-block-group schedule__item flex"><!-- wp:paragraph {"className":"schedule__time heading-4"} --><p class="schedule__time heading-4">08:45</p><!-- /wp:paragraph --><!-- wp:html --><div class="schedule__icon"><span class="schedule__circle"></span></div><!-- /wp:html --><!-- wp:group {"className":"schedule__content pb-4"} --><div class="wp-block-group schedule__content pb-4"><!-- wp:heading {"level":2,"className":"schedule__title heading-4 mb-2"} --><h2 class="wp-block-heading schedule__title heading-4 mb-2">タイトル</h2><!-- /wp:heading --><!-- wp:paragraph {"className":"schedule__text"} --><p class="schedule__text">テキスト</p><!-- /wp:paragraph --></div><!-- /wp:group --></li><!-- /wp:group --><!-- wp:group {"className":"schedule__item flex","tagName":"li"} --><li class="wp-block-group schedule__item flex"><!-- wp:paragraph {"className":"schedule__time heading-4"} --><p class="schedule__time heading-4">10:00</p><!-- /wp:paragraph --><!-- wp:html --><div class="schedule__icon"><span class="schedule__circle"></span></div><!-- /wp:html --><!-- wp:group {"className":"schedule__content pb-4"} --><div class="wp-block-group schedule__content pb-4"><!-- wp:heading {"level":2,"className":"schedule__title heading-4 mb-2"} --><h2 class="wp-block-heading schedule__title heading-4 mb-2">タイトル</h2><!-- /wp:heading --><!-- wp:paragraph {"className":"schedule__text"} --><p class="schedule__text">テキスト</p><!-- /wp:paragraph --></div><!-- /wp:group --></li><!-- /wp:group --><!-- wp:group {"className":"schedule__item flex","tagName":"li"} --><li class="wp-block-group schedule__item flex"><!-- wp:paragraph {"className":"schedule__time heading-4"} --><p class="schedule__time heading-4">12:00</p><!-- /wp:paragraph --><!-- wp:html --><div class="schedule__icon"><span class="schedule__circle"></span></div><!-- /wp:html --><!-- wp:group {"className":"schedule__content pb-4"} --><div class="wp-block-group schedule__content pb-4"><!-- wp:heading {"level":2,"className":"schedule__title heading-4 mb-2"} --><h2 class="wp-block-heading schedule__title heading-4 mb-2">タイトル</h2><!-- /wp:heading --><!-- wp:paragraph {"className":"schedule__text"} --><p class="schedule__text">テキスト</p><!-- /wp:paragraph --></div><!-- /wp:group --></li><!-- /wp:group --><!-- wp:group {"className":"schedule__item flex","tagName":"li"} --><li class="wp-block-group schedule__item flex"><!-- wp:paragraph {"className":"schedule__time heading-4"} --><p class="schedule__time heading-4">14:00</p><!-- /wp:paragraph --><!-- wp:html --><div class="schedule__icon"><span class="schedule__circle"></span></div><!-- /wp:html --><!-- wp:group {"className":"schedule__content pb-4"} --><div class="wp-block-group schedule__content pb-4"><!-- wp:heading {"level":2,"className":"schedule__title heading-4 mb-2"} --><h2 class="wp-block-heading schedule__title heading-4 mb-2">タイトル</h2><!-- /wp:heading --><!-- wp:paragraph {"className":"schedule__text"} --><p class="schedule__text">テキスト</p><!-- /wp:paragraph --></div><!-- /wp:group --></li><!-- /wp:group --><!-- wp:group {"className":"schedule__item flex","tagName":"li"} --><li class="wp-block-group schedule__item flex"><!-- wp:paragraph {"className":"schedule__time heading-4"} --><p class="schedule__time heading-4">18:00</p><!-- /wp:paragraph --><!-- wp:html --><div class="schedule__icon"><span class="schedule__circle"></span></div><!-- /wp:html --><!-- wp:group {"className":"schedule__content"} --><div class="wp-block-group schedule__content"><!-- wp:heading {"level":2,"className":"schedule__title heading-4 mb-2"} --><h2 class="wp-block-heading schedule__title heading-4 mb-2">タイトル</h2><!-- /wp:heading --><!-- wp:paragraph {"className":"schedule__text"} --><p class="schedule__text">テキスト</p><!-- /wp:paragraph --></div><!-- /wp:group --></li><!-- /wp:group --></ul><!-- /wp:group --></div><!-- /wp:group --></div><!-- /wp:group --></article><!-- /wp:group -->',
    ]);
}
add_action('init', 'theme_register_patterns');
