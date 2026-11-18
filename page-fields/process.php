<?php

/**
 * 手すりができるまで（固定ページ slug: process）の入力項目
 * テンプレート：page-process.php。項目名は pr_ で始める。
 */

$dummy_appeal = "営業対応や顧客交渉はなく、社内でじっくり作図に集中できます。組み立て家具の指示書を作るように、正確な図面を組み上げる没頭感があります。\n100戸規模の案件は約2週間、300戸以上の大型案件は1年以上かけてじっくり制作します。\n現在は3名体制のため、チームの負担を軽減・分散するための増員募集です。";

/** STEP 1〜5 のグループ（画像・工程名・募集職種タグ・仕事内容・やりがい） */
$step = function ($n, $title, $tag, $work_label, $work, $appeal) {
    return array('label' => 'STEP 0' . $n, 'type' => 'group', 'sub_fields' => array(
        'image'      => array('label' => '画像（840×660）', 'type' => 'image', 'instructions' => '未設定ならテーマの画像を表示します。'),
        'title'      => array('label' => '工程名', 'type' => 'text', 'default' => $title),
        'tag'        => array('label' => '募集職種タグ（任意）', 'type' => 'text', 'default' => $tag, 'instructions' => '空欄なら黒いタグを出しません。「募集職種：」は自動で付きます。'),
        'work_label' => array('label' => '仕事内容の見出し', 'type' => 'text', 'default' => $work_label),
        'work'       => array('label' => '仕事内容', 'type' => 'textarea', 'rows' => 5, 'default' => $work),
        'appeal'     => array('label' => '仕事のやりがい・魅力（任意）', 'type' => 'textarea', 'rows' => 4, 'default' => $appeal, 'instructions' => '空欄なら白いボックスを出しません。'),
    ));
};

