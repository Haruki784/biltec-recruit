<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php get_template_part('head'); ?>
<?php $nav = theme_nav(); ?>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <header class="header header-typeD fixed" id="header">
        <div class="header__container">
            <?php $logo_tag = is_front_page() ? 'h1' : 'p'; ?>
            <<?php echo $logo_tag; ?> class="logo header__logo">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="logo__link">
                    <img src="<?php echo esc_url(theme_img('logo.svg')); ?>" alt="BILTEC ビルテック株式会社" width="136" height="26" class="logo__img">
                    <span class="logo__sub">中途採用サイト</span>
                </a>
            </<?php echo $logo_tag; ?>>
            <div class="header__box">
                <nav class="gnav header__gnav hide-md-only" aria-label="グローバルナビゲーション">
                    <ul class="gnav__items">
                        <li class="gnav__item">
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="gnav__link">HOME</a>
                        </li>
                        <?php foreach ($nav as $item) : ?>
                            <li class="gnav__item">
                                <span class="gnav__link toggle" tabindex="0"><?php echo esc_html($item['label']); ?><span class="gnav__plus" aria-hidden="true"></span></span>
                                <ul class="nav nav__items">
                                    <?php foreach ($item['children'] as $child) : ?>
                                        <li class="nav__item"><a href="<?php echo esc_url($child['url']); ?>" class="nav__link"><?php echo esc_html($child['label']); ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </nav>
                <div class="header__buttons hide-md-only">
                    <a href="<?php echo esc_url(home_url('/job/')); ?>" class="btn btn--black btn--s"><span class="btn__text">募集要項</span><?php echo theme_chevron(); ?></a>
                    <a href="<?php echo esc_url(theme_entry_url('casual')); ?>" class="btn btn--gradient btn--s btn--wide"><span class="btn__text">まずは話を聞いてみる</span><?php echo theme_chevron(); ?></a>
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
                        <li class="drawer__item">
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="drawer__link">HOME</a>
                        </li>
                        <?php foreach ($nav as $item) : ?>
                            <li class="drawer__item">
                                <button type="button" class="drawer__toggle toggle" aria-expanded="false"><?php echo esc_html($item['label']); ?><span class="gnav__plus" aria-hidden="true"></span></button>
                                <ul class="drawer__children toggle__content">
                                    <?php foreach ($item['children'] as $child) : ?>
                                        <li><a href="<?php echo esc_url($child['url']); ?>" class="drawer__child-link drawer__link">－<?php echo esc_html($child['label']); ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </nav>
                <div class="drawer__buttons">
                    <a href="<?php echo esc_url(home_url('/job/')); ?>" class="btn btn--black btn--l"><span class="btn__text">募集要項</span></a>
                    <a href="<?php echo esc_url(theme_entry_url('casual')); ?>" class="btn btn--gradient btn--l"><span class="btn__text">まずは話を聞いてみる</span></a>
                </div>
            </div>
        </div>
    </header>

    <div class="sp-fixed-cta small-hide" aria-label="応募ボタン">
        <a href="<?php echo esc_url(home_url('/job/')); ?>" class="btn btn--black btn--s"><span class="btn__text">募集要項</span><?php echo theme_chevron(); ?></a>
        <a href="<?php echo esc_url(theme_entry_url('casual')); ?>" class="btn btn--gradient btn--s"><span class="btn__text">まずは話を聞いてみる</span><?php echo theme_chevron(); ?></a>
    </div>
