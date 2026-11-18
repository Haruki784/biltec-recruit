<?php get_header(); ?>
<?php
/*
 * 先輩インタビュー 詳細（CPT interview /interview/<slug>/）
 * 項目は page-fields/interview.php。本文は iv_section_1〜8（見出しが空のセクションは出さない）。
 * 目次は main.js が #js-article-content 内の article.article[id] の h2 から作る。
 * 目次の文言は見出しの【】の中（article の data-index）。main.js が data-index を優先して目次を作る。
 * ページ固有のスタイル：assets/pages/interview.css
 */
$text = function ($value) {
    return nl2br(esc_html(trim((string) $value)));
};
?>

<?php while (have_posts()) : the_post(); ?>
    <?php
    $post_id = get_the_ID();
    $name    = theme_field('person_name', get_the_title());

    $sections = array();
    for ($i = 1; $i <= 8; $i++) {
        $s = theme_field('iv_section_' . $i);
        if (!is_array($s) || trim((string) ($s['heading'] ?? '')) === '') {
            continue;
        }
        // 目次の文言：見出しの【】の中。なければ見出しの1行目
        $heading = trim($s['heading']);
        $lines   = array_values(array_filter(array_map('trim', preg_split('/\R/u', $heading)), 'strlen'));
        $label   = preg_match('/【(.+?)】/u', $heading, $m) ? $m[1] : $lines[0];
        $sections[] = array(
            'label'    => $label,
            'lines'    => $lines,
            'question' => $s['question'] ?? '',
            'answer'   => $s['answer'] ?? '',
            'image'    => $s['image'] ?? '',
        );
    }
    ?>

    <main class="iv-main iv-single">

        <div class="iv-single__breadcrumb">
            <?php get_template_part('snippet/breadcrumb'); ?>
        </div>

        <section class="article-mv article-mv-typeE">
            <div class="article-mv__visual">
                <?php echo theme_image(theme_field('iv_mv_image'), 'interview/iv_main.webp', array('width' => 1440, 'height' => 500, 'loading' => 'eager', 'fetchpriority' => 'high', 'class' => 'article-mv__img'), 'full'); ?>
            </div>
            <div class="article-mv__content container">
                <h1 class="article-mv__catch">
                    <span class="article-mv__catch-line"><?php echo esc_html(theme_field('catch_1')); ?></span>
                    <span class="article-mv__catch-line"><?php echo esc_html(theme_field('catch_2')); ?></span>
                </h1>
                <div class="article-mv__card">
                    <p class="article-mv__name"><?php echo esc_html($name); ?></p>
                    <?php if (theme_field('name_en')) : ?>
                        <p class="article-mv__name-en"><?php echo esc_html(theme_field('name_en')); ?></p>
                    <?php endif; ?>
                    <p class="article-mv__meta"><?php echo esc_html(theme_field('join_year')); ?>　<?php echo esc_html(theme_field('position')); ?></p>
                </div>
            </div>
        </section>

        <div class="iv-body index">
            <?php if ($sections) : ?>
                <aside class="index__side">
                    <nav class="index-container index-typeA" aria-label="目次">
                        <ul class="index__items">
                            <?php foreach ($sections as $n => $s) : ?>
                                <li class="index__item"><a href="#section-<?php echo $n + 1; ?>" class="index__link"><?php echo esc_html($s['label']); ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </nav>
                </aside>
            <?php endif; ?>

            <div class="index__main">
                <div class="index__main-container" id="js-article-content">
                    <?php if (theme_field('iv_lead')) : ?>
                        <p class="iv-lead js-fade"><?php echo $text(theme_field('iv_lead')); ?></p>
                    <?php endif; ?>

                    <?php foreach ($sections as $n => $s) : ?>
                        <article class="article iv-article" id="section-<?php echo $n + 1; ?>" data-index="<?php echo esc_attr($s['label']); ?>">
                            <h2 class="article__heading iv-article__heading js-lines"><?php echo implode('<br>', array_map('esc_html', $s['lines'])); ?></h2>
                            <div class="article__content iv-article__content js-fade">
                                <?php if (trim($s['question']) !== '') : ?>
                                    <p class="iv-article__question"><?php echo $text($s['question']); ?></p>
                                <?php endif; ?>
                                <?php if (trim($s['answer']) !== '') : ?>
                                    <p class="iv-article__answer"><span class="iv-article__speaker"><?php echo esc_html($name); ?>：</span><?php echo $text($s['answer']); ?></p>
                                <?php endif; ?>
                            </div>
                            <?php if ($s['image']) : ?>
                                <figure class="iv-article__img js-fade">
                                    <?php echo theme_image($s['image'], '', array('width' => 760, 'height' => 440, 'class' => 'article__img')); ?>
                                </figure>
                            <?php endif; ?>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <?php
        $others = new WP_Query(array(
            'post_type'      => 'interview',
            'posts_per_page' => 4,
            'post__not_in'   => array($post_id),
            'no_found_rows'  => true,
        ));
        if ($others->have_posts()) : ?>
            <section class="iv-others">
                <div class="container">
                    <h2 class="iv-others__title js-lines">他の社員インタビューを見る</h2>
                    <ul class="iv-cards">
                        <?php while ($others->have_posts()) : $others->the_post(); ?>
                            <?php get_template_part('snippet/interview-card', null, array('class' => 'js-fade')); ?>
                        <?php endwhile; ?>
                    </ul>
                </div>
            </section>
        <?php endif;
        wp_reset_postdata(); ?>

    </main>
<?php endwhile; ?>

<?php get_footer(); ?>
