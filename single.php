<?php get_header(); ?>

<?php while (have_posts()) : the_post(); ?>
    <section class="article-mv article-mv-typeE py-7">
        <div class="container">
            <div class="article-mv__content grid grid-2 grid-1-sp">
                <div class="article-mv__left gap-y-5 pb-3 gap-y-3-sp">
                    <?php if (get_field('mv_title_pc') || get_field('mv_title_sp')) : ?>
                        <h2 class="article-mv__title heading-3 grid grid-1 gap-y-1">
                            <?php if (get_field('mv_title_pc')) : ?>
                                <span class="show-pc"><?php echo nl2br(esc_html(get_field('mv_title_pc'))); ?></span>
                            <?php endif; ?>
                            <?php if (get_field('mv_title_sp')) : ?>
                                <span class="small-hide"><?php echo nl2br(esc_html(get_field('mv_title_sp'))); ?></span>
                            <?php endif; ?>
                        </h2>
                    <?php endif; ?>
                    <div class="article-mv__body">
                        <?php if (get_field('mv_name')) : ?>
                            <h3 class="article-mv__name heading-3"><?php echo esc_html(get_field('mv_name')); ?></h3>
                        <?php endif; ?>
                        <?php if (get_field('mv_post')) : ?>
                            <div class="article__post"><?php echo esc_html(get_field('mv_post')); ?></div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="article-mv__right">
                    <picture>
                        <?php if (get_field('mv_img_sp') ?: get_field('mv_img_pc')) : ?>
                            <source srcset="<?php echo esc_url(get_field('mv_img_sp') ?: get_field('mv_img_pc')); ?>" media="(max-width: 768px)">
                        <?php endif; ?>
                        <img src="<?php echo esc_url(get_field('mv_img_pc')); ?>" alt="<?php echo esc_attr(get_field('mv_name')); ?>">
                    </picture>
                </div>
            </div>
        </div>
    </section>
    <main id="main" class="my-8 index">
        <aside class="index__side">
            <div class="index-container index-typeA">
                <ul class="index__items grid grid-1 gap-y-2 p-6 pr-4"></ul>
            </div>
        </aside>
        <div class="index__main">
            <div class="index__main-container grid grid-1 gap-y-8" id="js-article-content">
                <?php the_content(); ?>
            </div>
        </div>
    </main>

    <?php
    $related_posts = get_field('related_post');
    if ($related_posts) :
        $related_posts = is_array($related_posts) ? $related_posts : [$related_posts];
    ?>
        <section class="interview interview-typeE mt-8">
            <div class="container">
                <ul class="interview__items flex flex-3 flex-1-sp">
                    <?php foreach ($related_posts as $related_post) : ?>
                        <li class="interview__item col">
                            <a href="<?php echo esc_url(get_permalink($related_post->ID)); ?>" class="interview__link">
                                <div class="interview__img">
                                    <?php if (get_the_post_thumbnail_url($related_post->ID, 'large')) : ?>
                                        <img src="<?php echo esc_url(get_the_post_thumbnail_url($related_post->ID, 'large')); ?>" alt="<?php echo esc_attr(get_the_title($related_post->ID)); ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="interview__body grid grid-1 gap-y-2 mt-4">
                                    <h3 class="interview__title heading-4">
                                        <?php if (get_field('mv_catch_pc', $related_post->ID)) : ?>
                                            <span class="show-pc"><?php echo nl2br(esc_html(get_field('mv_catch_pc', $related_post->ID))); ?></span>
                                        <?php endif; ?>
                                        <?php if (get_field('mv_catch_sp', $related_post->ID)) : ?>
                                            <span class="small-hide"><?php echo nl2br(esc_html(get_field('mv_catch_sp', $related_post->ID))); ?></span>
                                        <?php endif; ?>
                                        <?php if (!get_field('mv_catch_pc', $related_post->ID) && !get_field('mv_catch_sp', $related_post->ID)) : ?>
                                            <?php echo esc_html(get_the_title($related_post->ID)); ?>
                                        <?php endif; ?>
                                    </h3>
                                    <div class="interview__line"></div>
                                    <div class="interview__box gap-x-4">
                                        <div class="interview__head">
                                            <?php if (get_field('mv_name', $related_post->ID)) : ?>
                                                <div class="interview__name text-lg"><?php echo esc_html(get_field('mv_name', $related_post->ID)); ?></div>
                                            <?php endif; ?>
                                            <?php if (get_field('mv_post', $related_post->ID)) : ?>
                                                <div class="interview__post"><?php echo esc_html(get_field('mv_post', $related_post->ID)); ?></div>
                                            <?php endif; ?>
                                        </div>
                                        <span class="interview__icon">
                                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect x="1" y="1" width="30" height="30" rx="15" stroke="#01033E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M16.0389 9.19376C16.49 8.74267 17.2222 8.74267 17.6732 9.19376L23.6617 15.1835C24.1128 15.6345 24.1128 16.3655 23.6617 16.8165L17.6732 22.8062C17.2222 23.2573 16.49 23.2573 16.0389 22.8062C15.5882 22.3553 15.5883 21.6242 16.0389 21.1731L20.0571 17.1549H9.15558C8.51778 17.1549 8.00023 16.6384 8 16.0006C8 15.3627 8.51765 14.8451 9.15558 14.8451H20.0571L16.0389 10.8281C15.5878 10.377 15.5878 9.64484 16.0389 9.19376Z" fill="#01033E" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </section>
    <?php endif; ?>

<?php endwhile; ?>

<?php get_footer(); ?>