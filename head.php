<?php

/**
 * meta description の取得（SEO用、最大160文字）
 */
if (!function_exists('theme_get_meta_description')) {
    function theme_get_meta_description()
    {
        $desc = '';
        if (is_singular()) {
            $desc = get_the_excerpt();
            if (empty($desc)) {
                $desc = strip_tags(get_the_content());
            }
        } elseif (is_category()) {
            $desc = strip_tags(category_description());
        } elseif (is_tag()) {
            $desc = strip_tags(tag_description());
        } elseif (is_post_type_archive()) {
            $desc = strip_tags(get_the_archive_description());
        } elseif (is_author()) {
            $desc = get_the_author_meta('description');
        } elseif (is_search()) {
            $desc = '「' . get_search_query() . '」の検索結果';
        }
        if (empty($desc)) {
            $desc = get_bloginfo('description');
        }
        $desc = preg_replace('/\s+/', ' ', trim($desc));
        return mb_substr($desc, 0, 160);
    }
}

/**
 * canonical URL の取得（重複コンテンツ対策）
 */
if (!function_exists('theme_get_canonical_url')) {
    function theme_get_canonical_url()
    {
        if (is_singular()) {
            return get_permalink();
        }
        if (is_front_page()) {
            return home_url('/');
        }
        if (is_home()) {
            $posts_page = get_option('page_for_posts');
            $url = $posts_page ? get_permalink($posts_page) : home_url('/');
            return is_paged() ? get_pagenum_link(get_query_var('paged')) : $url;
        }
        if (is_category()) {
            $url = get_category_link(get_queried_object_id());
            return is_paged() ? get_pagenum_link(get_query_var('paged')) : $url;
        }
        if (is_tag()) {
            $url = get_tag_link(get_queried_object_id());
            return is_paged() ? get_pagenum_link(get_query_var('paged')) : $url;
        }
        if (is_post_type_archive()) {
            $url = get_post_type_archive_link(get_post_type());
            return is_paged() ? get_pagenum_link(get_query_var('paged')) : $url;
        }
        if (is_author()) {
            $url = get_author_posts_url(get_queried_object_id());
            return is_paged() ? get_pagenum_link(get_query_var('paged')) : $url;
        }
        if (is_search()) {
            return get_search_link();
        }
        return home_url('/');
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <!-- JSが動く環境だけ動きの初期状態（非表示）を使う -->
    <script>document.documentElement.classList.add('js-ready');</script>
    <!-- SEO: meta description -->
    <meta name="description" content="<?php echo esc_attr(theme_get_meta_description()); ?>">

    <!-- SEO: canonical URL -->
    <link rel="canonical" href="<?php echo esc_url(theme_get_canonical_url()); ?>">

    <!-- OGP -->
    <meta property="og:site_name" content="<?php bloginfo('name'); ?>">
    <meta property="og:type" content="<?php echo is_singular() ? 'article' : 'website'; ?>">
    <meta property="og:url" content="<?php echo is_singular() ? esc_url(get_permalink()) : esc_url(home_url('/')); ?>">
    <meta property="og:title" content="<?php echo esc_attr(wp_get_document_title()); ?>">
    <meta property="og:description" content="<?php echo esc_attr(theme_get_meta_description()); ?>">
    <meta property="og:image" content="<?php echo is_singular() && has_post_thumbnail() ? esc_url(get_the_post_thumbnail_url(null, 'full')) : esc_url(get_stylesheet_directory_uri() . '/img/ogp.jpg'); ?>">
    <meta name="twitter:card" content="summary_large_image">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/destyle.css@3.0.2/destyle.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">
    <?php
    // テーマの CSS（この順で読む）。theme_asset() が更新日時を ?ver= に付けるので、修正後にキャッシュが残らない
    $theme_css = array(
        'assets/settings.css', 'assets/settings-full.css', 'assets/base.css', 'assets/base-full.css',
        'base.css', 'article/article.css', 'article/schedule.css', 'article/index.css',
        'style.css', 'add.css', 'option/option.css',
    );
    // ページだけの CSS（assets/pages/<名前>.css）。ページを足したらここに1行足す
    $page_css = array(
        'top'        => is_front_page(),
        'philosophy' => is_page('philosophy'),
        'business'   => is_page('business'),
        'company'    => is_page('company'),
        'process'    => is_page('process'),
        'job'        => is_post_type_archive('job') || is_singular('job'),
        'interview'  => is_post_type_archive('interview') || is_singular('interview'),
        'entry'      => is_page('entry'),
        'privacy'    => is_page('privacy'),
        'thanks'     => is_page('thanks'),
    );
    foreach ($theme_css as $css) {
        echo '<link rel="stylesheet" href="' . esc_url(theme_asset($css)) . '">' . "\n    ";
    }
    foreach ($page_css as $name => $active) {
        if ($active) {
            echo '<link rel="stylesheet" href="' . esc_url(theme_asset('assets/pages/' . $name . '.css')) . '">' . "\n    ";
        }
    }
    ?>
    <?php if (is_front_page()) : ?>
        <link rel="preload" as="image" href="<?php echo esc_url(theme_img('top/main01.webp')); ?>" media="(min-width: 769px)">
        <link rel="preload" as="image" href="<?php echo esc_url(theme_img('top/main01_sp.webp')); ?>" media="(max-width: 768px)">
    <?php endif; ?>
    <!-- デバイス別出し分け用css（最後に読む） -->
    <link rel="stylesheet" href="<?php echo esc_url(theme_asset('assets/device.css')); ?>">
    <?php wp_head(); ?>
</head>