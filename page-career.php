<?php get_header(); ?>
<?php
/*
 * 教育・キャリアパス（固定ページ slug: career）
 * デザイン待ちのため、今は MV と「※現在作成中です※」だけ（2026-11-27 修正依頼）。
 * 文言・画像は function/page-fields/career.php の初期値に書き、ここでは theme_pf('項目名') で取り出す。
 */
?>

<main id="main" class="career-main">

    <?php get_template_part('snippet/under-mv', null, array(
        'label'    => theme_pf('cr_mv_label'),
        'title'    => theme_pf('cr_mv_title'),
        'image'    => theme_pf('cr_mv_image'),
        'image_sp' => theme_pf('cr_mv_image_sp'),
    )); ?>

    <section class="career-notice">
        <div class="container">
            <p class="career-notice__text"><?php echo theme_pf_kses(theme_pf('cr_notice')); ?></p>
        </div>
    </section>

</main>
<?php get_footer(); ?>
