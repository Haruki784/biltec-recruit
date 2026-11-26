<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php get_template_part('head'); ?>
<?php
$nav       = theme_nav(); // 外観 → カスタマイズ → メニュー（function/functions_menu.php）
$logo_sub  = trim((string) theme_option('logo_sub'));
$btn_1     = theme_button('header_btn_1', home_url('/job/'));
$btn_2     = theme_button('header_btn_2', theme_entry_url('casual'));
?>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <a class="skip-link screen-reader-text" href="#main">本文へスキップ</a>
    <?php // TOP は MV の上で透明（.is-clear）。スクロールで MV を過ぎたら add.js が外す ?>
    <header class="header header-typeD fixed<?php echo is_front_page() ? ' is-clear' : ''; ?>" id="header">
        <div class="header__container">
            <?php $logo_tag = is_front_page() ? 'h1' : 'p'; ?>
            <<?php echo $logo_tag; ?> class="logo header__logo">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="logo__link">
                    <img src="<?php echo esc_url(theme_image_url(theme_option('logo_image'), 'logo.svg')); ?>" alt="<?php echo esc_attr(theme_option('logo_alt')); ?>" width="136" height="26" class="logo__img logo__img--color">
                    <img src="<?php echo esc_url(theme_image_url(theme_option('logo_image_white'), 'logo_w.svg')); ?>" alt="" width="136" height="26" class="logo__img logo__img--white" aria-hidden="true">
                    <?php if ($logo_sub !== '') : ?><span class="logo__sub"><?php echo esc_html($logo_sub); ?></span><?php endif; ?>
                </a>
            </<?php echo $logo_tag; ?>>
            <div class="header__box">
                <nav class="gnav header__gnav hide-md-only" aria-label="グローバルナビゲーション">
                    <ul class="gnav__items">
                        <?php foreach ($nav as $item) : ?>
                            <?php if (!$item['children']) : // 子のない項目（HOME など）はそのままリンク ?>
                                <li class="gnav__item">
                                    <a href="<?php echo esc_url($item['url'] ?: home_url('/')); ?>" class="gnav__link"><?php echo esc_html($item['label']); ?></a>
                                </li>
                                <?php continue; ?>
                            <?php endif; ?>
                            <li class="gnav__item">
                                <span class="gnav__link toggle" tabindex="0"><?php echo esc_html($item['label']); ?><span class="gnav__plus" aria-hidden="true"></span></span>
                                <ul class="nav nav__items">
                                    <?php if (!empty($item['index'])) : ?>
                                        <li class="nav__item"><a href="<?php echo esc_url($item['index']['url']); ?>" class="nav__link"><?php echo esc_html($item['index']['label']); ?></a></li>
                                    <?php endif; ?>
                                    <?php foreach ($item['children'] as $child) : ?>
                                        <li class="nav__item"><a href="<?php echo esc_url($child['url']); ?>" class="nav__link"><?php echo esc_html($child['label']); ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </nav>
                <div class="header__buttons hide-md-only">
                    <a href="<?php echo esc_url($btn_1['url']); ?>" class="btn btn--black btn--s"><span class="btn__text"><?php echo esc_html($btn_1['text']); ?></span><?php echo theme_chevron(); ?></a>
                    <a href="<?php echo esc_url($btn_2['url']); ?>" class="btn btn--gradient btn--s btn--wide"><span class="btn__text"><?php echo esc_html($btn_2['text']); ?></span><?php echo theme_chevron(); ?></a>
                </div>
                <button type="button" class="menu header__menu header__menu-typeD show-md-only" aria-label="メニューを開く" aria-controls="drawer" aria-expanded="false">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>

        <div class="drawer drawer-typeD" id="drawer">
            <div class="drawer__inner">
                <p class="drawer__title en">MENU</p>
                <nav class="drawer__nav" aria-label="メニュー">
                    <ul class="drawer__items">
                        <?php foreach ($nav as $item) : ?>
                            <?php if (!$item['children']) : ?>
                                <li class="drawer__item">
                                    <a href="<?php echo esc_url($item['url'] ?: home_url('/')); ?>" class="drawer__link"><?php echo esc_html($item['label']); ?></a>
                                </li>
                                <?php continue; ?>
                            <?php endif; ?>
                            <li class="drawer__item">
                                <button type="button" class="drawer__toggle toggle" aria-expanded="false"><?php echo esc_html($item['label']); ?><span class="gnav__plus" aria-hidden="true"></span></button>
                                <ul class="drawer__children toggle__content">
                                    <?php if (!empty($item['index'])) : ?>
                                        <li><a href="<?php echo esc_url($item['index']['url']); ?>" class="drawer__child-link drawer__link"><span class="drawer__dash">－</span><?php echo esc_html($item['index']['label']); ?></a></li>
                                    <?php endif; ?>
                                    <?php foreach ($item['children'] as $child) : ?>
                                        <li><a href="<?php echo esc_url($child['url']); ?>" class="drawer__child-link drawer__link"><span class="drawer__dash">－</span><?php echo esc_html($child['label']); ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </nav>
                <div class="drawer__buttons">
                    <a href="<?php echo esc_url($btn_1['url']); ?>" class="btn btn--black btn--l"><span class="btn__text"><?php echo esc_html($btn_1['text']); ?></span></a>
                    <a href="<?php echo esc_url($btn_2['url']); ?>" class="btn btn--gradient btn--l"><span class="btn__text"><?php echo esc_html($btn_2['text']); ?></span></a>
                </div>
            </div>
        </div>
    </header>

    <div class="sp-fixed-cta small-hide" aria-label="応募ボタン">
        <a href="<?php echo esc_url($btn_1['url']); ?>" class="btn btn--black btn--s"><span class="btn__text"><?php echo esc_html($btn_1['text']); ?></span><?php echo theme_chevron(); ?></a>
        <a href="<?php echo esc_url($btn_2['url']); ?>" class="btn btn--gradient btn--s"><span class="btn__text"><?php echo esc_html($btn_2['text']); ?></span><?php echo theme_chevron(); ?></a>
    </div>
