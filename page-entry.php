<?php
get_header();
/*
 * エントリーフォーム（固定ページ slug: entry）
 * チョク採フォーム（iframe）を埋め込むだけのページ。Contact Form 7 は使わない。
 * 埋め込みはチョク採から受け取ったコードのまま（iframe の属性と form-embed.js をセットで。スクリプトを消すとフォームが途中で切れる）。
 * URL はここに初期値（$default_form_url）を持たせ、トップページの「共通：フォーム」タブに入力したときだけそちらを優先する（theme_form_src()）。
 * ?type=casual で開いたとき（「まずは話を聞いてみる」「カジュアル面談を申し込む」）はカジュアル面談用の URL を使う。
 * カジュアル面談用が空欄ならエントリーと同じフォームを出す。
 */
$is_casual = isset($_GET['type']) && $_GET['type'] === 'casual';
$default_form_url = 'https://biltec.chokusai.jp/ats/forms/form-20261125-7yi5r?hideTitle=true&hideDescription=true';
$src       = theme_form_src($is_casual ? 'casual' : 'entry') ?: $default_form_url;
// 高さを自動調整するスクリプトは、フォームと同じドメインの /ats/assets/embed/form-embed.js
$embed_js  = 'https://' . wp_parse_url($src, PHP_URL_HOST) . '/ats/assets/embed/form-embed.js';
?>

<main id="main">
    <section class="entry-form py-9">
        <div class="container grid grid-1 gap-y-8">
            <?php get_template_part('snippet/breadcrumb'); ?>
            <div class="entry-form__head grid grid-1 gap-y-2">
                <h1 class="entry-form__heading heading-3">
                    <?php echo $is_casual ? 'カジュアル面談のお申し込み' : 'エントリーフォーム'; ?>
                </h1>
                <p class="entry-form__lead">
                    <?php if ($is_casual) : ?>
                        「まずは話を聞いてみたい」「工場を見てみたい」という方も歓迎です。下記のフォームからお気軽にお申し込みください。
                    <?php else : ?>
                        下記のフォームに必要事項をご入力のうえ、送信してください。内容を確認し、担当者よりご連絡いたします。
                    <?php endif; ?>
                </p>
            </div>
            <div class="entry-form__body">
                <?php if ($src) : ?>
                    <iframe
                        class="entry-form__iframe"
                        src="<?php echo esc_url($src); ?>"
                        width="100%"
                        height="800"
                        frameborder="0"
                        style="border: none; display: block; max-width: 800px; min-height: 200px; width: 100%;"
                        title="<?php echo $is_casual ? 'カジュアル面談のお申し込みフォーム' : 'エントリーフォーム'; ?>"
                        data-chokusai-form
                    ></iframe>
                    <!-- フォームの高さを自動調整するスクリプトです。削除するとフォームが途中で切れて表示されます。iframeと必ずセットで貼り付けてください。 -->
                    <script src="<?php echo esc_url($embed_js); ?>" async></script>
                <?php else : ?>
                    <p class="entry-form__empty">ただいまフォームを準備しています。公開まで今しばらくお待ちください。</p>
                <?php endif; ?>
            </div>
            <p class="entry-form__privacy caption">
                ご入力いただいた個人情報は、<a href="<?php echo esc_url(home_url('/privacy/')); ?>">採用活動におけるプライバシーポリシー</a>に基づき適切に取り扱います。
            </p>
        </div>
    </section>
</main>

<?php get_footer(); ?>
