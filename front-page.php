<?php get_header(); ?>
<?php
/*
 * TOP（固定ページ slug: top をホームに設定）
 * 文言・画像は function/page-fields/top.php の初期値に書き、ここでは theme_pf('項目名') で取り出す。
 * 管理画面：固定ページ「TOP」の編集画面で変更できる。
 */
$jobs   = get_posts(array('post_type' => 'job', 'numberposts' => -1, 'orderby' => 'menu_order', 'order' => 'ASC'));

/** テキストエリアの値を「1行ずつの配列」にする */
$lines = function ($name) {
    return theme_pf_lines(theme_pf($name));
};
/** テキストエリアの値を改行つきで出す（改行・強調タグだけ許可） */
$text = function ($name) {
    return theme_pf_kses(theme_pf($name));
};
?>

<div class="opening" id="opening" aria-hidden="true">
    <div class="opening__inner">
        <div class="opening__logos">
            <img src="<?php echo esc_url(theme_pf_img(theme_common('logo'))); ?>" alt="" width="200" height="38" class="opening__logo">
        </div>
        <p class="opening__text"><?php echo $text('opening_text'); ?></p>
    </div>
</div>

<main id="main" class="top-main">

    <!-- MV -->
    <section class="top-mv top-mv-typeA" id="top-mv">
        <div class="top-mv__slider splide" aria-label="メインビジュアル">
            <div class="splide__track">
                <ul class="splide__list">
                    <?php for ($i = 1; $i <= 3; $i++) :
                            $slide = theme_pf('mv_slide_' . $i);
                            $sp    = theme_pf_sp($slide['pc'], $slide['sp']); ?>
                        <li class="splide__slide top-mv__slide">
                            <picture>
                                <?php if ($sp) : ?><source srcset="<?php echo esc_url($sp); ?>" media="(max-width: 768px)" width="750" height="1360"><?php endif; ?>
                                <img src="<?php echo esc_url(theme_pf_img($slide['pc'])); ?>" alt="" width="1440" height="780" <?php echo $i === 1 ? 'fetchpriority="high"' : 'loading="lazy"'; ?>>
                            </picture>
                        </li>
                    <?php endfor; ?>
                </ul>
            </div>
        </div>
        <div class="top-mv__content">
            <h2 class="top-mv__title">
                <?php foreach ($lines('mv_title') as $line) : ?>
                    <span class="top-mv__line"><span class="top-mv__line-text"><?php echo theme_pf_kses($line); ?></span></span>
                <?php endforeach; ?>
            </h2>
            <p class="top-mv__lead"><?php echo $text('mv_lead'); ?></p>
        </div>
        <a href="#top-intro" class="top-mv__scroll en"><span class="top-mv__scroll-text"><?php echo esc_html(theme_pf('mv_scroll')); ?></span><span class="top-mv__scroll-line"></span></a>
        <ul class="top-mv__progress" aria-hidden="true">
            <li class="top-mv__bar"><span></span></li>
            <li class="top-mv__bar"><span></span></li>
            <li class="top-mv__bar"><span></span></li>
        </ul>
    </section>

    <!-- ビルテックは今、 -->
    <section class="top-intro" id="top-intro">
        <img src="<?php echo esc_url(theme_pf_img(theme_pf('intro_bg'))); ?>" alt="" width="1220" height="1038" class="top-intro__bg" loading="lazy">
        <div class="container top-intro__inner">
            <h2 class="top-intro__title heading-2 js-lines">
                <?php
                $accent = theme_pf('intro_accent');
                $title_lines = array();
                foreach ($lines('intro_title') as $line) {
                    $line = theme_pf_kses($line);
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
                // 3職種の画像リンク（リンク先と表示名は募集要項の投稿。表示名は投稿のタイトル）。スラッグと画像は「ビルテックは今、」タブ
                for ($i = 1; $i <= 3; $i++) :
                    $card = theme_pf('intro_card_' . $i);
                    $job  = $card['job'] !== '' ? get_page_by_path($card['job'], OBJECT, 'job') : null;
                    if (!$job) continue;
                    $url = get_permalink($job);
                    $card['label'] = get_the_title($job);
                ?>
                    <li class="top-intro__card js-fade">
                        <a href="<?php echo esc_url($url); ?>" class="top-intro__link">
                            <span class="top-intro__img img-zoom"><img src="<?php echo esc_url(theme_pf_img($card['image'])); ?>" alt="" width="720" height="260" loading="lazy"></span>
                            <span class="top-intro__label"><?php echo esc_html($card['label']); ?><?php echo theme_chevron(); ?></span>
                        </a>
                    </li>
                <?php endfor; ?>
            </ul>
        </div>
    </section>

    <!-- 代表メッセージ -->
    <section class="message message-typeA">
        <?php $message_sp = theme_pf_sp(theme_pf('message_image'), theme_pf('message_image_sp')); ?>
        <picture class="message__img">
            <?php if ($message_sp) : ?>
                <source srcset="<?php echo esc_url($message_sp); ?>" media="(max-width: 768px)" width="750" height="440">
            <?php endif; ?>
            <?php echo theme_pf_image(theme_pf('message_image'), array('width' => 440, 'height' => 648)); ?>
        </picture>
        <div class="message__body">
            <h2 class="message__title heading-3 js-lines"><?php echo $text('message_title'); ?></h2>
            <p class="message__label js-fade"><?php echo esc_html(theme_pf('message_label')); ?></p>
            <p class="message__text js-fade"><?php echo $text('message_text'); ?></p>
            <p class="message__name js-fade"><?php echo esc_html(theme_pf('message_name')); ?></p>
            <a href="<?php echo esc_url(theme_pf_url(theme_pf('message_btn_link'))); ?>" class="btn btn--white btn--m message__btn js-fade"><span class="btn__text"><?php echo esc_html(theme_pf('message_btn_label')); ?></span><?php echo theme_chevron(); ?></a>
        </div>
    </section>

    <!-- ビルテックの強み -->
    <section class="strength strength-typeA">
        <div class="container">
            <h2 class="heading-wrap heading-typeC heading-typeC--white">
                <span class="heading-main js-lines"><?php echo esc_html(theme_pf('strength_heading')); ?></span>
                <span class="heading-line" aria-hidden="true"></span>
                <span class="heading-sub js-fade"><?php echo esc_html(theme_pf('strength_sub')); ?></span>
            </h2>
            <p class="strength__lead js-fade"><?php echo $text('strength_lead'); ?></p>
        </div>
        <div class="strength__slider splide js-fade" aria-label="<?php echo esc_attr(theme_pf('strength_heading')); ?>">
            <div class="splide__track">
                <ul class="splide__list">
                    <?php for ($i = 1; $i <= 3; $i++) :
                        $s = theme_pf('strength_' . $i); ?>
                        <li class="splide__slide strength__item">
                            <div class="strength__img"><?php echo theme_pf_image($s['image'], array('width' => 720, 'height' => 720)); ?></div>
                            <p class="strength__title"><?php echo theme_pf_kses($s['title']); ?></p>
                        </li>
                    <?php endfor; ?>
                </ul>
            </div>
        </div>
        <div class="container strength__more js-fade">
            <a href="<?php echo esc_url(theme_pf_url(theme_pf('strength_btn_link'))); ?>" class="btn btn--white btn--m"><span class="btn__text"><?php echo esc_html(theme_pf('strength_btn_label')); ?></span><?php echo theme_chevron(); ?></a>
        </div>
    </section>

    <!-- 募集職種 -->
    <section class="top-recruit" id="recruit">
        <div class="container">
            <h2 class="heading-wrap heading-typeC">
                <span class="heading-main js-lines"><?php echo esc_html(theme_pf('recruit_heading')); ?></span>
                <span class="heading-line" aria-hidden="true"></span>
                <span class="heading-sub js-fade"><?php echo esc_html(theme_pf('recruit_sub')); ?></span>
            </h2>
        </div>
        <?php get_template_part('snippet/job-list', null, array('jobs' => $jobs)); ?>
        <div class="container top-recruit__more js-fade">
            <a href="<?php echo esc_url(theme_pf_url(theme_pf('recruit_btn_link'))); ?>" class="btn btn--outline btn--m"><span class="btn__text"><?php echo esc_html(theme_pf('recruit_btn_label')); ?></span><?php echo theme_chevron(); ?></a>
        </div>
    </section>

    <!-- 先輩インタビュー -->
    <section class="interview interview-typeF">
        <div class="container">
            <h2 class="heading-wrap heading-typeC">
                <span class="heading-main js-lines"><?php echo esc_html(theme_pf('interview_heading')); ?></span>
                <span class="heading-line" aria-hidden="true"></span>
            </h2>
        </div>
        <div class="interview__wrap">
            <div class="interview__panel">
                <p class="interview__lead js-fade"><?php echo $text('interview_lead'); ?></p>
                <a href="<?php echo esc_url(theme_pf_url(theme_pf('interview_btn_link'))); ?>" class="btn btn--white btn--m js-fade"><span class="btn__text"><?php echo esc_html(theme_pf('interview_btn_label')); ?></span><?php echo theme_chevron(); ?></a>
            </div>
            <div class="interview__slider-wrap">
                <div class="interview__slider splide" aria-label="<?php echo esc_attr(theme_pf('interview_heading')); ?>">
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

</main>
<?php get_footer(); ?>
