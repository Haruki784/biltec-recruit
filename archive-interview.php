<?php get_header(); ?>
<?php
/*
 * 先輩インタビュー 一覧（CPT interview のアーカイブ /interview/）
 * カードは snippet/interview-card.php（TOP のスライダーと共用）。一覧での見た目は assets/pages/interview.css。
 * 件数は functions.php の pre_get_posts（アーカイブ共通）に従う。
 */
global $wp_query;
$paged     = max(1, (int) get_query_var('paged'));
$max_pages = (int) $wp_query->max_num_pages;
?>

<main class="iv-main">

    <?php get_template_part('snippet/under-mv', null, array(
        'title'    => post_type_archive_title('', false),
        'image'    => 'interview/iv_main.webp',
        'image_sp' => 'interview/iv_main_sp.webp',
    )); ?>

    <section class="iv-archive">
        <div class="container">
            <?php if (have_posts()) : ?>
                <ul class="iv-cards">
                    <?php while (have_posts()) : the_post(); ?>
                        <?php get_template_part('snippet/interview-card', null, array('class' => 'js-fade')); ?>
                    <?php endwhile; ?>
                </ul>
            <?php else : ?>
                <p class="iv-archive__empty">現在、掲載しているインタビューはありません。</p>
            <?php endif; ?>

            <?php if ($max_pages > 1) : ?>
                <div class="pagenation pagenation-typeA mt-8">
                    <ul class="pagenation__items gap-x-4">
                        <?php if ($paged > 1) : ?>
                            <li class="pagenation__item pagenation__item--prev">
                                <a href="<?php echo esc_url(get_pagenum_link($paged - 1)); ?>" aria-label="前のページ">
                                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none" aria-hidden="true">
                                        <path d="M18.75 7.5L11.25 15L18.75 22.5" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php for ($i = 1; $i <= $max_pages; $i++) : ?>
                            <li class="pagenation__item">
                                <?php if ($i === $paged) : ?>
                                    <span aria-current="page"><?php echo esc_html(str_pad($i, 2, '0', STR_PAD_LEFT)); ?></span>
                                <?php else : ?>
                                    <a href="<?php echo esc_url(get_pagenum_link($i)); ?>"><?php echo esc_html(str_pad($i, 2, '0', STR_PAD_LEFT)); ?></a>
                                <?php endif; ?>
                            </li>
                        <?php endfor; ?>
                        <?php if ($paged < $max_pages) : ?>
                            <li class="pagenation__item pagenation__item--next">
                                <a href="<?php echo esc_url(get_pagenum_link($paged + 1)); ?>" aria-label="次のページ">
                                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none" aria-hidden="true">
                                        <path d="M11.25 7.5L18.75 15L11.25 22.5" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </section>

</main>

<?php get_footer(); ?>
