<?php
/**
 * お問い合わせ窓口のボックス（プライバシーポリシー・完了ページ）
 * 値は TOP の「共通：会社情報」タブ（theme_company()）。電話・メールは空欄なら出さない。
 */
$company = theme_company();
?>
<div class="privacy__box privacy__contact grid grid-1 gap-y-1 py-4 px-7 p-4-sp">
    <h3 class="privacy__title text-lg">【お問い合わせ窓口】</h3>
    <p class="privacy__text">
        <?php echo esc_html($company['name']); ?><br>
        <?php echo esc_html($company['zip'] . ' ' . $company['address'] . ' ' . $company['building']); ?>
        <?php if ($company['tel']) : ?><br>電話番号：<?php echo esc_html($company['tel']); ?><?php endif; ?>
        <?php if ($company['mail']) : ?><br>メールアドレス：<?php echo esc_html($company['mail']); ?><?php endif; ?>
    </p>
</div>
