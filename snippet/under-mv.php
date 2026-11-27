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
 * image / image_sp は img/ からのパスか添付ファイルID。固定ページは function/page-fields/<slug>.php の項目を theme_pf() でそのまま渡す。
 * カスタム投稿は post-fields/*.php の画像を image_id で渡す（theme_field()）。
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
        <?php
        // PC：image_id（カスタム投稿の ACF）> image（添付ファイルID か img/ からのパス。theme_pf() の値をそのまま渡せる）
        // SP：image_sp を選んでいればその画像。PC だけ選んでいるときは PC の画像を SP でも出す
        $pc = $a['image_id'] ?: $a['image'];
        $sp = $a['image_sp'] ? theme_pf_sp($pc, $a['image_sp']) : '';
        ?>
        <picture class="under-mv__img">
            <?php if ($sp) : ?>
                <source srcset="<?php echo esc_url($sp); ?>" media="(max-width: 768px)">
            <?php endif; ?>
            <?php if ($pc) {
                echo theme_pf_image($pc,array('width' => 1440, 'height' => 380, 'loading' => 'eager', 'fetchpriority' => 'high'), 'full');
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
                <p class="under-mv__lead"><?php echo theme_text($a['lead']); ?></p>
            <?php endif; ?>
        </div>
    </div>
    <?php if ($a['lead']) : ?>
        <p class="under-mv__lead under-mv__lead--sp small-hide container"><?php echo theme_text($a['lead']); ?></p>
    <?php endif; ?>
</section>
