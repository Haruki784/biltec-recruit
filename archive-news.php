<?php
get_header();
?>

<main class="grid grid-1 gap-y-8">
    <section class="under-mv under-mv-typeA pb-5">
        <div class="under-mv__img">
            <picture>
                <source srcset="https://placehold.jp/375x280.png" media="(max-width: 768px)">
                <img src="https://placehold.jp/1440x480.png" alt="">
            </picture>
        </div>
        <div class="under-mv__container container pt-6 pb-5 py-5-sp-full grid grid-1 gap-y-1-full">
            <h1 class="under-mv__title heading-1-full en">News</h1>
            <div class="under-mv__subtitle heading-4-full">ニュース</div>
        </div>
        <?php get_template_part('snippet/breadcrumb'); ?>
    </section>
    <?php $paged = get_query_var('paged') ?: 1; ?>
    <?php if (have_posts()) : ?>
        <section class="news news-typeA">
            <div class="container">
                <ul class="news__items grid grid-1 gap-y-4">
                    <?php while (have_posts()) : the_post(); ?>
                        <li class="news__item pb-5 pr-5 pr-0-sp">
                            <a href="<?php the_permalink(); ?>" class="news__link flex gap-0-sp">
                                <time datetime="<?php echo esc_attr(get_the_date('Y-m-d')); ?>" class="news__time en semibold"><?php echo esc_html(get_the_date('Y.m.d')); ?></time>
                                <div class="news__body grid grid-1 gap-y-2">
                                    <h2 class="news__title text-lg"><?php the_title(); ?></h2>
                                    <p class="news__description"><?php echo esc_html(get_the_excerpt()); ?></p>
                                </div>
                            </a>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </section>
    <?php else : ?>
        <section class="news news-typeA">
            <div class="container">
                <p>現在表示できるニュースはありません。</p>
            </div>
        </section>
    <?php endif; ?>
    <?php if ($GLOBALS['wp_query']->max_num_pages > 1) : ?>
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
                    <?php for ($i = 1; $i <= $GLOBALS['wp_query']->max_num_pages; $i++) : ?>
                        <li class="pagenation__item">
                            <?php if ($i === $paged) : ?>
                                <span><?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?></span>
                            <?php else : ?>
                                <a href="<?php echo esc_url(get_pagenum_link($i)); ?>"><?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?></a>
                            <?php endif; ?>
                        </li>
                    <?php endfor; ?>
                    <?php if ($paged < $GLOBALS['wp_query']->max_num_pages) : ?>
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
    <div class="mt-8"></div>
</main>

<?php get_footer(); ?>