<?php get_header(); ?>
<?php
/*
 * 汎用アーカイブ（カテゴリー・タグ・日付・投稿者など）。
 * この案件では通常の投稿は使っていないので、万一表示されたときに崩れない最小限の一覧にしている。
 * 先輩インタビューは archive-interview.php、募集要項は archive-job.php。
 */
?>
<main id="main" class="archive-main">
    <?php get_template_part('snippet/under-mv', null, array(
        'title' => wp_strip_all_tags(get_the_archive_title()),
        'image' => 'business/1_2_main.webp',
    )); ?>

    <section class="archive-list">
        <div class="container">
            <?php if (have_posts()) : ?>
                <ul class="archive-list__items">
                    <?php while (have_posts()) : the_post(); ?>
                        <li class="archive-list__item">
                            <a href="<?php the_permalink(); ?>" class="archive-list__link">
                                <time class="archive-list__date en" datetime="<?php echo esc_attr(get_the_date('Y-m-d')); ?>"><?php echo esc_html(get_the_date('Y.m.d')); ?></time>
                                <span class="archive-list__title"><?php the_title(); ?></span>
                            </a>
                        </li>
                    <?php endwhile; ?>
                </ul>
                <div class="archive-list__pager">
                    <?php the_posts_pagination(array('mid_size' => 1, 'prev_text' => '前へ', 'next_text' => '次へ')); ?>
                </div>
            <?php else : ?>
                <p class="archive-list__empty">記事はまだありません。</p>
            <?php endif; ?>
        </div>
    </section>
</main>
<?php get_footer(); ?>
