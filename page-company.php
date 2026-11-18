<?php get_header(); ?>
<?php
/*
 * 会社概要（固定ページ slug: company）
 * デザインは他社サイトのレイアウト流用（Figma 156:1249 / SP 156:1564）。文言はビルテックのもの。
 * 文言は page-fields/company.php の初期値に書き、ここでは theme_field('項目名') で取り出す。
 * ページ固有のスタイルは assets/pages/company.css。
 */

/** テキストエリアの値を改行つきで出す */
$cp_text = function ($value) {
    return nl2br(esc_html(trim((string) $value)));
};

/** 英字の小見出し＋大きい和文＋「／ 小さい文字」＋線（事業紹介・採用情報） */
$cp_heading = function ($en, $main, $sub, $modifier = '') {
    ?>
    <h2 class="cp-heading<?php echo $modifier ? ' cp-heading--' . esc_attr($modifier) : ''; ?>">
        <span class="cp-heading__en en js-fade"><?php echo esc_html($en); ?></span>
        <span class="cp-heading__main js-lines"><?php echo esc_html($main); ?><?php if ($sub) : ?><small class="cp-heading__sub"><?php echo esc_html($sub); ?></small><?php endif; ?></span>
    </h2>
    <?php
};

// 事業紹介の写真（未設定時のテーマ画像）
$cp_biz_images = array(1 => 'process/2_2_02.webp', 2 => 'process/2_2_03.webp', 3 => 'process/2_2_05.webp');
?>

<main class="cp-main">

    <?php get_template_part('snippet/under-mv', null, array(
        'title'    => theme_field('cp_mv_title'),
        'image'    => 'business/1_2_main.webp',
        'image_id' => theme_field('cp_mv_image'),
    )); ?>

    <!-- TOP MESSAGE -->
    <section class="cp-message">
        <p class="cp-message__deco en" aria-hidden="true">TOP MESSAGE</p>
        <div class="cp-inner">
            <div class="cp-message__head">
                <div class="cp-message__lead">
                    <h2 class="cp-message__catch js-lines"><?php echo $cp_text(theme_field('cp_msg_catch')); ?></h2>
                    <p class="cp-message__name js-fade"><?php echo $cp_text(theme_field('cp_msg_name')); ?></p>
                </div>
                <div class="cp-message__img js-fade">
                    <?php echo theme_image(theme_field('cp_msg_image'), 'philosophy/1_1_01.webp', array('width' => 400, 'height' => 300)); ?>
                </div>
            </div>
            <p class="cp-message__text js-fade"><?php echo $cp_text(theme_field('cp_msg_text')); ?></p>
        </div>
    </section>

    <!-- 事業紹介 -->
    <section class="cp-business">
        <div class="cp-inner cp-inner--wide">
            <?php $cp_heading('Business introduction', theme_field('cp_biz_heading'), theme_field('cp_biz_sub'), 'white'); ?>
            <ul class="cp-business__items">
                <?php for ($i = 1; $i <= 3; $i++) :
                    $b = theme_field('cp_biz_' . $i);
                    if ($b['title'] === '') continue; ?>
                    <li class="cp-business__item js-fade">
                        <div class="cp-business__body">
                            <h3 class="cp-business__title"><span class="cp-business__num en"><?php echo sprintf('%02d.', $i); ?></span><?php echo esc_html($b['title']); ?></h3>
                            <?php if ($b['text']) : ?>
                                <p class="cp-business__text"><?php echo $cp_text($b['text']); ?></p>
                            <?php endif; ?>
                            <?php if ($b['url']) : ?>
                                <a href="<?php echo esc_url($b['url']); ?>" class="btn btn--outline btn--m cp-business__btn"><span class="btn__text">詳しくはこちら</span><?php echo theme_chevron(); ?></a>
                            <?php endif; ?>
                        </div>
                        <div class="cp-business__img">
                            <?php echo theme_image($b['image'], $cp_biz_images[$i], array('width' => 840, 'height' => 660)); ?>
                        </div>
                    </li>
                <?php endfor; ?>
            </ul>
        </div>
    </section>

    <!-- 会社概要の表 -->
    <section class="cp-table">
        <div class="cp-inner">
            <h2 class="heading-typeD heading-typeD--s js-fade">会社概要</h2>
            <div class="table table-typeB table-typeB--info table-typeB--dark table-sp-nowrap js-fade">
                <table class="table__content">
                    <tbody>
                        <?php for ($i = 1; $i <= 12; $i++) :
                            $row = theme_field('cp_row_' . $i);
                            if (trim((string) $row['label']) === '') continue; ?>
                            <tr class="table__item">
                                <th class="table__header"><?php echo esc_html($row['label']); ?></th>
                                <td class="table__data"><?php echo $cp_text($row['value']); ?></td>
                            </tr>
                        <?php endfor; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- 採用情報 -->
    <section class="cp-recruit">
        <div class="cp-inner cp-inner--wide">
            <?php $cp_heading('Recruitment', theme_field('cp_rec_heading'), theme_field('cp_rec_sub')); ?>
            <p class="cp-recruit__lead js-fade"><?php echo $cp_text(theme_field('cp_rec_lead')); ?></p>
            <div class="cp-recruit__links">
                <a href="<?php echo esc_url(home_url('/job/')); ?>" class="cp-recruit__link cp-recruit__link--main js-fade">
                    <span class="cp-recruit__label">募集職種一覧・募集要項<?php echo theme_chevron(); ?></span>
                    <span class="cp-recruit__img img-zoom"><img src="<?php echo esc_url(theme_img('job/3_1_main.webp')); ?>" alt="" width="1380" height="1000" loading="lazy"></span>
                </a>
                <a href="<?php echo esc_url(home_url('/interview/')); ?>" class="cp-recruit__link cp-recruit__link--sub js-fade">
                    <span class="cp-recruit__label">先輩インタビュー<?php echo theme_chevron(); ?></span>
                </a>
                <a href="<?php echo esc_url(home_url('/process/')); ?>" class="cp-recruit__link cp-recruit__link--sub cp-recruit__link--light js-fade">
                    <span class="cp-recruit__label">手すりができるまで<?php echo theme_chevron(); ?></span>
                </a>
            </div>
        </div>
    </section>

</main>
<?php get_footer(); ?>
