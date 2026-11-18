<?php

/**
 * 募集職種一覧（/job/、archive-job.php）の入力項目
 * アーカイブには編集画面がないので、TOP（固定ページ top）の編集画面にタブで出す。theme_option('項目名') で取り出す。
 */

return array(
    'title'     => '共通：募集職種一覧（/job/）',
    'page_slug' => 'top',
    'menu_order' => 20,
    'fields'    => array(
        'job_archive_title'    => array('label' => 'MVの見出し（H1）', 'type' => 'text', 'default' => '募集職種一覧'),
        'job_archive_image'    => array('label' => 'MV画像（未設定ならテーマの画像）', 'type' => 'image'),
    ),
);
