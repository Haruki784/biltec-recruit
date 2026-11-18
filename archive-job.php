<?php get_header(); ?>
<?php
/*
 * 募集職種一覧（CPT job のアーカイブ /job/）
 * MV の文言・画像は TOP の編集画面「共通：募集職種一覧」（page-fields/job-archive.php）。
 * 職種ボタンは job 投稿を並び順（menu_order）で全件出す。職種名の下の小さい文字は各投稿の「職種名の後ろ」（card_title_sub）。
 * スタイルは assets/pages/job.css。
 */
$jobs = get_posts(array('post_type' => 'job', 'numberposts' => -1, 'orderby' => 'menu_order', 'order' => 'ASC'));
?>

<main class="job-main job-archive">

    <?php get_template_part('snippet/under-mv', null, array(
        'title'    => theme_option('job_archive_title'),
        'image'    => 'job/3_0_main.webp',
        'image_sp' => 'job/3_0_main_sp.webp',
        'image_id' => theme_option('job_archive_image'),
    )); ?>

    <section class="job-archive__body">
        <div class="container">
            <?php if ($jobs) : ?>
                <ul class="job-nav">
                    <?php foreach ($jobs as $job) :
                        $sub = theme_field('card_title_sub', '', $job->ID); ?>
                        <li class="job-nav__item js-fade">
                            <a href="<?php echo esc_url(get_permalink($job)); ?>" class="job-nav__link">
                                <span class="job-nav__text">
                                    <span class="job-nav__title"><?php echo esc_html(get_the_title($job)); ?></span>
                                    <?php if ($sub) : ?><span class="job-nav__sub"><?php echo esc_html($sub); ?></span><?php endif; ?>
                                </span>
                                <span class="job-nav__line" aria-hidden="true"></span>
                                <svg class="job-nav__arrow" width="32" height="32" viewBox="0 0 32 32" fill="none" aria-hidden="true"><path d="M6 16.5H26M16.5556 26L26 16.5L16.5556 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" /></svg>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </section>

</main>
<?php get_footer(); ?>
