<?php
/**
 * job-typeA：募集職種リスト（左右交互）。TOP・手すりができるまで で共用。
 * $args['jobs'] に CPT job の投稿配列を渡す（省略時は全件）。
 */
$jobs = isset($args['jobs']) ? $args['jobs'] : get_posts(array('post_type' => 'job', 'numberposts' => -1, 'orderby' => 'menu_order', 'order' => 'ASC'));
if (!$jobs) return;
?>
<ul class="job job-typeA">
    <?php foreach ($jobs as $i => $job) :
        $sub   = theme_field('card_title_sub', '', $job->ID);
        $badge = theme_field('badge', '', $job->ID);
        $url   = get_permalink($job);
        $title = get_the_title($job);
    ?>
        <li class="job__item<?php echo $i % 2 ? ' job__item--reverse' : ''; ?>">
            <a href="<?php echo esc_url($url); ?>" class="job__media img-zoom js-slide" tabindex="-1" aria-hidden="true">
                <?php echo get_the_post_thumbnail($job, 'large', array('class' => 'job__img', 'loading' => 'lazy', 'alt' => '')); ?>
                <span class="job__media-title"><?php echo esc_html($title); ?><?php if ($sub) : ?><small><?php echo esc_html($sub); ?></small><?php endif; ?></span>
                <span class="job__media-arrow" aria-hidden="true"></span>
            </a>
            <div class="job__body js-fade">
                <?php if ($badge) : ?>
                    <?php
                    // 最後の行（例：増員）だけ大きく太く出す
                    $badge_lines = preg_split('/\R/u', trim($badge));
                    $badge_last  = array_pop($badge_lines);
                    ?>
                    <p class="job__badge"><span><?php echo implode('<br>', array_map('esc_html', $badge_lines)); ?></span><strong><?php echo esc_html($badge_last); ?></strong></p>
                <?php endif; ?>
                <h3 class="job__title"><a href="<?php echo esc_url($url); ?>"><?php echo esc_html($title . $sub); ?></a></h3>
                <p class="job__catch"><?php echo esc_html(theme_field('catch', '', $job->ID)); ?></p>
                <p class="job__tags"><?php echo nl2br(esc_html(theme_field('tags', '', $job->ID))); ?></p>
                <a href="<?php echo esc_url($url); ?>" class="btn btn--primary btn--l job__btn"><span class="btn__text"><span class="job__btn-prefix"><?php echo esc_html($title); ?>の</span>詳細・募集要項を見る</span><?php echo theme_chevron(); ?></a>
            </div>
        </li>
    <?php endforeach; ?>
</ul>