return array(
    'title'          => '手すりができるまでの内容',
    'page_slug'      => 'process',
    'hide_on_screen' => array('the_content'),
    'fields'         => array(

        'pr_tab_mv' => array('label' => 'MV', 'type' => 'tab'),
        'pr_mv_label' => array('label' => '小ラベル', 'type' => 'text', 'default' => '社内プロジェクトフロー'),
        'pr_mv_title' => array('label' => 'ページタイトル（H1）', 'type' => 'text', 'default' => '手すりができるまで'),
        'pr_mv_lead' => array('label' => 'リード', 'type' => 'textarea', 'rows' => 2, 'default' => "1つの図面が、\n街の景観と安心になるまで。"),
        'pr_mv_image' => array('label' => '画像（1440×380）', 'type' => 'image', 'instructions' => '未設定ならテーマの画像を表示します。'),

        'pr_tab_lead' => array('label' => 'リード文', 'type' => 'tab'),
        'pr_lead' => array('label' => 'リード文', 'type' => 'textarea', 'rows' => 6, 'default' => "ビルテックが誇る最大の強みは、設計から製造・納品までをすべて自社で完結できる「完全一貫体制」です。\n大手ゼネコン様からのご依頼を受け、意匠設計部、工図部、自社工場（上泉工場）の各専門チームがバトンを繋ぎながら、1つのマンションのバルコニー手すりを形にしていきます。\n私たちが現在募集している3つの職種が、どの工程でどんな役割を担っているのか、モノづくりの流れに沿ってご紹介します。"),

        'pr_tab_flow' => array('label' => 'プロジェクトの流れ', 'type' => 'tab'),
        'pr_flow_heading' => array('label' => '見出し（改行はスマホだけで効きます）', 'type' => 'textarea', 'rows' => 2, 'default' => "プロジェクトの流れ\n（5つのステップ）"),
        'pr_step_1' => $step(1, '営業・受注', '', '工程の概要：', "長年のお取引がある大手ゼネコン（長谷工コーポレーション様等）や設計事務所からプロジェクトの打診を受けます。\n45年積み重ねた信頼と自社実績をもとに提案・協議を行い、受注が確定した段階で設計部へプロジェクトが引き継がれます。", ''),
        'pr_step_2' => $step(2, '意匠設計部', '意匠設計（リーダー候補）', 'この工程での仕事内容：', "〇クライアント（ゼネコンや設計事務所）との直接打ち合わせ・提案や意図の汲み取り\n〇建物のデザインや意図、施工性を踏まえた「意匠図面」の作成と修正チェック\n〇建築基準法や風圧荷重、強度基準を満たす設計・確認試験データの照合\n〇担当案件の優先順位やスケジュールの自己管理", $dummy_appeal),
        'pr_step_3' => $step(3, '工図部（加工製作図）', '工図（加工製作図）スペシャリスト・リーダー候補', 'この工程での仕事内容：', "〇意匠設計部が作成した図面を受け取り、自社工場で実際に製造できるよう細かく分解\n〇切断寸法や穴あけ位置、ピッチ計算、必要本数を網羅した「製作指示書（バラ図）」の作成\n〇専用システム、2D CAD（AutoCAD等）、手書きによる精密な作図とチェック", $dummy_appeal),
        'pr_step_4' => $step(4, '工場・製造・生産管理', '生産管理マネージャー（工場長候補）', 'この工程での仕事内容：', "〇千葉・上泉工場（敷地3,400坪・工場延床1,615坪の自社拠点）での製造・組み立て統括\n〇工図部から届いた「製作指示書」に基づく、アルミ部材の切断・加工・溶接・組み立て・検査指示\n〇約30名の現場製造スタッフおよび各部署（資材部・製造部・出荷部・生産管理部）の工程・進捗管理・安全衛生管理", "製造業でありながら年間休日120日以上、残業も少なく（繁忙期でも1日最大2時間程度、平常時は定時退社）、有給も取りやすい好環境です。個人の職人技に頼るモノづくりから「チームと仕組みで動く工場」へ変革していく手応えの大きいリーダーポジションです。"),
        'pr_step_5' => $step(5, '施工管理・納品完成', '', 'この工程での仕事内容：', "工場で丁寧に組み立てられた完成品を厳重に梱包し、実際の建設現場へ配送・納品します。施工管理チームや職人の手によって安全・確実にマンションのバルコニーへ設置され、住まいと空を繋ぐ「安心と美しさ」が完成します。", $dummy_appeal),

        'pr_tab_team' => array('label' => 'チームワーク', 'type' => 'tab'),
        'pr_team_heading' => array('label' => '見出し（改行はスマホだけで効きます）', 'type' => 'textarea', 'rows' => 2, 'default' => "自社一貫体制だからこその\nチームワーク"),
        'pr_team_text' => array('label' => '本文', 'type' => 'textarea', 'rows' => 6, 'default' => "多くの同業他社が設計や製造を外注に頼る中、ビルテックはすべての部署が自社内に揃っています。\nそのため、「工場で加工しやすい図面への変更」や「納期に合わせた生産ラインの調整」も、無理な外注トラブルに振り回されることなく、社内で直接スムーズに行えます。\n各部署が互いにリスペクトを持ってバトンを繋ぐチームワークがあるからこそ、高品質なモノづくりと安心して働ける環境の両立が実現しています。"),
        'pr_team_note' => array('label' => '', 'type' => 'message', 'message' => '下の写真（正方形 600×600）は横に流れて表示されます。未設定ならテーマの画像を表示します。'),
        'pr_team_image_1' => array('label' => '写真1', 'type' => 'image'),
        'pr_team_image_2' => array('label' => '写真2', 'type' => 'image'),
        'pr_team_image_3' => array('label' => '写真3', 'type' => 'image'),
        'pr_team_image_4' => array('label' => '写真4', 'type' => 'image'),
        'pr_team_image_5' => array('label' => '写真5', 'type' => 'image'),

        'pr_tab_job' => array('label' => '募集職種', 'type' => 'tab'),
        'pr_job_note' => array('label' => '', 'type' => 'message', 'message' => '職種のカードは「募集要項」の投稿から自動で表示されます（TOP と共通）。'),
        'pr_job_heading' => array('label' => '見出し（改行ごとに1行）', 'type' => 'textarea', 'rows' => 2, 'default' => "あなたはどの工程で、\nあなたの強みを活かしますか？"),
    ),
);
