# チョク採テンプレート パーツ一覧

Figmaのセクションをどのパーツで組むかを決めるための一覧です。
パーツは `<block> <block>-typeX` の形で命名されています。
「見本」列のHTMLをコピーして中身を差し替えるのが基本の使い方です。行番号は 2026-11 時点のもので、ずれていたら class 名で検索してください。

CSSの置き場所：
- ページ用セクションは主に `add.css`
- ヘッダー・ナビ・FAQ・テーブル・ループ・フォーム・グラフ・数字は `base.css`
- 記事系は `article/*.css`

## 下層ページ共通

| class | 用途 | 見本 | CSS | JS |
|---|---|---|---|---|
| `under-mv under-mv-typeA pb-5` | 下層MV。全幅画像＋英字H1＋和文サブ＋パンくず | _samples/page-about.php:13-25 | add.css:46 | - |
| `under-message` | MV直下のリード文（H2 heading-4＋本文）。専用CSSなし | _samples/page-about.php:26-57 | - | - |
| `loop loop-typeA` | 横に無限ループする大きな英文。色はinline style | _samples/page-about.php:41-56 | base.css:556 | CSSのみ |
| `loop loop-typeB` | 帯状のループテキスト（フッター上の「Join Our Team」） | footer.php:1-24 | base.css:594 | CSSのみ |
| `loop loop-typeC` | 袋文字（stroke）ループ。見本なし | - | base.css:607 | CSSのみ |
| `heading-wrap heading-typeB` | セクション見出し。英字 main＋和文 sub | _samples/page-about.php:62-65 | add.css:130 | - |

## 会社・メッセージ系

| class | 用途 | 見本 | CSS | JS |
|---|---|---|---|---|
| `president-message president-message-typeA` | 代表メッセージ。左画像／右テキスト＋役職・氏名 | _samples/page-recruitment.php:307-335 | add.css:1115 | - |
| `president-message president-message-typeB` | 全幅画像の下に左キャッチ／右本文＋代表名 | _samples/page-about.php:60-99 | add.css:56 | - |
| `mvv mvv-typeB` | Mission / Vision / Value の3行リスト | _samples/page-about.php:100-183 | add.css:71 | - |
| `table table-typeB` | 会社概要・募集要項の th / td 表 | _samples/page-about.php:191-225 | add.css:226, base.css:370 | - |
| `menu menu-typeD` | 番号「( 01 )」付きの2列事業カード＋タグ | _samples/page-about.php:226-295 | add.css:234 | - |
| `history history-typeC` | 中央の軸から左右交互に並ぶ沿革タイムライン | _samples/page-about.php:296-435 | add.css:335 | - |
| `map map-typeA` | Googleマップ＋拠点名＋住所・TEL | _samples/page-about.php:436-507 | add.css:440 | - |
| `future future-typeA` | 背景画像の上に中央寄せのメッセージ | _samples/page-about.php:508-521 | add.css:533（`__text` のみ） | - |

## 仕事・人・環境系

| class | 用途 | 見本 | CSS | JS |
|---|---|---|---|---|
| `demand demand-typeB` | 3列。アイコン＋見出し＋箇条書き（求める人物像など） | _samples/page-recruitment.php:53-110 | add.css:629 | - |
| `demand demand-typeC` | 3列の枠線カード。SVGアイコン＋見出し＋本文 | _samples/page-introduction.php:54-192 | add.css:544 | - |
| `description description-typeA` | 左にタイトル／右にユニット群（研修制度など） | _samples/page-work.php:266-389 | add.css:1129 | - |
| `description description-typeB` | 左画像／右に「・見出し＋本文」のリスト | _samples/page-environment.php:362-399 | add.css:943 | - |
| `description description-typeC` | 3列の画像カード（タグ付き）。専用CSSなし | _samples/page-work.php:37-126 | - | - |
| `description description-typeD` | 番号＋見出し＋本文の縦リスト | _samples/page-recruitment.php:111-159 | add.css:1019 | - |
| `benefits benefits-typeA` | 福利厚生。4列（SPは2列）のアイコンカード | _samples/page-environment.php:37-116 | add.css:689 | - |
| `career career-typeA` | キャリアステップの縦カード＋矢印。CSSなし | article/article.html:404-466 | - | - |
| `career career-typeB` | キャリアステップ。5段階＋帯 | _samples/page-environment.php:117-175 | add.css:699 | - |
| `career career-typeC` | 社員のキャリア事例スライダー | _samples/page-environment.php:176-365 | add.css:847 | add.js `initCareerSlider()`（Splide） |
| `flow flow-typeA` | 選考フロー。横5列のステップ＋矢印（SPは縦） | _samples/page-recruitment.php:195-268 | add.css:1032 | - |
| `flow flow-typeD` | 縦リスト型のフロー（STEP＋線＋本文） | _samples/page-introduction.php:193-272 | add.css:599 | - |
| `faq faq-typeB` | details / summary のQ&Aアコーディオン | _samples/page-recruitment.php:269-306 | add.css:1099, base.css:335 | main.js `.toggle` |
| `interview interview-typeA` | 社員インタビューの3列カード（WP_Queryで出力） | _samples/page-introduction.php:342-407 | add.css:639 | - |
| `interview interview-typeE` | 関連記事カード（ACF `related_post`）。CSSなし | single.php:56-102 | - | - |
| `count__item number-typeA` | 数字で見る。アイコン＋カウントアップする数字 | _samples/page-number.php:21-102 | base.css:1315 | main.js カウントアップ |
| `number-typeB` | 数字カード群。見本なし | - | base.css:1224 | 同上 |
| `chart-typeA`〜`D` | 円グラフ／4分割円／ドーナツ／横棒。値は `--target`。見本なし | - | base.css:1160-1313 | main.js |
| `scroll scroll-typeA` / `scroll-typeB` | 画像の横／縦無限スクロール。見本なし | - | base.css:426 / 468 | CSSのみ |

