<?php

/**
 * 教育・キャリアパス（固定ページ slug: career）の編集項目。デザイン待ちのため、今は MV と「作成中」の文だけ
 */
return [
    ['tab', 'MV'],
    ['cr_mv_label', '小ラベル', 'text', ''],
    ['cr_mv_title', '見出し（H1）', 'text', '教育・キャリアパス'],
    ['cr_mv_image', '画像（PC 1440×380）', 'image', 'job/3_0_main.webp'],
    ['cr_mv_image_sp', '画像（SP）', 'image', 'job/3_0_main_sp.webp', 'PC だけ選んだときは、SP でも PC の画像を出します。'],
    ['tab', '本文'],
    ['cr_notice', '作成中のお知らせ', 'textarea', '※現在作成中です※', 'ページができるまで表示する文です。'],
];
