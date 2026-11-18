<?php get_header(); ?>
<?php
/*
 * 事業紹介（固定ページ slug: business）
 * 文言は page-fields/business.php の初期値に書き、ここでは theme_field('項目名') で取り出す。
 * ページ固有のスタイルは assets/pages/business.css。
 */

/** テキストエリアの値を改行つきで出す */
$bz_text = function ($value) {
    return nl2br(esc_html(trim((string) $value)));
};

/** 英字の小見出し付きの heading-typeC */
$bz_heading = function ($en, $main, $small = '') {
    ?>
    <h2 class="heading-wrap heading-typeC heading-typeC--black bz-heading">
        <span class="bz-heading__en en js-fade"><?php echo esc_html($en); ?></span>
        <span class="heading-main js-lines"><?php echo esc_html($main); ?><?php if ($small) : ?><small class="bz-heading__small"><?php echo esc_html($small); ?></small><?php endif; ?></span>
        <span class="heading-line" aria-hidden="true"></span>
    </h2>
    <?php
};
?>

<main class="bz-main">

    <?php get_template_part('snippet/under-mv', null, array(
        'label'    => theme_field('bz_mv_label'),
        'title'    => theme_field('bz_mv_title'),
        'lead'     => theme_field('bz_mv_lead'),
        'image'    => 'business/1_2_main.webp',
        'image_id' => theme_field('bz_mv_image'),
    )); ?>

    <!-- About ビルテックについて -->
    <section class="bz-section bz-about">
        <div class="bz-inner">
            <?php $bz_heading(theme_field('bz_about_en'), theme_field('bz_about_heading')); ?>
            <p class="bz-lead js-fade"><?php echo $bz_text(theme_field('bz_about_lead')); ?></p>
            <p class="bz-text js-fade"><?php echo $bz_text(theme_field('bz_about_text')); ?></p>
        </div>
        <div class="bz-city js-fade">
            <img src="<?php echo esc_url(theme_img('top/sec6_bg.webp')); ?>" alt="" width="2400" height="412" loading="lazy">
        </div>
    </section>

    <!-- Mission 私たちのミッション -->
    <section class="bz-section bz-mission">
        <div class="bz-inner">
            <?php $bz_heading(theme_field('bz_mission_en'), theme_field('bz_mission_heading')); ?>
            <p class="bz-lead js-fade"><?php echo $bz_text(theme_field('bz_mission_lead')); ?></p>
            <p class="bz-text js-fade"><?php echo $bz_text(theme_field('bz_mission_text')); ?></p>
            <div class="bz-mission__images">
                <?php for ($i = 1; $i <= 2; $i++) : ?>
                    <div class="bz-mission__img js-fade">
                        <?php echo theme_image(theme_field('bz_mission_image_' . $i), 'business/1_2_0' . $i . '.webp', array('width' => 840, 'height' => 660)); ?>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
    </section>

    <!-- Advantage ビルテックの強み -->
    <section class="bz-section bz-strength">
        <div class="bz-inner">
            <?php $bz_heading(theme_field('bz_strength_en'), theme_field('bz_strength_heading')); ?>
        </div>
        <div class="media media-typeA">
            <?php for ($i = 1; $i <= 3; $i++) :
                $s = theme_field('bz_strength_' . $i);
                if (trim((string) $s['title']) === '' && trim((string) $s['text']) === '') continue; ?>
                <div class="media__item<?php echo $i % 2 === 0 ? ' media__item--reverse' : ''; ?>">
                    <div class="media__img js-fade">
                        <?php echo theme_image($s['image'], 'business/1_2_0' . ($i + 2) . '.webp', array('width' => 720, 'height' => 400)); ?>
                    </div>
                    <div class="media__body js-fade">
                        <h3 class="media__title"><?php echo $bz_text($s['title']); ?></h3>
                        <p class="media__text"><?php echo $bz_text($s['text']); ?></p>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </section>

    <!-- Product 手すりとは？ -->
    <section class="bz-section bz-product">
        <div class="bz-inner">
            <?php $bz_heading(theme_field('bz_product_en'), theme_field('bz_product_heading'), theme_field('bz_product_heading_sub')); ?>
            <p class="bz-lead js-fade"><?php echo $bz_text(theme_field('bz_product_lead')); ?></p>
            <p class="bz-text js-fade"><?php echo $bz_text(theme_field('bz_product_text')); ?></p>
            <ul class="bz-product__items">
                <?php for ($i = 1; $i <= 4; $i++) :
                    $p = theme_field('bz_product_' . $i);
                    if (trim((string) $p['title']) === '') continue; ?>
                    <li class="bz-product__item js-fade">
                        <div class="bz-product__img">
                            <?php echo theme_image($p['image'], 'business/1_2_item0' . $i . '.webp', array('width' => 840, 'height' => 660)); ?>
                        </div>
                        <h3 class="bz-product__title"><?php echo $bz_text($p['title']); ?></h3>
                        <p class="bz-product__text"><?php echo $bz_text($p['text']); ?></p>
                    </li>
                <?php endfor; ?>
            </ul>
        </div>
    </section>

</main>
<?php get_footer(); ?>
