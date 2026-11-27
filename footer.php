<?php
// 文言・画像はトップページの「共通：CTA」タブ（function/page-fields/top.php の common_*）、会社情報は会社概要ページの「会社基本情報」タブ
$company      = theme_company();
$nav          = theme_nav();
$loop_text    = theme_common('loop_text');
$cta_sp       = theme_pf_sp(theme_common('cta_bg'), theme_common('cta_bg_sp'));
$cta_btns     = array();
foreach (array(1 => 'btn--white', 2 => 'btn--gradient') as $n => $class) {
    $cta_btns[] = array('class' => $class, 'btn' => array(
        'text'  => trim((string) theme_common('cta_btn' . $n . '_label')),
        'small' => trim((string) theme_common('cta_btn' . $n . '_small')),
        'url'   => theme_pf_url(theme_common('cta_btn' . $n . '_link')),
    ));
}
$footer_links = theme_menu('footer'); // メニューの位置「フッター右の太字リンク」
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
    <img src="<?php echo esc_url(theme_pf_img(theme_common('city'))); ?>" alt="" width="2400" height="412" loading="lazy">
</div>

<section class="entry entry-typeB">
    <picture class="entry__bg">
        <?php if ($cta_sp) : ?><source srcset="<?php echo esc_url($cta_sp); ?>" media="(max-width: 768px)"><?php endif; ?>
        <img src="<?php echo esc_url(theme_pf_img(theme_common('cta_bg'))); ?>" alt="" width="1440" height="600" loading="lazy">
    </picture>
    <div class="entry__inner container">
        <h2 class="entry__title js-lines"><?php echo theme_pf_kses(theme_common('cta_title')); ?></h2>
        <p class="entry__text js-fade"><?php echo theme_pf_kses(theme_common('cta_text')); ?></p>
        <div class="entry__buttons js-fade">
            <?php foreach ($cta_btns as $b) :
                if ($b['btn']['text'] === '') continue; ?>
                <a href="<?php echo esc_url($b['btn']['url']); ?>" class="btn <?php echo esc_attr($b['class']); ?> btn--xl">
                    <span class="btn__text"><?php if ($b['btn']['small'] !== '') : ?><small><?php echo esc_html($b['btn']['small']); ?></small><?php endif; ?><?php echo esc_html($b['btn']['text']); ?></span><?php echo theme_chevron(); ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<footer class="footer footer-typeC">
    <div class="footer__inner container">
        <nav class="footer__nav" aria-label="フッターナビゲーション">
            <?php foreach ($nav as $item) :
                if (!$item['children']) continue; // 子のない項目（HOME など）はフッターに出さない ?>
                <div class="footer__col">
                    <p class="footer__heading"><?php echo esc_html($item['label']); ?></p>
                    <ul class="footer__links">
                        <?php foreach ($item['children'] as $child) : ?>
                            <li><a href="<?php echo esc_url($child['url']); ?>" class="footer__link"<?php echo theme_current_attr($child); ?>><span class="footer__dash">－</span><?php echo esc_html($child['label']); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
            <div class="footer__col">
                <ul class="footer__links footer__links--main">
                    <?php foreach ($footer_links as $link) : ?>
                        <li><a href="<?php echo esc_url($link['url'] ?: home_url('/')); ?>" class="footer__heading footer__link"<?php echo theme_current_attr($link); ?>><?php echo esc_html($link['label']); ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </nav>
        <div class="footer__company">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="footer__logo">
                <img src="<?php echo esc_url(theme_pf_img(theme_common('logo'))); ?>" alt="<?php echo esc_attr(theme_common('logo_alt')); ?>" width="200" height="38" loading="lazy">
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
