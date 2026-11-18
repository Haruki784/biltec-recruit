<?php get_header(); ?>
<main>
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
    <?php
    $paged = get_query_var('paged') ?: 1;
    $interview_query = new WP_Query([
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => 9,
        'paged'          => $paged,
    ]);
    ?>
    <?php if ($interview_query->have_posts()) : ?>
        <section class="interview interview-typeA mt-8">
            <div class="container">
                <ul class="interview__items flex flex-3 flex-1-sp gap-y-7-sp">
                    <?php while ($interview_query->have_posts()) : $interview_query->the_post(); ?>
                        <li class="interview__item col">
                            <a href="<?php the_permalink(); ?>" class="interview__link">
                                <div class="interview__head">
                                    <div class="interview__img">
                                        <!-- 260724  サムネイルが設定されていなかったら崩れるからダミー画像設定必要 -->
                                        <?php if (has_post_thumbnail()) : ?>
                                            <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'large')); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                                        <?php else : ?>
                                            <img src="https://placehold.jp/500x500.png" alt="No Image">
                                        <?php endif; ?>
                                        <!-- 260724  サムネイルが設定されていなかったら崩れるからダミー画像設定必要ここまで -->
                                        <div class="interview__arrow">
                                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g clip-path="url(#clip0_6417_7109)">
                                                    <path d="M1.33301 1H38.667C38.8509 1.00018 38.9998 1.14914 39 1.33301V38.667C38.9998 38.8509 38.8509 38.9998 38.667 39H1.33301C1.14914 38.9998 1.00018 38.8509 1 38.667V1.33301C1.00018 1.14917 1.14917 1.00018 1.33301 1Z" stroke="#0033FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="interview__frame" />
                                                    <path d="M12.2218 19.7782L27.778 19.7781M27.778 19.7781L20.9722 12.9723M27.778 19.7781L20.9721 26.5841" stroke="#0033FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="interview__path" />
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_6417_7109">
                                                        <rect width="40" height="40" fill="white" />
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </div>
                                        <?php $tags = get_the_tags();
                                        if ($tags) : ?>
                                            <span class="interview__tag semibold px-3"><?php echo esc_html($tags[0]->name); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="interview__body grid grid-1 gap-y-2 mt-4">
                                    <h3 class="interview__title heading-4">
                                        <?php if (get_field('mv_catch_pc')) : ?>
                                            <span class="show-pc"><?php echo nl2br(esc_html(get_field('mv_catch_pc'))); ?></span>
                                        <?php endif; ?>
                                        <?php if (get_field('mv_catch_sp')) : ?>
                                            <span class="small-hide"><?php echo nl2br(esc_html(get_field('mv_catch_sp'))); ?></span>
                                        <?php endif; ?>
                                        <?php if (!get_field('mv_catch_pc') && !get_field('mv_catch_sp')) : ?>
                                            <?php the_title(); ?>
                                        <?php endif; ?>
                                    </h3>
                                    <div class="interview__box">
                                        <?php if (get_field('mv_name')) : ?>
                                            <div class="interview__name text-lg"><?php echo esc_html(get_field('mv_name')); ?></div>
                                        <?php endif; ?>
                                        <?php if (get_field('mv_post')) : ?>
                                            <div class="interview__post"><?php echo esc_html(get_field('mv_post')); ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </a>
                        </li>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                </ul>
            </div>
        </section>
    <?php endif; ?>
    <?php if ($interview_query->max_num_pages > 1) : ?>
        <div class="pagenation pagenation-typeA mt-8">
            <div class="container">
                <ul class="pagenation__items gap-x-4">
                    <?php if ($paged > 1) : ?>
                        <li class="pagenation__item pagenation__item--prev">
                            <a href="<?php echo esc_url(get_pagenum_link($paged - 1)); ?>">
                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M18.75 7.5L11.25 15L18.75 22.5" stroke="#01033E" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php for ($i = 1; $i <= $interview_query->max_num_pages; $i++) : ?>
                        <li class="pagenation__item">
                            <?php if ($i === $paged) : ?>
                                <span><?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?></span>
                            <?php else : ?>
                                <a href="<?php echo esc_url(get_pagenum_link($i)); ?>"><?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?></a>
                            <?php endif; ?>
                        </li>
                    <?php endfor; ?>
                    <?php if ($paged < $interview_query->max_num_pages) : ?>
                        <li class="pagenation__item pagenation__item--next">
                            <a href="<?php echo esc_url(get_pagenum_link($paged + 1)); ?>">
                                <svg width="20" height="20" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.25 7.5L18.75 15L11.25 22.5" stroke="#01033E" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>
    <div class="mb-8"></div>

</main>
<?php get_footer(); ?>