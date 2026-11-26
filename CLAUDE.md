# チョク採テンプレート（採用サイト用WordPressテーマ）

このフォルダはテーマ本体です（`wp-content/themes/<テーマ名>/` に置く想定）。
各案件はこのテーマをコピーして始め、TOP（`front-page.php`）と固定ページ（`page-<slug>.php`）を Figma をもとに組みます。

- パーツ一覧：[docs/parts-catalog.md](docs/parts-catalog.md)。ページを組む前に必ず読む
- 案件制作の手順：`.claude/skills/chokusai-coding/SKILL.md`（「チョク採で〇〇ページを作って」で起動）

## 基本方針

1. **既存パーツを優先する。** Figma のセクションはまずパーツ一覧から近い `block-typeX` を選び、見本のHTMLをコピーして中身を差し替える。
2. **色・フォント・余白はトークンで変える。** 案件ごとの違いは基本的に `assets/settings.css` の `:root` 変数（`--primary` `--secondary` `--tertiary` `--text-color`、フォント、`--heading01`〜、`--spacing-*`、`--border-radius` など）を書き換えて吸収する。パーツのCSSを案件ごとに書き換えない。
3. **新しいパーツは命名規約どおりに作る。** 合うパーツがないときだけ、既存ブロックの新しいtype（例：`flow-typeE`）か新しいブロックを作る。CSSは `add.css` の末尾に `/* <block>-typeX */` という見出しコメントを付けて追加し、[docs/parts-catalog.md](docs/parts-catalog.md) にも1行追記する。
4. **ユーティリティを先に使う。** 余白・グリッド・文字サイズはまずユーティリティclassで組み、パーツ固有のCSSはレイアウトの「型」に限る。

## ファイルの役割

| ファイル | 役割 | 案件で触るか |
|---|---|---|
| `assets/settings.css` | デザイントークン（フォント、文字サイズ、余白、色、幅） | **触る**（案件の色・フォント） |
| `assets/settings-full.css` | vw でスケールする `-full` 用のトークン | 原則触らない |
| `assets/base.css` / `assets/base-full.css` | ユーティリティ（grid / flex / 余白 / 文字 / button） | 触らない |
| `base.css` | header・nav・faq・table・loop・form・chart・number | 必要なときだけ |
| `add.css` | ページ用セクションパーツ | 新しいパーツを追加 |
| `article/*.css` | 記事本文・スケジュール・目次 | 必要なときだけ |
| `assets/pages/<slug>.css` | そのページだけのスタイル。`head.php` の `$page_css` に「名前 => 条件」を1行足して読み込む | 必要なときだけ |
| `assets/device.css` | PC / SP の出し分け | 触らない |
| `assets/main.js` | jQuery。ドロワー、gnav、`.toggle`、タブ、目次、グラフ、カウントアップ | 必要なときだけ |
| `add.js` | 案件で追加するJS（Splideなど）。`initXxx()` 単位で書く。career-typeC のスライダーもここにある | 追加する |
| `header.php` / `footer.php` | 共通ヘッダー・フッター。footer に loop-typeB → entry-typeA → footer-typeA を含む | 案件のナビ・リンクを反映 |
| `head.php` | meta、OGP、CSSの読み込み順 | CSSを足すとき |
| `functions.php` / `function/*.php` | テーマ設定、news投稿タイプ、ブロックパターン、フォーム | 必要なときだけ |
| `snippet/*.php` | パンくず、お問い合わせ窓口 | - |
| `front-page.php` | TOP。今はヘッダーとフッターだけで空 | **作る** |
| `page-<slug>.php` | 固定ページ。スラッグと一致させる | **作る／差し替える** |

