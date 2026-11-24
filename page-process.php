<?php get_header(); ?>
<?php
/*
 * 手すりができるまで（固定ページ slug: process）
 * 文言は page-fields/process.php の初期値に書き、ここでは theme_field('項目名') で取り出す。
 * ページ固有のスタイル：assets/pages/process.css（flow-typeE / process-team）
 */
/** テキストエリアの値を改行つきで出す */
$text = function ($value) {
    return nl2br(esc_html($value));
};
/** 見出し：改行は SP だけで効かせる（small-hide = SPのみ表示） */
$sp_br = function ($value) {
    $lines = array_filter(array_map('trim', preg_split('/\R/u', (string) $value)), 'strlen');
    return implode('<br class="small-hide">', array_map('esc_html', $lines));
};
$arrow ='<svg class="flow__arrow" width="136" height="70" viewBox="0 0 136 70" aria-hidden="true"><polyline points="2,2 68,67 134,2" fill="none" stroke="currentColor" stroke-width="3"/></svg>';
?>

<main id="main" class="process-main">

    <?php get_template_part('snippet/under-mv', null, array(
        'label'    => theme_field('pr_mv_label'),
        'title'    => theme_field('pr_mv_title'),
        'lead'     => theme_field('pr_mv_lead'),
        'image'    => 'process/2_2_main.webp',
        'image_sp' => 'process/2_2_main_sp.webp',
        'image_id' => theme_field('pr_mv_image'),
    )); ?>

    <!-- リード文 -->
    <section class="process-lead">
        <div class="container">
            <p class="process-lead__text js-fade"><?php echo $text(theme_field('pr_lead')); ?></p>
        </div>
    </section>

    <!-- プロジェクトの流れ（5つのステップ） -->
    <section class="process-flow">
        <div class="container">
            <h2 class="heading-wrap heading-typeC heading-typeC--s">
                <span class="heading-main js-lines"><?php echo $sp_br(theme_field('pr_flow_heading')); ?></span>
            </h2>
        </div>
        <ol class="flow flow-typeE">
            <?php for ($i = 1; $i <= 5; $i++) :
                $s = theme_field('pr_step_' . $i); ?>
                <li class="flow__item">
                    <div class="flow__inner">
                        <div class="flow__main">
                            <div class="flow__img js-fade">
                                <?php echo theme_image($s['image'], 'process/2_2_0' . $i . '.webp', array('width' => 840, 'height' => 660)); ?>
                            </div>
                            <div class="flow__body js-fade">
                                <h3 class="flow__title"><span class="flow__step en">STEP <?php echo sprintf('%02d', $i); ?></span><span class="flow__sep" aria-hidden="true">｜</span><?php echo esc_html($s['title']); ?></h3>
                                <?php if ($s['tag'] !== '') : ?>
                                    <p class="flow__tag">募集職種：<?php echo esc_html($s['tag']); ?></p>
                                <?php endif; ?>
                                <div class="flow__text">
                                    <p class="flow__label"><?php echo esc_html($s['work_label']); ?></p>
                                    <p><?php echo $text($s['work']); ?></p>
                                </div>
                            </div>
                        </div>
                        <?php if ($s['appeal'] !== '') : ?>
                            <div class="flow__appeal js-fade">
                                <p class="flow__label">仕事のやりがい・魅力：</p>
                                <p><?php echo $text($s['appeal']); ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php if ($i < 5) echo $arrow; ?>
                </li>
            <?php endfor; ?>
        </ol>
    </section>

    <!-- 自社一貫体制だからこそのチームワーク -->
    <section class="process-team">
        <div class="container">
            <img src="<?php echo esc_url(theme_img('logo.svg')); ?>" alt="BILTEC" width="200" height="38" class="process-team__logo js-fade" loading="lazy">
            <h2 class="heading-wrap heading-typeC heading-typeC--s">
                <span class="heading-main js-lines"><?php echo $sp_br(theme_field('pr_team_heading')); ?></span>
            </h2>
            <p class="process-team__text js-fade"><?php echo $text(theme_field('pr_team_text')); ?></p>
        </div>
        <div class="scroll scroll-typeA process-team__scroll" aria-hidden="true">
            <div class="scroll__content">
                <?php
                $team_imgs = array('2_2_slide01', '2_2_slide02', '2_2_slide03', '2_2_slide04', '2_2_extra');
                for ($loop = 0; $loop < 2; $loop++) : ?>
                    <ul class="scroll__items">
                        <?php foreach ($team_imgs as $n => $img) : ?>
                            <li class="scroll__item"><?php echo theme_image(theme_field('pr_team_image_' . ($n + 1)), 'process/' . $img . '.webp', array('width' => 600, 'height' => 600)); ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endfor; ?>
            </div>
        </div>
    </section>

    <!-- あなたはどの工程で、〜（募集職種：TOP と共通の snippet） -->
    <section class="process-recruit" id="recruit">
        <div class="container">
            <h2 class="heading-wrap heading-typeC heading-typeC--s">
                <span class="heading-main js-lines"><?php echo $text(theme_field('pr_job_heading')); ?></span>
            </h2>
        </div>
        <?php get_template_part('snippet/job-list'); ?>
    </section>

</main>
<?php get_footer(); ?>
