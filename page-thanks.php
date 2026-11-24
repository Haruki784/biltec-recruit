<?php
get_header();
?>

<main id="main">
    <section class="thanks py-9">
        <div class="container">
            <div class="thanks__content grid grid-1 gap-y-6">
                <?php get_template_part('snippet/breadcrumb'); ?>
                <div class="thanks__icon">
                    <svg class="thanks__check" width="120" height="120" viewBox="0 0 120 120" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <circle class="thanks__check-circle" cx="60" cy="60" r="55" stroke="currentColor"
                            stroke-width="4" fill="none" />
                        <path class="thanks__check-mark" d="M35 60L50 75L85 40" stroke="currentColor"
                            stroke-width="6" stroke-linecap="round" stroke-linejoin="round" fill="none" />
                    </svg>
                </div>
                <h2 class="thanks__head grid grid-1 gap-y-2">
                    <span class="heading-3 thanks__title">Thank you for your entry!</span>
                    <span class="text-lg">エントリーありがとうございます!</span>
                </h2>
                <p class="thanks__text text-base text-base-sp">
                    あなたのエントリーは無事に受理されました。<br>
                    ご入力頂いたメールアドレス宛へ、ご確認メールをお送りしておりますのでご確認ください。<br>
                    頂いた内容を確認し、追ってご連絡いたします。<br>
                    あなたとお話しできるのを楽しみにしています！<br>
                    もし疑問や不明点があれば、<br>
                    下記メールアドレスにお気軽にお知らせください。
                </p>
                <?php get_template_part('snippet/contact-address'); ?>
                <p class="privacy__caption caption">
                    ※ご送信後、ご確認メールが届かない場合は、フォームご入力のメールアドレスの誤り、<br>
                    もしくはシステム等の不具合が考えられます。その際にはお手数ですが<br>
                    もう一度ご送信いただくか、お電話(000-000-000)にてお問い合わせくださいますようお願い申し上げます。<br>
                    また、まれに迷惑メールフォルダへ入っている場合がございますので、合わせてご確認ください。
                </p>
            </div>
        </div>
    </section>

</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            var icon = document.querySelector('.thanks__icon');
            if (icon) icon.classList.add('animated');
        }, 100);
    });
</script>

<?php get_footer(); ?>