CSSの読み込み順（head.php）：destyle → splide → settings → settings-full → assets/base → base-full → base.css → article/* → style.css → add.css → option.css → assets/pages/* → device.css

## 単位・ブレークポイント

- `html` の font-size は `clamp(7px, 0.694vw, 10px)`。**1rem = 10px**（1440px基準、それより大きくはならない）。SPは `clamp(8px, 2.667vw, 10px)` で、375px で 10px になる。Figma の px をそのまま rem÷10 で書く（24px → 2.4rem）。
- ブレークポイントは **768px**（`max-width: 768px` が SP）。補助として 991px（`show-md-only` / `hide-md-only`）。
- 出し分け用class：`show-pc`（PCのみ表示）、`small-hide`（**SPのみ表示**。名前と逆なので注意）。改行の出し分けは `<br class="show-pc">` など。

## ユーティリティ（assets/base.css）

- **レイアウト**：`grid grid-1`〜`grid-10`、`flex flex-1`〜`flex-10`（子要素は `col`）、`grid-reverse` / `flex-reverse`
- **間隔**：`gap-0`〜`gap-9` / `gap-x-*` / `gap-y-*`
- **余白**：`m p mt mb ml mr mx my pt pb pl pr px py` に `-0`〜`-9` を付ける。値は .8 / 1.2 / 1.6 / 2.4 / 3.2 / 4 / 5.6 / 8 / 12rem で、4以上はSPで自動的に小さくなる。`mx-auto` もある
- **文字**：`heading-1`〜`heading-4`、`text-lg`、`text`、`caption`、`bold`、`semibold`、`en`（英字フォント）
- **背景**：`background-primary` / `-secondary` / `-tertiary`
- **ボタン**：`button button-typeX`。色の指定は `button-custom`、`button-primary` など
- **`-sp` 接尾辞**：SP（768px以下）のときだけ効く。例：`grid-1-sp`、`flex-1-sp`、`mb-5-sp`、`heading-2-sp`
- **`-full` 接尾辞**：上限なしで vw に比例する（1440px で 10px 相当）。例：`heading-1-full`、`gap-y-1-full`、`px-8-full`。SPで別の値にしたいときは `-sp-full` を使う（例：`py-5-sp-full`）。画面幅に合わせて拡大したいMVなどで使う
- **幅**：`container`（最大124rem、左右に2rem / SPは1.5remの余白）、`full-container`（95%）

## ページテンプレートの型

```php
<?php get_header(); ?>
<main class="grid grid-1 gap-y-8">               <!-- セクション間は 8rem（SPは6rem） -->
    <div class="grid grid-1 gap-y-9">
        <section class="under-mv under-mv-typeA pb-5"> … <?php get_template_part('snippet/breadcrumb'); ?></section>
        <section class="under-message"> … </section>   <!-- 任意 -->
    </div>
    <section class="demand demand-typeB">
        <div class="container">
            <h2 class="heading-wrap heading-typeB mb-5 gap-y-2">
                <span class="heading-main heading-2 en">ABOUT US</span>
                <small class="heading-sub text-lg">私たちについて</small>
            </h2>
            <ul class="demand__items flex flex-3 flex-1-sp"> <li class="demand__item col">…</li> </ul>
        </div>
    </section>
    <div> <!-- 背景色付きのセクションを隙間なく続けるときは、まとめて div で囲む -->
        <section class="… background-primary py-8">…</section>
        <section class="… py-8">…</section>
    </div>
</main>
<?php get_footer(); ?>   <!-- loop-typeB / entry-typeA / footer-typeA は自動で出る -->
```

- TOP（front-page.php）では under-mv を使わず、TOP用のMVを置く。パンくずは TOP では自動的に出ない。
- 画像は `<picture><source srcset="…_sp.webp" media="(max-width: 768px)"><img src="…" alt="…" width height loading="lazy"></picture>`。パスは `<?php echo get_stylesheet_directory_uri(); ?>/img/<page>/xxx.webp`。FV以外は `loading="lazy"` を付ける。
- テーマ内のリンクは `<?php echo esc_url(home_url('/recruitment/')); ?>` の形で書く（`href=""` を残さない）。
- インタビュー一覧は WP_Query で出す（見本：_samples/page-introduction.php:342-407）。投稿のアーカイブURLは `/interview/`、お知らせは `/news/`（カスタム投稿 `news`）。
- 固定ページでは wpautop が無効。固定ページはテンプレート（PHP）側で組み、エディタ本文に頼らない。
- `style=""` の直書きは、ループの色指定などの最小限にとどめる。ページ固有のスタイルは `assets/pages/<slug>.css` に書く。
- PHPでの出力は `esc_html` / `esc_url` / `esc_attr` でエスケープする。

## 入力項目（ACF 無料版）

- 項目は `page-fields/<名前>.php` に配列で書く（1ファイル＝1フィールドグループ）。`function/functions_page_fields.php` が ACF に登録し、同時に「項目名→初期値」の一覧を作る。
- テンプレートでは `theme_field('項目名')`（投稿・ページの項目）、`theme_option('項目名')`（TOP の「共通：〜」タブ）で取り出す。未入力なら初期値が返る。**文言はテンプレートに直書きせず `default` に書く。**
- 画像項目は `theme_image($id, 'top/xxx.webp', array('width'=>…, 'height'=>…))`。未設定ならテーマ内の画像を出す。
- 無料版なのでリピーターは使わない。繰り返しは固定数の group（例：`iv_section_1`〜`8`）か、1行1項目のテキストエリアにする。
- 項目名はテーマ全体で重ならないようにする（初期値の一覧を共有するため）。
- **ヘッダー・フッターも管理画面で編集できるようにする。** ロゴ、ロゴ横の文字、ボタン、流れる英文、CTA（文言・背景・ボタン）、フォームURL、会社情報は `page-fields/common.php`（TOP の編集画面で「TOPページの内容」のタブの後ろに「共通：〜」タブとして並ぶ。`'append_to' => 'top'`）に書き、`header.php` / `footer.php` に文言や画像パスを直書きしない。
  - **メニューだけは WordPress 標準のメニュー**（外観 → カスタマイズ → メニュー）で編集する。仕組みは `function/functions_menu.php`。位置は `global`（ヘッダー・SPメニュー・フッターの列）と `footer`（フッター右の太字リンク）。案件ごとに変えるのは `theme_menu_defaults()`（初期値）だけ。テーマ有効化時、または管理画面を最初に開いたとき（1回だけ）に、割り当てのない位置へ初期値からメニューを作る
  - global は2階層まで。子のない1段目はそのままリンク（HOME など、フッターには出ない）。子のある1段目は見出しで、URL を `#` 以外にすると子の先頭に一覧リンク（表示名はタイトル属性、空なら「見出し＋一覧」）。子に URL `#job` のカスタムリンクを置くと投稿タイプ job の投稿を並び順どおりに展開（表示名は投稿の `nav_label` 項目、なければタイトル）
  - 自動作成では、固定ページは「固定ページ」、投稿タイプの一覧は「投稿タイプのアーカイブ」、それ以外はサイト内パスのカスタムリンクとして登録する（`theme_menu_item_args()`）
  - 今いるページ：リンクに `aria-current="page"`（`theme_current_attr()`）、親の `li` に `.is-current`（判定は `theme_nav_is_current()`）。見た目は `add.css` 末尾
  - 関数：`theme_nav()` / `theme_menu('footer')`（メニュー）、`theme_button('項目名', 空のときのURL)`（text / small / url）、`theme_link()`（パス→URL）、`theme_image_url($id, 'img/からのパス')`（画像URL。未設定ならテーマの画像）
- 会社情報は `theme_company()`、応募ボタンの飛び先は `theme_entry_url()`、チョク採フォームの iframe の src は `theme_form_src()`。
- 文字の出力は `theme_text($value)`（エスケープ＋改行を br）、テーマ内の CSS/JS の URL は `theme_asset()`（更新日時を ?ver= に付けてキャッシュ対策）、画像は `theme_img()`。

## 並行作業（別セッション）のルール

- 1セッション＝1ページ。そのページのファイル（`page-<slug>.php`、`assets/pages/<slug>.css`、`page-fields/<slug>.php`、`img/<slug>/`）だけを触る。
- 共通ファイル（`add.css`、`header.php`、`footer.php`、`functions.php`、`function/*`、`assets/settings.css`）を変えたいときは、自分では変えずに必要な変更をまとめて報告する（親のセッションでまとめて入れる）。
- ページ用の CSS は `assets/pages/<slug>.css` に書き、`head.php` の `$page_css` に `'<slug>' => is_page('<slug>'),` を1行だけ足す。
- 案件の進め方・確認事項は `_design/coding-guide.md`、進捗は `_design/sitemap.md`。

## やらないこと

- `assets/base.css` / `base-full.css` のユーティリティを案件のために書き換えない
- 既存パーツのCSSを、別の見た目にするために上書きしない（新しいtypeを作る）
- Figma MCP の一時的なアセットURLや placehold.jp を納品コードに残さない
- `.claude/`・`docs/`・`_design/`・`_samples/`・`_tools/`・`page-capture/`・`*.md` を本番サーバーにアップしない。使っていない見本テンプレートは `_samples/` にある
  - 本番用のテーマは `_tools/make-theme-zip.ps1` で ZIP にする（コミット済みの内容から作り、上のものは `.gitattributes` の `export-ignore` で外れる）。出力は `_dist/`。外すものを増やすときは `.gitattributes` に足す

## 既知の不具合・修正履歴

[docs/parts-catalog.md](docs/parts-catalog.md) の末尾に修正履歴と未対応の項目をまとめている。class の誤字を直すときは HTML と CSS を両方そろえる。
