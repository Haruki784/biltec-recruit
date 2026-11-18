<?php
/**
 * under-mv-typeB：下層ページのMV（ヘッダー下にパンくずの白帯 → 全幅写真＋中央に小ラベル／H1／サブ／リード）
 *
 * get_template_part('snippet/under-mv', null, array(
 *     'label'    => '人と空のあいだに、安心と美しさを。', // 任意。H1の上の小さい文字
 *     'title'    => '私たちの想い',                       // 必須。H1
 *     'sub'      => 'MVV・第2創業',                        // 任意。H1の下の太字
 *     'lead'     => "1行目\n2行目",                        // 任意。改行可
 *     'image'    => 'philosophy/1_1_main.webp',            // img/ からのパス
 *     'image_sp' => 'philosophy/1_1_main_sp.webp',         // 任意
 *     'image_id' => 0,                                     // 任意。ACF の画像（あれば image より優先）
 * ));
 * 値は各ページの page-fields/<slug>.php に項目を作り、theme_field() で渡す。
 */
$a = wp_parse_args($args ?? array(), array(
    'label' => '', 'title' => get_the_title(), 'sub' => '', 'lead' => '',
    'image' => '', 'image_sp' => '', 'image_id' => 0,
));
?>
<section class="under-mv under-mv-typeB">
    <div class="under-mv__breadcrumb">
        <?php get_template_part('snippet/breadcrumb'); ?>
    </div>
    <div class="under-mv__visual">
        <picture class="under-mv__img">
            <?php if (!$a['image_id'] && $a['image_sp']) : ?>
                <source srcset="<?php echo esc_url(theme_img($a['image_sp'])); ?>" media="(max-width: 768px)">
            <?php endif; ?>
            <?php if ($a['image_id'] || $a['image']) {
                echo theme_image($a['image_id'], $a['image'], array('width' => 1440, 'height' => 380, 'loading' => 'eager', 'fetchpriority' => 'high'), 'full');
            } ?>
        </picture>
        <div class="under-mv__content container">
            <?php if ($a['label']) : ?>
                <p class="under-mv__label"><?php echo esc_html($a['label']); ?></p>
            <?php endif; ?>
            <h1 class="under-mv__title"><?php echo esc_html($a['title']); ?></h1>
            <?php if ($a['sub']) : ?>
                <p class="under-mv__sub"><?php echo esc_html($a['sub']); ?></p>
            <?php endif; ?>
            <?php if ($a['lead']) : ?>
                <p class="under-mv__lead"><?php echo nl2br(esc_html($a['lead'])); ?></p>
            <?php endif; ?>
        </div>
    </div>
</section>
