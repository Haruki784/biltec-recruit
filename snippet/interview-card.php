<?php
/**
 * インタビューカード（TOP スライダー・一覧・詳細下の関連で共用）。ループ内で呼ぶ。
 * $args['class'] で li に class を足せる。
 */
$class = isset($args['class']) ? ' ' . $args['class'] : '';
?>
<li class="interview-card<?php echo esc_attr($class); ?>">
    <a href="<?php the_permalink(); ?>" class="interview-card__link">
        <div class="interview-card__img">
            <?php if (has_post_thumbnail()) {
                the_post_thumbnail('large', array('loading' => 'lazy', 'alt' => ''));
            } ?>
            <p class="interview-card__catch">
                <span><?php echo esc_html(theme_field('catch_1')); ?></span><br>
                <span><?php echo esc_html(theme_field('catch_2')); ?></span>
            </p>
        </div>
        <p class="interview-card__name"><?php echo esc_html(theme_field('person_name', get_the_title())); ?></p>
        <p class="interview-card__meta"><?php echo esc_html(theme_field('join_year')); ?>/<?php echo esc_html(theme_field('position')); ?></p>
    </a>
</li>