## CTA・ヘッダー・フッター

| class | 用途 | 見本 | CSS | JS |
|---|---|---|---|---|
| `entry entry-typeA` | 共通CTA「Grow With Us!」＋ボタン2つ（footer.php内） | footer.php:25-66 | add.css:152 | - |
| `button button-typeE` | テキスト｜縦線｜矢印アイコンのボタン | header.php:107-119 | add.css:1, assets/base.css:253 | - |
| `button button-typeA` | 角ボタン＋アイコン | footer.php:79-91 | assets/base.css:253 | - |
| `header header-typeA fixed` | 固定ヘッダー。gnav、ボタン2つ、ハンバーガー、ドロワー | header.php:7-235 | base.css:1 | main.js |
| `footer footer-typeA` | フッター。ロゴ、ボタン、SNS、5列のgnav | footer.php:67-222 | add.css:15, base.css:310 | - |
| `header-typeB` / `footer-typeB` | 記事用のヘッダー／フッター（静的デモ） | article/article.html | - | - |

## 一覧・記事系

| class | 用途 | 見本 | CSS | JS |
|---|---|---|---|---|
| `news news-typeA` | お知らせ一覧。CSSなし | _samples/archive-news.php:21-37 | - | - |
| `pagenation pagenation-typeA` | ページ送り | archive.php:90-122 | base.css:683 | - |
| `article-mv article-mv-typeE` | インタビュー記事のMV（ACF使用） | single.php:4-37 | - | - |
| `index-container index-typeA` | 記事目次（自動生成＋スクロールスパイ） | single.php:40-42 | article/index.css:24 | main.js:91 |
| `article` | 記事本文のQ&Aブロック（ブロックパターンあり） | functions.php:181 | article/article.css | - |
| `schedule schedule-typeA` / `B` / `C` | 一日の流れ。横並び／縦タイムライン／表形式 | functions.php:187-198 のパターン | article/schedule.css | - |
| `contactForm` | CF7のフォームマークアップ | _samples/index.html | base.css:736-1158 | page-contact.php のinline JS |
| `privacy` / `thanks` / `error404` | ページ固有のレイアウト | 各テンプレート | assets/pages/*.css, 404はinline | - |

## そのほかの部品

- `toggle` と `toggle-icon-arrow` / `toggle-icon-cross`：開閉アイコン。見本は option/option.html、CSSは option/option.css
- `.tab`：タブ切り替え。JS（main.js:56）はあるが、CSSと見本はない
- `snippet/breadcrumb.php`：パンくず。`get_template_part('snippet/breadcrumb')` で呼ぶ
- `snippet/contact-address.php`：お問い合わせ窓口のボックス

## 主なBEM子要素

- **under-mv**：`__img __container __title __subtitle`
- **heading-wrap**：`heading-main heading-sub`
- **demand**：`__items __item __icon __body __title __text`
- **interview**：`__items __item __link __head __img __arrow __tag __body __title __box __name __post`
- **flow-typeA**：`__items __item __number __title __arrow`
- **faq**：`__items __item(details) __question(summary.toggle) __question-icon __question-text __answer __answer-icon`
- **button**：`__text __line __icon __icon01..04`
- **table**：`__content __item __header __data`

## ビルテック案件で追加したパーツ（2026-11）

CSS はすべて add.css 末尾の「ビルテック案件で追加したパーツ」以降。TOP だけのものは assets/pages/top.css。

| class | 用途 | 見本 | JS |
|---|---|---|---|
| `btn btn--{black,primary,white,outline,gradient} btn--{s,m,l,xl}` | 角丸なし・右端に › のボタン（`theme_chevron()`） | header.php / footer.php | - |
| `header header-typeD fixed` | 白・透過80%の固定ヘッダー。ドロップダウン（＋）とボタン2つ。文言・ロゴは page-fields/common.php、メニューは WordPress のメニュー（function/functions_menu.php） | header.php | main.js（hover）、add.js（キーボード） |
| `drawer drawer-typeD` | SPメニュー。アコーディオン（`.drawer__toggle.toggle`）＋ボタン2つ | header.php | main.js `.toggle` |
| `sp-fixed-cta` | SPで画面下に追従する2ボタン | header.php | add.js `initSpFixedCta()` |
| `heading-wrap heading-typeC` | 和文見出し＋短い線＋青のサブ。PC中央／SP左。`--white` あり | front-page.php | - |
| `entry entry-typeB` | 共通CTA（背景写真＋ボタン2つ）。上に `cityscape`。文言・背景・ボタンは page-fields/common.php | footer.php | - |
| `footer footer-typeC` | 4列ナビ＋会社情報 | footer.php | - |
| `message message-typeA` | 左画像／右 濃紺の代表メッセージ | front-page.php | - |
| `strength strength-typeA` | 中央だけ明るいループスライダー（両サイド暗く） | front-page.php | add.js `initStrengthSlider()` |
| `job job-typeA` | 募集職種の左右交互リスト（CPT job から自動） | snippet/job-list.php | - |
| `interview-card` | インタビューカード（写真＋青帯キャッチ） | snippet/interview-card.php | - |
| `interview interview-typeF` | 左パネル＋右にはみ出す自動スライダー＋「1 ── N」 | front-page.php | add.js `initInterviewSlider()` |
| `js-lines` / `js-fade` / `js-slide` | 見出しを1行ずつ／フェードアップ／横スライドで表示 | 各所 | add.js `initLines()` `initInview()` |
| `img-zoom` | ホバーで画像を拡大 | front-page.php | - |
| `opening` / `top-mv-typeA` | TOPのオープニングとMV（フェード切り替え・帯で文字が出る） | front-page.php | add.js `initTopMv()` |
| `under-mv under-mv-typeB` | 下層MV（パンくずの白帯＋写真＋中央にラベル/H1/サブ/リード。SPはリードが写真の下） | snippet/under-mv.php | - |
| `heading-typeC--black` / `--s` | heading-typeC の黒（線2px）/ 28px 版 | page-business.php / page-process.php | - |
| `media media-typeA` | 左右交互の「半分の全幅寄せ画像／テキスト（`__title` `__text`）」。`media__item--reverse` で画像が右。SPは画像→テキストの縦並び | page-business.php（強み） | - |
| `job-mv`（募集要項詳細のMV）・`heading-typeD`（左に青い縦線の見出し） | 募集要項の詳細だけで使う。CSS は assets/pages/job.css | single-job.php | - |
| `article-mv-typeE`（インタビュー詳細のMV）・一覧のカードの見た目 | CSS は assets/pages/interview.css（TOPのカードには影響しない）。目次は article の data-index を優先（main.js） | single-interview.php / archive-interview.php | main.js 目次 |

## 修正履歴

2026-11-06 に次の誤字と不具合を修正した。class を直すときは HTML と CSS を両方そろえること。

- `descriotion` → `description`（page-work.php）
- `descriptiohn__unit` → `description__unit`（page-work.php と add.css）
- `shcedule__*` → `schedule__*`、`chedule__circle` → `schedule__circle`（article.html とブロックパターン）。schedule.css にあった誤字側のセレクタは削除した
- `cateer__head` → `career__head`、`career_items` → `career__items`
- page-environment.php の壊れていた `class` 属性
- `px-2-full-sp` → `px-2-sp-full`（page-about.php）
- `.text-base` を `.text` と同じ定義で追加した（assets/base.css）
- page-about.php のヘッダーを非表示にしていた `<style>` を削除した
- career-typeC：`.career__lists-slider.splide > .splide__track > ul.splide__list > li.splide__slide` の構造にし、add.js の `initCareerSlider()` で初期化するようにした。中の年次リスト（`career__slider-track`）はグリッド表示で、スライダーにはしていない

## 未対応（実害はないが、ずれているもの）

- `pagenation`：pagination の綴り違いだが、HTMLとCSSで統一して使われているので、そのままにしている
- `scroll--typeB`：`scroll-typeB` と重複して書かれているセレクタ（base.css:468〜）。害はない
- `small-hide`：名前に反して「SPのときだけ表示」の意味
- 404.php と single-news.php は、ページ用のCSSを inline の `<style>` で持っている
