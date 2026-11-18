<?php
get_header();
?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // date型のinputフィールド全体をクリックしたときにカレンダーを開く
        const dateInputs = document.querySelectorAll('input[type="date"]');

        // 今日の日付を取得してYYYY-MM-DD形式にフォーマット
        const today = new Date();
        const year = today.getFullYear();
        const month = String(today.getMonth() + 1).padStart(2, '0');
        const day = String(today.getDate()).padStart(2, '0');
        const todayFormatted = `${year}-${month}-${day}`;

        dateInputs.forEach(function(input) {
            // デフォルト値が設定されていない場合のみ今日の日付を設定
            if (!input.value) {
                input.value = todayFormatted;
            }

            input.addEventListener('click', function(e) {
                // カレンダーピッカーを開く（モダンブラウザのみ対応）
                if (this.showPicker) {
                    try {
                        this.showPicker();
                    } catch (error) {
                        // showPicker()がサポートされていない場合は何もしない
                        console.log('showPicker not supported');
                    }
                }
            });
        });

        // ファイル選択の状態に応じてクラスを切り替え
        const fileInputs = document.querySelectorAll('input[type="file"]');
        fileInputs.forEach(function(input) {
            input.addEventListener('change', function() {
                if (this.files && this.files.length > 0) {
                    this.classList.add('has-file');
                } else {
                    this.classList.remove('has-file');
                }
            });
        });

        // form__kana：入力中にカタカナ以外でエラー表示
        function validateKanaField(input) {
            var wrap = input.closest('.wpcf7-form-control-wrap');
            if (!wrap) return true;
            var value = input.value.trim();
            var errorEl = wrap.querySelector('.form__kana-error');

            if (value === '') {
                wrap.classList.remove('form__kana--error');
                if (errorEl) errorEl.remove();
                return true;
            }
            if (!/^[\u30A0-\u30FF\s]+$/.test(value)) {
                wrap.classList.add('form__kana--error');
                if (!errorEl) {
                    errorEl = document.createElement('span');
                    errorEl.className = 'form__kana-error wpcf7-not-valid-tip';
                    errorEl.textContent = 'カタカナで入力してください。';
                    wrap.appendChild(errorEl);
                }
                return false;
            } else {
                wrap.classList.remove('form__kana--error');
                if (errorEl) errorEl.remove();
                return true;
            }
        }

        function bindKanaValidation() {
            var inputs = document.querySelectorAll('input.form__kana, .form__kana input, .wpcf7-form-control-wrap[data-name="your-name-kana"] input, input[name="your-name-kana"]');
            inputs.forEach(function(input) {
                ['input', 'keyup', 'blur', 'paste'].forEach(function(ev) {
                    input.removeEventListener(ev, input._kanaHandler);
                    input._kanaHandler = function() {
                        validateKanaField(input);
                    };
                    input.addEventListener(ev, input._kanaHandler);
                });
            });
        }
        bindKanaValidation();
        document.addEventListener('wpcf7mailsent', bindKanaValidation);
        document.addEventListener('wpcf7invalid', bindKanaValidation);

        // 送信前にバリデーション、エラーがあれば送信をブロック
        document.addEventListener('submit', function(e) {
            var form = e.target.closest('.wpcf7-form');
            if (!form) return;
            var inputs = form.querySelectorAll('input.form__kana, .form__kana input, .wpcf7-form-control-wrap[data-name="your-name-kana"] input, input[name="your-name-kana"]');
            var hasError = false;
            inputs.forEach(function(input) {
                if (!validateKanaField(input)) hasError = true;
            });
            if (hasError) {
                e.preventDefault();
                e.stopImmediatePropagation();
                var firstError = form.querySelector('.form__kana--error');
                if (firstError) {
                    var formItem = firstError.closest('.form__item');
                    if (formItem) formItem.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }
            }
        }, true);
    });
</script>

<main>
    <section class="under-mv under-mv-typeA pb-5">
        <div class="under-mv__img">
            <picture>
                <source srcset="https://placehold.jp/375x280.png" media="(max-width: 768px)">
                <img src="https://placehold.jp/1440x480.png" alt="">
            </picture>
        </div>
        <div class="under-mv__container container pt-6 pb-5 py-5-sp-full grid grid-1 gap-y-1-full">
            <h1 class="under-mv__title heading-1-full en">Cross Talk</h1>
            <div class="under-mv__subtitle heading-4-full">クロストーク</div>
        </div>
        <?php get_template_part('snippet/breadcrumb'); ?>
    </section>
    <div class="mt-8"></div>
    <?php the_content(); ?>
    <div class="mb-8"></div>
</main>

<?php get_footer(); ?>