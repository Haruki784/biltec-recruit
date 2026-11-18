<?php get_header(); ?>

<style>
    .news-single__head {
        border-bottom: 1px solid #e3e3e3;
    }

    .news-single__time {
        color: #0033ff;
    }

    .news-single__content {
        line-height: 1.9;
    }

    .news-single__content img {
        max-width: 100%;
        height: auto;
    }

    .news-single__content h2,
    .news-single__content h3 {
        font-weight: 700;
        line-height: 1.5;
    }

    .news-single__content a {
        color: #0033ff;
        text-decoration: underline;
    }

    .news-nav__list {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
    }

    .news-nav__item {
        flex: 1;
        min-width: 0;
    }

    .news-nav__item--center {
        flex: 0 0 auto;
        text-align: center;
    }

    .news-nav__item--next {
        text-align: right;
    }

    .news-nav__link {
        display: inline-flex;
        align-items: center;
        color: #01033e;
        transition: opacity 0.3s ease;
    }

    .news-nav__link:hover {
        opacity: 0.6;
    }

    .news-nav__label {
        font-size: 1.8rem;
        font-weight: 700;
        color: #0033ff;
    }

    .news-nav__archive {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 12px 28px;
        border: 1px solid #01033e;
        border-radius: 9999px;
        font-weight: 700;
        color: #01033e;
        white-space: nowrap;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .news-nav__archive:hover {
        background-color: #01033e;
        color: #fff;
    }

    .news-nav__disabled {
        opacity: 0.3;
        pointer-events: none;
    }

    @media (max-width: 768px) {
        .news-nav__list {
            gap: 12px;
        }

        .news-nav__archive {
            padding: 10px 16px;
            font-size: 1.4rem;
        }

        .news-nav__label {
            font-size: 1.6rem;
        }
    }
</style>

<?php while (have_posts()) : the_post(); ?>
    <main class="grid grid-1 gap-y-8">
        <section class="under-mv under-mv-typeA pb-5">
            <div class="under-mv__container container pt-6 pb-5 py-5-sp-full grid grid-1 gap-y-1-full">
                <h1 class="under-mv__title heading-1-full en">News</h1>
                <div class="under-mv__subtitle heading-4-full">ニュース</div>
            </div>
            <?php get_template_part('snippet/breadcrumb'); ?>
        </section>

        <article class="news-single">
            <div class="container grid grid-1 gap-y-6">
                <header class="news-single__head grid grid-1 gap-y-3 pb-5">
                    <time datetime="<?php echo esc_attr(get_the_date('Y-m-d')); ?>" class="news-single__time en semibold"><?php echo esc_html(get_the_date('Y.m.d')); ?></time>
                    <h2 class="news-single__title heading-3"><?php the_title(); ?></h2>
                </header>
                <div class="news-single__content">
                    <?php the_content(); ?>
                </div>
            </div>
        </article>

        <?php
        $prev_post = get_previous_post();
        $next_post = get_next_post();
        $archive_url = get_post_type_archive_link('news');
        ?>
        <nav class="news-nav" aria-label="記事ナビゲーション">
            <div class="container">
                <ul class="news-nav__list">
                    <li class="news-nav__item news-nav__item--prev">
                        <?php if ($prev_post) : ?>
                            <a href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>" class="news-nav__link">
                                <span class="news-nav__label">前の記事</span>
                            </a>
                        <?php else : ?>
                            <span class="news-nav__link news-nav__disabled">
                                <span class="news-nav__label">前の記事</span>
                            </span>
                        <?php endif; ?>
                    </li>
                    <li class="news-nav__item news-nav__item--center">
                        <?php if ($archive_url) : ?>
                            <a href="<?php echo esc_url($archive_url); ?>" class="news-nav__archive">一覧へ</a>
                        <?php endif; ?>
                    </li>
                    <li class="news-nav__item news-nav__item--next">
                        <?php if ($next_post) : ?>
                            <a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>" class="news-nav__link">
                                <span class="news-nav__label">次の記事</span>
                            </a>
                        <?php else : ?>
                            <span class="news-nav__link news-nav__disabled">
                                <span class="news-nav__label">次の記事</span>
                            </span>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="mt-8"></div>
    </main>
<?php endwhile; ?>

<?php get_footer(); ?>