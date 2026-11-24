<?php get_header(); ?>

<style>
    .error404 {
        min-height: 50vh;
    }

    .error404__content {
        display: grid;
        gap: var(--spacing-4, 2.4rem);
        justify-items: center;
        text-align: center;
        max-width: 64rem;
        margin: 0 auto;
        padding-top: var(--spacing-6, 4rem);
        padding-bottom: var(--spacing-6, 4rem);
    }

    .error404__code {
        font-family: var(--english-font-family, 'Manrope', sans-serif);
        font-size: 12rem;
        font-weight: 700;
        line-height: 1;
        letter-spacing: 0.04em;
        color: var(--text-color, #01033e);
        opacity: 0.12;
        margin: 0;
    }

    .error404__title {
        margin: 0;
    }

    .error404__text {
        margin: 0;
        color: var(--text-color, #01033e);
    }

    .error404__actions {
        display: flex;
        flex-wrap: wrap;
        gap: var(--spacing-3, 1.6rem);
        justify-content: center;
        margin-top: var(--spacing-2, 1.2rem);
    }

    .error404__button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 20rem;
        padding: 1.4rem 3.2rem;
        border: 1px solid var(--text-color, #01033e);
        border-radius: 9999px;
        font-size: var(--text-lg, 1.6rem);
        font-weight: var(--bold, 800);
        color: var(--text-color, #01033e);
        text-decoration: none;
        transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
    }

    .error404__button:hover {
        background-color: var(--text-color, #01033e);
        border-color: var(--text-color, #01033e);
        color: var(--white, #ffffff);
    }

    @media (max-width: 768px) {
        .error404__content {
            padding-top: var(--spacing-5-sp, 2.4rem);
            padding-bottom: var(--spacing-5-sp, 2.4rem);
        }

        .error404__code {
            font-size: 8rem;
        }

        .error404__button {
            min-width: 100%;
        }
    }
</style>

<main id="main">
    <section class="error404 py-9">
        <div class="container grid grid-1 gap-y-6">
            <?php get_template_part('snippet/breadcrumb'); ?>

            <div class="error404__content">
                <p class="error404__code" aria-hidden="true">404</p>
                <h1 class="error404__title heading-3">ページが見つかりません</h1>
                <p class="error404__text text-base text-base-sp">
                    お探しのページは削除されたか、URLが変更された可能性があります。<br>
                    URLをご確認のうえ、再度お試しください。
                </p>
                <div class="error404__actions">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="error404__button">トップページへ</a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
