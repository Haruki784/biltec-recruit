<?php get_header(); ?>
<?php
/*
 * 募集要項 詳細（CPT job /job/<slug>/）
 * 1つのテンプレートで全職種を出す。文言は各投稿の入力項目（page-fields/job.php）、未入力なら初期値。
 * スタイルは assets/pages/job.css。
 */

/** テキストエリアの値を改行つきで出す */
$job_text = function ($value) {
    return nl2br(esc_html(trim((string) $value)));
};

/** 1行1項目のテキストエリアを配列に（空行は除く） */
$job_lines = function ($value) {
    return array_values(array_filter(array_map('trim', preg_split('/\R/u', (string) $value)), 'strlen'));
};

/** 左に縦線の見出し（heading-typeD） */
$job_heading = function ($text) use ($job_text) {
    ?>
    <h2 class="heading-wrap heading-typeD">
        <span class="heading-main js-lines"><?php echo $job_text($text); ?></span>
    </h2>
    <?php
};

$job_id = get_the_ID();

// MV画像：入力 → アイキャッチ → テーマの画像
$mv_image_id = theme_field('job_mv_image') ?: get_post_thumbnail_id($job_id);

// 募集要項の表：項目名は page-fields/job.php のラベルを使う
$job_fields = theme_field_groups()['job']['fields'];
$req_rows   = array();
foreach (array('req_title', 'req_work', 'req_condition', 'req_place', 'req_salary', 'req_time', 'req_holiday', 'req_welfare') as $name) {
    $req_rows[] = array('label' => $job_fields[$name]['label'], 'value' => theme_field($name));
}
foreach (array('req_extra_1', 'req_extra_2') as $name) {
    $extra = theme_field($name);
    $req_rows[] = array('label' => $extra['label'] ?? '', 'value' => $extra['value'] ?? '');
}
$req_rows = array_filter($req_rows, function ($row) {
    return trim((string) $row['label']) !== '' && trim((string) $row['value']) !== '';
});

$entry_lines = $job_lines(theme_field('job_entry_btn'));
$entry_main  = array_pop($entry_lines);
?>

<main class="job-main job-detail">

    <!-- MV（左テキスト／右写真） -->
    <section class="job-mv job-mv-typeA">
        <div class="job-mv__breadcrumb">
            <?php get_template_part('snippet/breadcrumb'); ?>
        </div>
        <div class="job-mv__inner">
            <div class="job-mv__img">
                <picture>
                    <?php if (!$mv_image_id) : ?>
                        <source srcset="<?php echo esc_url(theme_img('job/3_1_main_sp.webp')); ?>" media="(max-width: 768px)">
                    <?php endif; ?>
                    <?php echo theme_image($mv_image_id, 'job/3_1_main.webp', array('width' => 1380, 'height' => 1000, 'loading' => 'eager', 'fetchpriority' => 'high'), 'full'); ?>
                </picture>
            </div>
            <div class="job-mv__content">
                <?php if (trim((string) theme_field('job_mv_catch')) !== '') : ?>
                    <p class="job-mv__catch"><?php echo $job_text(theme_field('job_mv_catch')); ?></p>
                <?php endif; ?>
                <h1 class="job-mv__title"><?php the_title(); ?></h1>
                <?php if (theme_field('job_mv_tags')) : ?>
                    <p class="job-mv__tags"><?php echo esc_html(theme_field('job_mv_tags')); ?></p>
                <?php endif; ?>
                <?php if (trim((string) theme_field('job_mv_text')) !== '') : ?>
                    <p class="job-mv__text"><?php echo $job_text(theme_field('job_mv_text')); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- 紹介文 -->
    <?php if (trim((string) theme_field('job_intro_heading')) !== '' || trim((string) theme_field('job_intro_text')) !== '') : ?>
        <section class="job-section job-intro">
            <div class="job-inner">
                <?php $job_heading(theme_field('job_intro_heading')); ?>
                <p class="job-intro__text js-fade"><?php echo $job_text(theme_field('job_intro_text')); ?></p>
            </div>
        </section>
    <?php endif; ?>

    <!-- 募集要項 -->
    <section class="job-section job-req">
        <div class="job-inner">
            <?php $job_heading(theme_field('job_req_heading')); ?>
            <?php if ($req_rows) : ?>
                <div class="table table-typeB table-typeB--info table-sp-nowrap js-fade">
                    <table class="table__content">
                        <?php foreach ($req_rows as $row) : ?>
                            <tr class="table__item">
                                <th class="table__header"><?php echo esc_html($row['label']); ?></th>
                                <td class="table__data"><?php echo $job_text($row['value']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            <?php endif; ?>
            <div class="job-entry js-fade">
                <a href="<?php echo esc_url(theme_entry_url('entry')); ?>" class="btn btn--gradient job-entry__btn">
                    <span class="btn__text"><?php foreach ($entry_lines as $line) : ?><small><?php echo esc_html($line); ?></small><?php endforeach; ?><?php echo esc_html($entry_main); ?></span><?php echo theme_chevron(); ?>
                </a>
            </div>
        </div>
    </section>

    <!-- こんな方にピッタリ／求める人物像／主な業務内容／この仕事の魅力・やりがい（空のブロックは出さない） -->
    <section class="job-section job-points">
        <div class="media media-typeA">
            <?php foreach (array('job_fit', 'job_person', 'job_duties', 'job_appeal') as $i => $name) :
                $block = theme_field($name);
                $items = $job_lines($block['list']);
                if (trim((string) $block['heading']) === '' && !$items) continue; ?>
                <div class="media__item<?php echo $i % 2 ? ' media__item--reverse' : ''; ?>">
                    <div class="media__img js-fade">
                        <?php echo theme_image($block['image'], 'job/3_1_0' . ($i % 3 + 1) . '.webp', array('width' => 720, 'height' => 400)); ?>
                    </div>
                    <div class="media__body js-fade">
                        <h3 class="media__title"><?php echo esc_html($block['heading']); ?></h3>
                        <?php if (trim((string) $block['lead']) !== '') : ?>
                            <p class="job-points__lead"><?php echo $job_text($block['lead']); ?></p>
                        <?php endif; ?>
                        <?php if ($items) : ?>
                            <ul class="job-points__list media__text">
                                <?php foreach ($items as $item) :
                                    $parts = array_map('trim', explode('｜', $item, 2)); ?>
                                    <li class="job-points__item"><?php echo esc_html($parts[0]); ?><?php if (isset($parts[1]) && $parts[1] !== '') : ?><br><?php echo esc_html($parts[1]); ?><?php endif; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

</main>
<?php get_footer(); ?>
