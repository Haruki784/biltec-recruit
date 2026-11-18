<?php
get_header();
?>

<main>
    <div class="grid grid-1 gap-y-9">
        <section class="under-mv under-mv-typeA pb-5">
            <div class="under-mv__img">
                <picture>
                    <source srcset="https://placehold.jp/375x280.png" media="(max-width: 768px)">
                    <img src="https://placehold.jp/1440x480.png" alt="">
                </picture>
            </div>
            <div class="under-mv__container container pt-6 pb-5 py-5-sp-full grid grid-1 gap-y-1-full">
                <h1 class="under-mv__title heading-1-full en">Cross Talk</h1>
                <div class="under-mv__subtitle heading-4-full">クロストーク</div>
            </div>
            <?php get_template_part('snippet/breadcrumb'); ?>
        </section>
        <section class="under-message">
            <div class="container">
                <div class="under-message__box grid grid-1 gap-y-4">
                    <h2 class="heading-4 under-message">
                        Navix株式会社は、<br>
                        クリエイティブとテクノロジーを融合し、<br>
                        ブランド・サービス・社会の新しい体験をデザインする会社です。
                    </h2>
                    <p>
                        創造力と先端技術を掛け合わせ、人と企業をつなぐ"ひとつ先の体験"を、ワンストップで共創・支援しています。<br>
                        アクセシビリティとユーザビリティの向上に取り組み、<br>
                        ウェブサイトも、システムも、「誰もが快適に使える」社会の実現を目指しています。
                    </p>
                </div>
            </div>
            <div class="loop loop-typeA mt-5">
                <div class="loop__content flex">
                    <ul class="loop__items flex">
                        <li class="loop__item heading-1 semibold" style="color: var(--tertiary);">Navigating the Future with Creative Technology. </li>
                        <li class="loop__item heading-1 semibold" style="color: var(--tertiary);">Navigating the Future with Creative Technology. </li>
                        <li class="loop__item heading-1 semibold" style="color: var(--tertiary);">Navigating the Future with Creative Technology. </li>
                        <li class="loop__item heading-1 semibold" style="color: var(--tertiary);">Navigating the Future with Creative Technology. </li>
                    </ul>
                    <ul class="loop__items flex" aria-hidden="true">
                        <li class="loop__item heading-1 semibold" style="color: var(--tertiary);">Navigating the Future with Creative Technology. </li>
                        <li class="loop__item heading-1 semibold" style="color: var(--tertiary);">Navigating the Future with Creative Technology. </li>
                        <li class="loop__item heading-1 semibold" style="color: var(--tertiary);">Navigating the Future with Creative Technology. </li>
                        <li class="loop__item heading-1 semibold" style="color: var(--tertiary);">Navigating the Future with Creative Technology. </li>
                    </ul>
                </div>
            </div>
        </section>
    </div>
</main>

<?php get_footer(); ?>