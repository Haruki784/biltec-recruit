<?php
$company   = theme_company();
$nav       = theme_nav();
$loop_text = theme_option('loop_text');
?>
<!-- ここから下（流れる英文・街並み・CTA・フッター）は全ページ共通 -->
<div class="loop loop-typeA site-loop" aria-hidden="true">
    <div class="loop__content flex">
        <?php for ($i = 0; $i < 2; $i++) : ?>
            <ul class="loop__items flex">
                <li class="loop__item en"><?php echo esc_html($loop_text); ?></li>
                <li class="loop__item en"><?php echo esc_html($loop_text); ?></li>
            </ul>
        <?php endfor; ?>
    </div>
</div>
<div class="cityscape js-city" aria-hidden="true">
    <img src="<?php echo esc_url(theme_img('top/sec6_bg.webp')); ?>" alt="" width="2400" height="412" loading="lazy">
</div>

<section class="entry entry-typeB">
    <picture class="entry__bg">
        <source srcset="<?php echo esc_url(theme_img('top/ft_bg_sp.webp')); ?>" media="(max-width: 768px)">
        <img src="<?php echo esc_url(theme_img('top/ft_bg.webp')); ?>" alt="" width="1440" height="600" loading="lazy">
    </picture>
    <div class="entry__inner container">
        <h2 class="entry__title js-lines"><?php echo nl2br(esc_html(theme_option('cta_title'))); ?></h2>
        <p class="entry__text js-fade"><?php echo nl2br(esc_html(theme_option('cta_text'))); ?></p>
        <div class="entry__buttons js-fade">
            <a href="<?php echo esc_url(theme_entry_url('casual')); ?>" class="btn btn--white btn--xl">
                <span class="btn__text">カジュアル面談を申し込む</span><?php echo theme_chevron(); ?>
            </a>
            <a href="<?php echo esc_url(theme_entry_url('entry')); ?>" class="btn btn--gradient btn--xl">
                <span class="btn__text"><small>最速1分</small>直応募エントリーフォーム</span><?php echo theme_chevron(); ?>
            </a>
        </div>
    </div>
</section>

<footer class="footer footer-typeC">
    <div class="footer__inner container">
        <nav class="footer__nav" aria-label="フッターナビゲーション">
            <?php foreach ($nav as $item) : ?>
                <div class="footer__col">
                    <p class="footer__heading"><?php echo esc_html($item['label']); ?></p>
                    <ul class="footer__links">
                        <?php foreach ($item['children'] as $child) : ?>
                            <li><a href="<?php echo esc_url($child['url']); ?>" class="footer__link"><span class="footer__dash">－</span><?php echo esc_html($child['label']); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
            <div class="footer__col">
                <ul class="footer__links footer__links--main">
                    <li><a href="<?php echo esc_url(home_url('/job/')); ?>" class="footer__heading footer__link">募集要項</a></li>
                    <li><a href="<?php echo esc_url(home_url('/entry/')); ?>" class="footer__heading footer__link">エントリーフォーム</a></li>
                    <li><a href="<?php echo esc_url(home_url('/privacy/')); ?>" class="footer__heading footer__link">プライバシーポリシー</a></li>
                </ul>
            </div>
        </nav>
        <div class="footer__company">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="footer__logo">
                <img src="<?php echo esc_url(theme_img('logo.svg')); ?>" alt="BILTEC ビルテック株式会社" width="200" height="38" loading="lazy">
            </a>
            <p class="footer__name"><?php echo esc_html($company['name']); ?></p>
            <p class="footer__address en"><?php echo esc_html($company['zip']); ?><br><?php echo esc_html($company['address']); ?><br><?php echo esc_html($company['building']); ?></p>
            <p class="footer__copy en">Copyright &copy;<?php echo esc_html($company['name_en']); ?> All rights reserved.</p>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>

</html>
