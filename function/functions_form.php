<?php
/**
 * フォーム関連のカスタム機能
 *
 * form__kana クラスが付いたフィールドはカタカナのみ許可
 */

/**
 * form__kana クラスのフィールドをカタカナのみに制限
 */
add_filter('wpcf7_validate', 'theme_validate_form_kana', 20, 2);

function theme_validate_form_kana($result, $tags)
{
    foreach ($tags as $tag) {
        $classes = $tag->get_class_option('');
        if (!$classes || strpos($classes, 'form__kana') === false) {
            continue;
        }

        $name  = $tag->name;
        $value = (string) wpcf7_superglobal_post($name);

        if ($value === '') {
            continue;
        }

        // カタカナ・長音・スペース（半角・全角）のみ許可
        if (!preg_match('/^[\x{30A0}-\x{30FF}\s]*$/u', $value)) {
            $result->invalidate($tag, 'カタカナで入力してください。');
        }
    }

    return $result;
}
