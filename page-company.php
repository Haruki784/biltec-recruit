<?php get_header(); ?>
<?php
/*
 * 会社概要（固定ページ slug: company）
 * デザイン：Figma xfXD7OKD6zxIIIKGHeVqiF 156:1249（PC）/ 156:1564（SP）。2026-11-20 作り直し
 * 文言は page-fields/company.php の初期値に書き、ここでは theme_field('項目名') で取り出す。
 * 使うパーツ：under-mv-typeB / number-typeA（数字。main.js がカウントアップ）/ heading-typeD / table-typeB--info / map-typeA / job-typeA
 * ページ固有のスタイルは assets/pages/company.css。
 */

// 数字のカードを3つずつに分ける（分類の見出しは cp_num_group_N）
$cp_groups = array(1 => array(1, 2, 3), 2 => array(4, 5, 6), 3 => array(7, 8, 9));

/** Google マップの埋め込み・リンクの URL（API キー不要の形式） */
$cp_map_embed = function ($address) {
    return 'https://www.google.com/maps?output=embed&z=16&q=' . rawurlencode($address);
};
$cp_map_link = function ($address) {
    return 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode($address);
};
?>

<main id="main" class="cp-main">

    <?php get_template_part('snippet/under-mv', null, array(
        'title'    => theme_field('cp_mv_title'),
        'image'    => 'company/1_3_main.webp',
        'image_sp' => 'company/1_3_main_sp.webp',
        'image_id' => theme_field('cp_mv_image'),
    )); ?>

    <!-- リード -->
    <section class="cp-lead">
        <div class="container">
            <p class="cp-lead__text js-fade"><?php echo theme_text(theme_field('cp_lead')); ?></p>
        </div>
    </section>

    <!-- 数字で見るビルテック -->
    <section class="cp-numbers">
        <div class="container">
            <h2 class="cp-numbers__heading js-lines"><?php echo esc_html(theme_field('cp_num_heading')); ?></h2>
            <?php foreach ($cp_groups as $g => $nums) : ?>
                <div class="cp-numbers__group">
                    <h3 class="cp-numbers__band js-fade"><?php echo esc_html(theme_field('cp_num_group_' . $g)); ?></h3>
                    <ul class="cp-numbers__items">
                        <?php foreach ($nums as $i => $n) :
                            $item  = theme_field('cp_num_' . $n);
                            $value = trim((string) $item['value']);
                            // カウントアップ用の数値（カンマを外す）。カンマなしで入力された数字は西暦などとしてカンマなしで出す
                            $count = str_replace(',', '', $value);
                            $plain = strpos($value, ',') === false;
                            ?>
                            <li class="count__item number-typeA cp-number js-fade<?php echo $i ? ' js-delay-' . $i : ''; ?>">
                                <div class="number__icon">
                                    <img src="<?php echo esc_url(theme_img(sprintf('company/1_3_ico%02d.svg', $n))); ?>" alt="" width="60" height="60" loading="lazy">
                                </div>
                                <p class="count__text cp-number__title"><?php echo theme_text($item['title']); ?></p>
                                <p class="count__number cp-number__value" data-count="<?php echo esc_attr($count); ?>"<?php echo $plain ? ' data-plain' : ''; ?>>
                                    <span class="count__number-value en"><?php echo esc_html($value); ?></span><span class="cp-number__unit"><?php echo esc_html($item['unit']); ?></span>
                                </p>
                                <p class="cp-number__text"><?php echo theme_text($item['text']); ?></p>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- 会社概要の表 -->
    <section class="cp-table">
        <div class="container">
            <h2 class="heading-typeD heading-typeD--s cp-heading js-fade">会社概要</h2>
            <div class="table table-typeB table-typeB--info table-typeB--dark table-sp-nowrap js-fade">
                <table class="table__content">
                    <tbody>
                        <?php for ($i = 1; $i <= 12; $i++) :
                            $row = theme_field('cp_row_' . $i);
                            if (trim((string) $row['label']) === '') continue; ?>
                            <tr class="table__item">
                                <th class="table__header"><?php echo esc_html($row['label']); ?></th>
                                <td class="table__data"><?php echo theme_text($row['value']); ?></td>
                            </tr>
                        <?php endfor; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- 拠点案内・アクセス -->
    <section class="cp-access">
        <div class="container">
            <h2 class="heading-typeD cp-heading js-fade"><?php echo esc_html(theme_field('cp_access_heading')); ?></h2>
            <div class="cp-access__items">
                <?php for ($b = 1; $b <= 2; $b++) :
                    $base = theme_field('cp_base_' . $b);
                    if (trim((string) $base['name']) === '') continue; ?>
                    <div class="map map-typeA cp-map js-fade<?php echo $b === 2 ? ' js-delay-1' : ''; ?>">
                        <div class="map__head cp-map__frame">
                            <iframe src="<?php echo esc_url($cp_map_embed($base['address'])); ?>" title="<?php echo esc_attr($base['name']); ?>の地図" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
                        </div>
                        <div class="map__bottom cp-map__body">
                            <div class="map__box cp-map__title-row">
                                <h3 class="map__title cp-map__title"><?php echo esc_html($base['name']); ?><?php if ($base['sub']) : ?><small><?php echo esc_html($base['sub']); ?></small><?php endif; ?></h3>
                                <a href="<?php echo esc_url($cp_map_link($base['address'])); ?>" class="map__button cp-map__button en" target="_blank" rel="noopener">MAP<img src="<?php echo esc_url(theme_img('company/map-arrow.svg')); ?>" alt="" width="10" height="10"><span class="screen-reader-text">（Google マップを新しいタブで開く）</span></a>
                            </div>
                            <dl class="cp-map__list">
                                <div class="cp-map__row cp-map__row--icon">
                                    <dt><img src="<?php echo esc_url(theme_img('company/map-add.svg')); ?>" alt="" width="36" height="36">住所</dt>
                                    <dd><?php echo esc_html($base['zip']); ?><br><?php echo esc_html($base['address']); ?></dd>
                                </div>
                            </dl>
                            <dl class="cp-map__list cp-map__list--inline">
                                <?php if ($base['tel']) : ?>
                                    <div class="cp-map__row cp-map__row--icon">
                                        <dt><img src="<?php echo esc_url(theme_img('company/map-tel.svg')); ?>" alt="" width="36" height="36">TEL</dt>
                                        <dd><a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $base['tel'])); ?>"><?php echo esc_html($base['tel']); ?></a></dd>
                                    </div>
                                <?php endif; ?>
                                <?php if ($base['fax']) : ?>
                                    <div class="cp-map__row cp-map__row--icon">
                                        <dt><img src="<?php echo esc_url(theme_img('company/map-fax.svg')); ?>" alt="" width="36" height="36">FAX</dt>
                                        <dd><?php echo esc_html($base['fax']); ?></dd>
                                    </div>
                                <?php endif; ?>
                            </dl>
                            <dl class="cp-map__list">
                                <?php for ($r = 1; $r <= 4; $r++) :
                                    $info = theme_field('cp_base_' . $b . '_info_' . $r);
                                    if (trim((string) $info['label']) === '') continue; ?>
                                    <div class="cp-map__row">
                                        <dt><?php echo esc_html($info['label']); ?></dt>
                                        <dd><?php echo theme_text($info['value']); ?></dd>
                                    </div>
                                <?php endfor; ?>
                            </dl>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
    </section>

    <!-- 募集職種（TOP・手すりができるまでと共通） -->
    <section class="cp-recruit" id="recruit">
        <div class="container">
            <h2 class="heading-wrap heading-typeC heading-typeC--s">
                <span class="heading-main js-lines"><?php echo theme_text(theme_field('cp_recruit_heading')); ?></span>
            </h2>
        </div>
        <?php get_template_part('snippet/job-list'); ?>
    </section>

</main>
<?php get_footer(); ?>
