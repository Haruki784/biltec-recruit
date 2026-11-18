<?php
if (is_front_page()) return;

$items   = [];
$items[] = ['url' => home_url('/'), 'name' => 'ホーム'];

if (is_singular()) {
    $post_type = get_post_type();

    if ($post_type === 'post') {
        $categories = get_the_category();
        if ($categories) {
            $cat = $categories[0];
            $items[] = ['url' => get_category_link($cat->term_id), 'name' => esc_html($cat->name)];
        }
    } elseif ($post_type !== 'page') {
        $post_type_obj = get_post_type_object($post_type);
        if ($post_type_obj && $post_type_obj->has_archive) {
            $items[] = ['url' => get_post_type_archive_link($post_type), 'name' => esc_html($post_type_obj->labels->name)];
        }
    }

    if ($post_type === 'page') {
        $ancestors = array_reverse(get_post_ancestors(get_the_ID()));
        foreach ($ancestors as $ancestor_id) {
            $items[] = ['url' => get_permalink($ancestor_id), 'name' => esc_html(get_the_title($ancestor_id))];
        }
    }

    $items[] = ['url' => get_permalink(), 'name' => esc_html(get_the_title())];
} elseif (is_category()) {
    $items[] = ['url' => get_category_link(get_queried_object_id()), 'name' => esc_html(single_cat_title('', false))];
} elseif (is_tag()) {
    $items[] = ['url' => get_tag_link(get_queried_object_id()), 'name' => esc_html(single_tag_title('', false))];
} elseif (is_post_type_archive()) {
    $post_type = get_post_type();
    $archive_name = $post_type === 'post' ? 'インタビュー一覧' : post_type_archive_title('', false);
    $items[] = ['url' => get_post_type_archive_link($post_type), 'name' => esc_html($archive_name)];
} elseif (is_search()) {
    $items[] = ['url' => get_search_link(get_search_query()), 'name' => '「' . esc_html(get_search_query()) . '」の検索結果'];
} elseif (is_404()) {
    $items[] = ['url' => '', 'name' => 'ページが見つかりません'];
}

?>
<nav class="breadcrumb container" aria-label="パンくずリスト">
    <ol class="breadcrumb__items" itemscope itemtype="https://schema.org/BreadcrumbList">
        <?php foreach ($items as $index => $item) : ?>
            <?php $is_last = $index === count($items) - 1; ?>
            <li class="breadcrumb__item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" <?php echo $is_last ? ' aria-current="page"' : ''; ?>>
                <?php if (!$is_last && $item['url']) : ?>
                    <a href="<?php echo esc_url($item['url']); ?>" class="breadcrumb__link" itemprop="item">
                        <span itemprop="name"><?php echo $item['name']; ?></span>
                    </a>
                <?php else : ?>
                    <span class="breadcrumb__current" itemprop="name"><?php echo $item['name']; ?></span>
                <?php endif; ?>
                <meta itemprop="position" content="<?php echo $index + 1; ?>">
            </li>
        <?php endforeach; ?>
    </ol>
</nav>