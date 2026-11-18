<?php get_header(); ?>
<?php
/*
 * TOP（固定ページ slug: top をホームに設定）
 * 文言は page-fields/top.php の初期値に書き、ここでは theme_field('項目名') で取り出す。
 * 管理画面：固定ページ「TOP」の編集画面で変更できる。
 */
$top_id = theme_top_id();
$jobs   = get_posts(array('post_type' => 'job', 'numberposts' => -1, 'orderby' => 'menu_order', 'order' => 'ASC'));

/** テキストエリアの値を「1行ずつの配列」にする */
$lines = function ($name) use ($top_id) {
    return array_filter(array_map('trim', preg_split('/\R/u', (string) theme_field($name, null, $top_id))), 'strlen');
};
/** テキストエリアの値を改行つきで出す */
$text = function ($name) use ($top_id) {
    return nl2br(esc_html(theme_field($name, null, $top_id)));
};
?>

<div class="opening" id="opening" aria-hidden="true">
    <div class="opening__inner">
        <img src="<?php echo esc_url(theme_img('logo.svg')); ?>" alt="" width="200" height="38" class="opening__logo">
        <p class="opening__text">アルミ手すり専門メーカー<br>ビルテック</p>
    </div>
</div>

<main class="top-main">

    <!-- MV -->
    <section class="top-mv top-mv-typeA" id="top-mv">
        <div class="top-mv__slider splide" aria-label="メインビジュアル">
            <div class="splide__track">
                <ul class="splide__list">
                    <?php for ($i = 1; $i <= 3; $i++) : ?>
                        <li class="splide__slide top-mv__slide">
                            <picture>
                                <source srcset="<?php echo esc_url(theme_img("top/main0{$i}_sp.webp")); ?>" media="(max-width: 768px)" width="750" height="1360">
                                <img src="<?php echo esc_url(theme_img("top/main0{$i}.webp")); ?>" alt="" width="1440" height="780" <?php echo $i === 1 ? 'fetchpriority="high"' : 'loading="lazy"'; ?>>
                            </picture>
                        </li>
                    <?php endfor; ?>
                </ul>
            </div>
        </div>
        <div class="top-mv__content">
            <h2 class="top-mv__title">
                <?php foreach ($lines('mv_title') as $line) : ?>
                    <span class="top-mv__line"><span class="top-mv__line-text"><?php echo esc_html($line); ?></span></span>
                <?php endforeach; ?>
            </h2>
            <p class="top-mv__lead"><?php echo $text('mv_lead'); ?></p>
        </div>
        <a href="#top-intro" class="top-mv__scroll en"><span class="top-mv__scroll-text">Scroll Down</span><span class="top-mv__scroll-line"></span></a>
        <ul class="top-mv__progress" aria-hidden="true">
            <li class="top-mv__bar"><span></span></li>
            <li class="top-mv__bar"><span></span></li>
            <li class="top-mv__bar"><span></span></li>
        </ul>
    </section>

    <!-- ビルテックは今、 -->
    <section class="top-intro" id="top-intro">
        <img src="<?php echo esc_url(theme_img('top/sec1_bg.webp')); ?>" alt="" width="1220" height="1038" class="top-intro__bg" loading="lazy">
        <div class="container top-intro__inner">
            <h2 class="top-intro__title heading-2 js-lines">
                <?php
                $accent = theme_field('intro_accent', null, $top_id);
                $title_lines = array();
                foreach ($lines('intro_title') as $line) {
                    $line = esc_html($line);
                    if ($accent !== '') {
                        $line = str_replace(esc_html($accent), '<em>' . esc_html($accent) . '</em>', $line);
                    }
                    $title_lines[] = $line;
                }
                echo implode('<br>', $title_lines);
                ?>
            </h2>
            <p class="top-intro__text js-fade"><?php echo $text('intro_text'); ?></p>
            <ul class="top-intro__cards">
                <?php
                // 3職種の画像リンク（リンク先と表示名は募集要項の投稿。表示名は投稿のタイトル）
                $intro_cards = array(
                    array('slug' => 'ishou', 'img' => 'sec1_bnr01.webp'),
                    array('slug' => 'kouzu', 'img' => 'sec1_bnr02.webp'),
                    array('slug' => 'factory', 'img' => 'sec1_bnr03.webp'),
                );
                foreach ($intro_cards as $card) :
                    $job = get_page_by_path($card['slug'], OBJECT, 'job');
                    if (!$job) continue;
                    $url = get_permalink($job);
                    $card['label'] = get_the_title($job);
                ?>
                    <li class="top-intro__card js-fade">
                        <a href="<?php echo esc_url($url); ?>" class="top-intro__link">
                            <span class="top-intro__img img-zoom"><img src="<?php echo esc_url(theme_img('top/' . $card['img'])); ?>" alt="" width="720" height="260" loading="lazy"></span>
                            <span class="top-intro__label"><?php echo esc_html($card['label']); ?><?php echo theme_chevron(); ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>

    <!-- 代表メッセージ -->
    <section class="message message-typeA">
        <?php $message_image = theme_field('message_image', null, $top_id); ?>
        <picture class="message__img">
            <?php if (!$message_image) : ?>
                <source srcset="<?php echo esc_url(theme_img('top/sec2_bnr01_sp.webp')); ?>" media="(max-width: 768px)" width="750" height="440">
            <?php endif; ?>
            <?php echo theme_image($message_image, 'top/sec2_bnr01.webp', array('width' => 440, 'height' => 648)); ?>
        </picture>
        <div class="message__body">
            <h2 class="message__title heading-3 js-lines"><?php echo $text('message_title'); ?></h2>
            <p class="message__label js-fade">代表メッセージ</p>
            <p class="message__text js-fade"><?php echo $text('message_text'); ?></p>
            <p class="message__name js-fade"><?php echo esc_html(theme_field('message_name', null, $top_id)); ?></p>
            <a href="<?php echo esc_url(home_url('/philosophy/')); ?>" class="btn btn--white btn--m message__btn js-fade"><span class="btn__text">もっと見る</span><?php echo theme_chevron(); ?></a>
        </div>
    </section>

    <!-- ビルテックの強み -->
    <section class="strength strength-typeA">
        <div class="container">
            <h2 class="heading-wrap heading-typeC heading-typeC--white">
                <span class="heading-main js-lines"><?php echo esc_html(theme_field('strength_heading', null, $top_id)); ?></span>
                <span class="heading-line" aria-hidden="true"></span>
                <span class="heading-sub js-fade"><?php echo esc_html(theme_field('strength_sub', null, $top_id)); ?></span>
            </h2>
            <p class="strength__lead js-fade"><?php echo $text('strength_lead'); ?></p>
        </div>
        <div class="strength__slider splide js-fade" aria-label="<?php echo esc_attr(theme_field('strength_heading', null, $top_id)); ?>">
            <div class="splide__track">
                <ul class="splide__list">
                    <?php for ($i = 1; $i <= 3; $i++) :
                        $s = theme_field('strength_' . $i, null, $top_id); ?>
                        <li class="splide__slide strength__item">
                            <div class="strength__img"><?php echo theme_image($s['image'], 'top/sec3_bnr0' . $i . '.webp', array('width' => 720, 'height' => 720)); ?></div>
                            <p class="strength__title"><?php echo nl2br(esc_html($s['title'])); ?></p>
                        </li>
                    <?php endfor; ?>
                </ul>
            </div>
        </div>
        <div class="container strength__more js-fade">
            <a href="<?php echo esc_url(home_url('/business/')); ?>" class="btn btn--white btn--m"><span class="btn__text">事業紹介を一覧で見る</span><?php echo theme_chevron(); ?></a>
        </div>
    </section>

    <!-- 募集職種 -->
    <section class="top-recruit" id="recruit">
        <div class="container">
            <h2 class="heading-wrap heading-typeC">
                <span class="heading-main js-lines"><?php echo esc_html(theme_field('recruit_heading', null, $top_id)); ?></span>
                <span class="heading-line" aria-hidden="true"></span>
                <span class="heading-sub js-fade"><?php echo esc_html(theme_field('recruit_sub', null, $top_id)); ?></span>
            </h2>
        </div>
        <?php get_template_part('snippet/job-list', null, array('jobs' => $jobs)); ?>
        <div class="container top-recruit__more js-fade">
            <a href="<?php echo esc_url(home_url('/job/')); ?>" class="btn btn--outline btn--m"><span class="btn__text">募集一覧を見る</span><?php echo theme_chevron(); ?></a>
        </div>
    </section>

    <!-- 先輩インタビュー -->
    <section class="interview interview-typeF">
        <div class="container">
            <h2 class="heading-wrap heading-typeC">
                <span class="heading-main js-lines"><?php echo esc_html(theme_field('interview_heading', null, $top_id)); ?></span>
                <span class="heading-line" aria-hidden="true"></span>
            </h2>
        </div>
        <div class="interview__wrap">
            <div class="interview__panel">
                <p class="interview__lead js-fade"><?php echo $text('interview_lead'); ?></p>
                <a href="<?php echo esc_url(home_url('/interview/')); ?>" class="btn btn--white btn--m js-fade"><span class="btn__text">インタビュー一覧を見る</span><?php echo theme_chevron(); ?></a>
            </div>
            <div class="interview__slider-wrap">
                <div class="interview__slider splide" aria-label="<?php echo esc_attr(theme_field('interview_heading', null, $top_id)); ?>">
                    <div class="splide__track">
                        <ul class="splide__list">
                            <?php
                            $interviews = new WP_Query(array('post_type' => 'interview', 'posts_per_page' => 8));
                            while ($interviews->have_posts()) : $interviews->the_post();
                                get_template_part('snippet/interview-card', null, array('class' => 'splide__slide'));
                            endwhile;
                            wp_reset_postdata();
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="interview__progress en" aria-hidden="true">
                    <span class="interview__progress-current">1</span>
                    <span class="interview__progress-track"><span class="interview__progress-bar"></span></span>
                    <span class="interview__progress-total"><?php echo (int) $interviews->post_count; ?></span>
                </div>
            </div>
        </div>
    </section>

    <!-- 流れる英文 -->
    <?php $loop_text = theme_field('loop_text', null, $top_id); ?>
    <div class="loop loop-typeA top-loop" aria-hidden="true">
        <div class="loop__content flex">
            <?php for ($i = 0; $i < 2; $i++) : ?>
                <ul class="loop__items flex">
                    <li class="loop__item en"><?php echo esc_html($loop_text); ?></li>
                    <li class="loop__item en"><?php echo esc_html($loop_text); ?></li>
                </ul>
            <?php endfor; ?>
        </div>
    </div>

</main>
<?php get_footer(); ?>
