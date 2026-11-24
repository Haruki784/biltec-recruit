<?php

/**
 * 会社概要（固定ページ slug: company）の入力項目
 * デザイン：Figma xfXD7OKD6zxIIIKGHeVqiF 156:1249（PC）/ 156:1564（SP）。2026-11-20 作り直し
 * 構成：MV → リード → 数字で見るビルテック（3分類×3） → 会社概要の表 → 拠点案内・アクセス（2拠点） → 募集職種
 */

/** 数字のカード（アイコンはテーマ内 img/company/1_3_icoNN.svg） */
$num = function ($n, $title, $value, $unit, $text) {
    return array('label' => '数字' . $n, 'type' => 'group', 'sub_fields' => array(
        'title' => array('label' => '見出し（改行可）', 'type' => 'textarea', 'rows' => 2, 'default' => $title),
        'value' => array('label' => '数字', 'type' => 'text', 'default' => $value, 'instructions' => '「3,400」のようにカンマを入れるとカンマ付きで、「1972」のように入れないとカンマなしでカウントアップします。小数は 42.6 のように。'),
        'unit'  => array('label' => '単位', 'type' => 'text', 'default' => $unit),
        'text'  => array('label' => '説明（改行可）', 'type' => 'textarea', 'rows' => 3, 'default' => $text),
    ));
};

/** 会社概要の表の1行 */
$row = function ($label, $value = '') {
    return array('label' => $label === '' ? '（空き行）' : '行：' . $label, 'type' => 'group', 'sub_fields' => array(
        'label' => array('label' => '項目名', 'type' => 'text', 'default' => $label),
        'value' => array('label' => '内容', 'type' => 'textarea', 'rows' => 3, 'default' => $value),
    ));
};

/** 拠点 */
$base = function ($n, $name, $sub, $zip, $address, $tel, $fax) {
    return array('label' => '拠点' . $n, 'type' => 'group', 'sub_fields' => array(
        'name'    => array('label' => '拠点名', 'type' => 'text', 'default' => $name),
        'sub'     => array('label' => '拠点名の下（役割など）', 'type' => 'text', 'default' => $sub),
        'zip'     => array('label' => '郵便番号', 'type' => 'text', 'default' => $zip),
        'address' => array('label' => '住所', 'type' => 'text', 'default' => $address, 'instructions' => '地図（Google マップ）もこの住所で表示します。'),
        'tel'     => array('label' => 'TEL', 'type' => 'text', 'default' => $tel),
        'fax'     => array('label' => 'FAX', 'type' => 'text', 'default' => $fax),
    ));
};

/** 拠点の追加情報の1行 */
$info = function ($label, $value = '') {
    return array('label' => $label === '' ? '（空き行）' : '行：' . $label, 'type' => 'group', 'sub_fields' => array(
        'label' => array('label' => '項目名', 'type' => 'text', 'default' => $label),
        'value' => array('label' => '内容（改行可）', 'type' => 'textarea', 'rows' => 3, 'default' => $value),
    ));
};

