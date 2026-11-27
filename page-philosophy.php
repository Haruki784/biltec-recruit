<?php get_header(); ?>
<?php
/*
 * わたしたちの想い（固定ページ slug: philosophy）
 * 文言・画像は function/page-fields/philosophy.php の初期値に書き、ここでは theme_pf('項目名') で取り出す。
 * ページ固有のスタイル：assets/pages/philosophy.css
 */

/**
 * 「改行ごとに1行」の値を出す。各行は折り返さないかたまりにして、改行は SP だけで効かせる
 * （PC では入る分だけ1行につなげる）。
 */
$ph_lines = function ($value) {
    $html = array();
    foreach (theme_pf_lines($value) as $line) {
        $html[] = '<span class="ph-line">' . theme_pf_kses($line) . '</span>';
    }
    return implode('<br class="small-hide">', $html);
};

$mission = theme_pf('ph_mission');
$vision  = theme_pf('ph_vision');
$values  = theme_pf('ph_values');
?>

<main id="main" class="philosophy-main grid grid-1 gap-y-8">

    <div class="grid grid-1 gap-y-8">
        <!-- MV -->
        <?php get_template_part('snippet/under-mv', null, array(
            'label'    => theme_pf('ph_mv_label'),
            'title'    => theme_pf('ph_mv_title'),
            'sub'      => theme_pf('ph_mv_sub'),
            'lead'     => theme_pf('ph_mv_lead'),
            'image'    => theme_pf('ph_mv_image'),
            'image_sp' => theme_pf('ph_mv_image_sp'),
        )); ?>

        <!-- なぜ今「第2創業」なのか -->
        <section class="under-message ph-intro">
            <div class="container ph-intro__inner">
                <h2 class="ph-intro__title heading-2 js-lines"><?php echo $ph_lines(theme_pf('ph_intro_title')); ?></h2>
                <p class="ph-intro__lead js-fade"><?php echo theme_pf_kses(theme_pf('ph_intro_lead')); ?></p>
                <p class="ph-intro__text js-fade"><?php echo theme_pf_kses(theme_pf('ph_intro_text')); ?></p>
            </div>
        </section>
    </div>

    <!-- 流れる英文 -->
    <?php $loop_text = theme_pf('ph_loop_text'); ?>
    <div class="loop loop-typeA ph-loop" aria-hidden="true">
        <div class="loop__content flex">
            <?php for ($i = 0; $i < 2; $i++) : ?>
                <ul class="loop__items flex">
                    <?php for ($j = 0; $j < 3; $j++) : ?>
                        <li class="loop__item en"><?php echo esc_html($loop_text); ?></li>
                    <?php endfor; ?>
                </ul>
            <?php endfor; ?>
        </div>
    </div>

    <!-- 代表メッセージ -->
    <section class="president-message president-message-typeC background-secondary">
        <div class="president-message__inner">
            <h2 class="president-message__heading js-fade"><?php echo esc_html(theme_pf('ph_message_heading')); ?></h2>
            <span class="president-message__line" aria-hidden="true"></span>
            <p class="president-message__text js-fade"><?php echo theme_pf_kses(theme_pf('ph_message_text')); ?></p>
            <div class="president-message__img js-fade">
                <?php echo theme_pf_image(theme_pf('ph_message_image'), array('width' => 440, 'height' => 300)); ?>
            </div>
            <p class="president-message__name js-fade"><?php echo esc_html(theme_pf('ph_message_name')); ?></p>
        </div>
    </section>

    <!-- ビルテックの想い（MISSION / VISION / VALUES） -->
    <section class="mvv mvv-typeC">
        <div class="container">
            <h2 class="heading-wrap heading-typeC heading-typeC--black">
                <span class="heading-main js-lines"><?php echo esc_html(theme_pf('ph_mvv_heading')); ?></span>
            </h2>
        </div>

        <?php
        $blocks = array(
            array('data' => $mission, 'img' => 'philosophy/1_1_02.webp', 'h' => 660, 'mod' => 'mission'),
            array('data' => $vision, 'img' => 'philosophy/1_1_03.webp', 'h' => 740, 'mod' => 'vision'),
        );
        foreach ($blocks as $block) :
            $b = $block['data']; ?>
            <div class="mvv__block mvv__block--<?php echo esc_attr($block['mod']); ?>">
                <div class="mvv__bg js-parallax"><?php echo theme_pf_image($b['image'], array('width' => 1440, 'height' => $block['h']), 'full'); ?></div>
                <div class="mvv__inner">
                    <h3 class="mvv__head">
                        <span class="mvv__en en js-fade"><?php echo esc_html($b['en']); ?></span>
                        <span class="mvv__sub js-fade"><?php echo esc_html($b['sub']); ?></span>
                    </h3>
                    <p class="mvv__catch js-lines"><?php echo $ph_lines($b['catch']); ?></p>
                    <div class="mvv__box js-fade">
                        <p class="mvv__text"><?php echo theme_pf_kses($b['text']); ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="mvv__block mvv__block--values">
            <div class="mvv__bg js-parallax"><?php echo theme_pf_image($values['image'], array('width' => 1440, 'height' => 1470), 'full'); ?></div>
            <div class="mvv__inner">
                <h3 class="mvv__head">
                    <span class="mvv__en en js-fade"><?php echo esc_html($values['en']); ?></span>
                    <span class="mvv__sub js-fade"><?php echo esc_html($values['sub']); ?></span>
                </h3>
                <p class="mvv__catch js-lines"><?php echo $ph_lines($values['catch']); ?></p>
                <p class="mvv__lead js-fade"><?php echo $ph_lines($values['lead']); ?></p>
                <div class="mvv__box mvv__box--values">
                    <ul class="mvv__values">
                        <?php for ($i = 1; $i <= 5; $i++) :
                            $v = theme_pf('ph_value_' . $i);
                            if ($v['title'] === '' && $v['text'] === '') continue; ?>
                            <li class="mvv__value js-fade">
                                <div class="mvv__value-img"><?php echo theme_pf_image($v['image'], array('width' => 220, 'height' => 220)); ?></div>
                                <p class="mvv__value-no en">VALUE <?php echo esc_html(sprintf('%02d', $i)); ?></p>
                                <h4 class="mvv__value-title"><?php echo esc_html($v['title']); ?></h4>
                                <p class="mvv__value-text"><?php echo theme_pf_kses($v['text']); ?></p>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>

</main>
<?php get_footer(); ?>