return array(
    'title'          => '会社概要の内容',
    'page_slug'      => 'company',
    'hide_on_screen' => array('the_content'),
    'fields'         => array(

        'cp_tab_mv' => array('label' => 'MV・リード', 'type' => 'tab'),
        'cp_mv_title' => array('label' => 'ページタイトル（H1）', 'type' => 'text', 'default' => '会社概要'),
        'cp_mv_image' => array('label' => 'MV画像（1440×340）', 'type' => 'image', 'instructions' => '未設定ならテーマの画像を表示します。'),
        'cp_lead' => array('label' => 'リード', 'type' => 'textarea', 'rows' => 2, 'default' => "アルミ手摺（てすり）専門メーカーとして半世紀。\n安定した経営基盤と自社工場を誇る、ビルテックの全体像をご紹介します。"),

        'cp_tab_num' => array('label' => '数字で見るビルテック', 'type' => 'tab'),
        'cp_num_heading' => array('label' => '見出し', 'type' => 'text', 'default' => '数字で見るビルテック'),
        'cp_num_group_1' => array('label' => '分類1の見出し（数字1〜3）', 'type' => 'text', 'default' => '歴史と安定性'),
        'cp_num_1' => $num(1, "事業スタートから\n半世紀の歴史", '1972', '年', '集合住宅用アルミ手すりに特化し、50年以上にわたり技術とノウハウを蓄積。大手ゼネコンの案件を長年現場で支え続けてきた実績があります。'),
        'cp_num_2' => $num(2, "堅実で安定した\n事業基盤（年商）", '10', '億円', 'ニッチトップの専門メーカーとして、新築から大規模修繕まで継続的な需要を獲得。景気の波に左右されにくい安定経営を維持しています。'),
        'cp_num_3' => $num(3, "一次請け（直接取引）体制への\n進化", '2026', '年', '長年の信頼と施工実績を基盤に、2026年より大手ゼネコンとの一次請け（直請け）体制へ移行。強固な基盤のもとで「第2創業」を推し進めています。'),
        'cp_num_group_2' => array('label' => '分類2の見出し（数字4〜6）', 'type' => 'text', 'default' => 'スケールと技術力'),
        'cp_num_4' => $num(4, "自社拠点「上泉工場」の\n敷地面積", '3,400', '坪', '千葉市若葉区に構える広大な自社工場（延床面積1,615坪）。移転を重ねて敷地規模は当初の約3倍へと拡大しました。'),
        'cp_num_5' => $num(5, "設計から製造・施工までの\n自社一貫体制", '100', '%', '多くの同業が外部へ外注する中、意匠設計・工図・工場加工・施工管理のすべてを社内ワンフロア＆自社拠点で完結。外注トラブルに振り回されないモノづくり環境です。'),
        'cp_num_6' => $num(6, "街のランドマーク、\n大型プロジェクト実績", '300', '戸以上', '一般的なマンションから300戸規模のマンモス団地まで、街並みを彩る大規模建築を手がけています。'),
        'cp_num_group_3' => array('label' => '分類3の見出し（数字7〜9）', 'type' => 'text', 'default' => '職場環境'),
        'cp_num_7' => $num(7, '年間休日数', '120', '日以上', "土日祝を中心とした\n年間120日以上の休日をしっかり確保"),
        'cp_num_8' => $num(8, '設計部の女性比率', '50', '%以上', "建築・建材業界では珍しく、\n社内全体でも約半数の女性が活躍中"),
        'cp_num_9' => $num(9, '平均年齢', '42.6', '歳', "本社23名・工場31名、\n20代からベテランまでバランスよく在籍"),

        'cp_tab_table' => array('label' => '会社概要の表', 'type' => 'tab'),
        'cp_table_note' => array('label' => '', 'type' => 'message', 'message' => '項目名が空の行は表示しません。行は12行まで。'),
        'cp_row_1' => $row('会社名', 'ビルテック株式会社'),
        'cp_row_2' => $row('代表者', '代表取締役　大吉 弘'),
        'cp_row_3' => $row('年商（売上高）', '10億円'),
        'cp_row_4' => $row('従業員数', '54名（本社：23名 / 上泉工場：31名）※2026年時点'),
        'cp_row_5' => $row('事業内容', "集合住宅・マンション用アルミ手摺の設計、製造、施工、販売\n・新築工事向けアルミ手摺・笠木・隔て板の製造施工\n・大規模修繕工事に伴うアルミ手摺の取替・改修工法の提案施工"),
        'cp_row_6' => $row('建設業許可', '千葉県知事許可（般-7）第20686号（建具工事業・鋼構造物工事業）'),
        'cp_row_7' => $row('所属団体', '日本アルミ手摺工業会 会員'),
        'cp_row_8' => $row('決算期', '6月'),
        'cp_row_9' => $row('主要取引銀行', '千葉銀行（みつわ台支店）、日本政策金融公庫（千葉支店）、みずほ銀行（千葉支店）、りそな銀行（千葉支店）、常陽銀行（千葉支店）'),
        'cp_row_10' => $row(''),
        'cp_row_11' => $row(''),
        'cp_row_12' => $row(''),

        'cp_tab_access' => array('label' => '拠点案内・アクセス', 'type' => 'tab'),
        'cp_access_heading' => array('label' => '見出し', 'type' => 'text', 'default' => '拠点案内・アクセス'),
        'cp_base_1' => $base(1, '本社オフィス:勤務地', '（設計・営業・施工管理・バックオフィス）', '〒260-0028', '千葉県千葉市中央区新町18-10 千葉第一生命ビルディング2F', '043-302-5050', '043-302-5080'),
        'cp_base_1_info_1' => $info('主な機能', '意匠設計部、工図部、営業部、工事部、総務・経理'),
        'cp_base_1_info_2' => $info('最寄り駅', '各線「千葉駅」徒歩約5分 / 京成線「京成千葉駅」徒歩約3分'),
        'cp_base_1_info_3' => $info('オフィス環境', 'ワンフロアで各部署の顔が見渡せ、他部署とも直接相談・連携が取りやすい執務環境です。'),
        'cp_base_1_info_4' => $info(''),
        'cp_base_2' => $base(2, '上泉工場', '（資材調達・製造加工・出荷配送）', '〒265-0045', '千葉県千葉市若葉区上泉町424-15', '043-239-8020', '043-239-8090'),
        'cp_base_2_info_1' => $info('敷地・規模', "敷地面積（全体）：11,220㎡（約3,400坪）延床面積（工場）：5,329.5㎡（約1,615坪）\n延床面積（事務所）：303.6㎡（約92坪）"),
        'cp_base_2_info_2' => $info('主な機能', '資材部、製造部、出荷部、生産管理部'),
        'cp_base_2_info_3' => $info('工場設備・特徴', '自社敷地内でアルミ型材の切断・穿孔・組立を一貫して担当。各種公的機関の基準をクリアする強度試験をクリアした、高品質な手すりを日々出荷しています。'),
        'cp_base_2_info_4' => $info(''),

        'cp_tab_recruit' => array('label' => '募集職種', 'type' => 'tab'),
        'cp_recruit_heading' => array('label' => '見出し（改行可）', 'type' => 'textarea', 'rows' => 2, 'default' => "あなたはどの工程で、\nあなたの強みを活かしますか？"),
        'cp_recruit_note' => array('label' => '', 'type' => 'message', 'message' => '職種のカードは「募集要項」の投稿から自動で表示されます。'),
    ),
);
