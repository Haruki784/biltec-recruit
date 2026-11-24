# 本番アップ用のテーマ ZIP を作る
#
# 使い方（テーマのフォルダで）：
#   powershell -ExecutionPolicy Bypass -File _tools/make-theme-zip.ps1
#
# - コミット済みの内容（HEAD）から作る（git archive）。コミットしていない変更は入らないので、
#   未コミットの変更があるときは止まる（-Force を付けると、そのまま HEAD で作る）
# - 制作用のファイル（CLAUDE.md・docs/・_design/・_samples/・page-capture/・.claude/ など）は
#   .gitattributes の export-ignore で外れる。外すものを増やすときは .gitattributes に足す
# - ZIP の中はテーマのフォルダ名（このフォルダの名前）で始まるので、
#   管理画面の「外観 → テーマ → 新規追加 → テーマのアップロード」でそのまま上げられる
#   （同じ名前のテーマがあると「アップロードしたもので置き換える」を選べる）
# - 出力先：_dist/<テーマ名>-<日付>-<時刻>.zip（_dist/ は git に入れない）

param(
    [switch]$Force
)

$ErrorActionPreference = 'Stop'
$themeDir = Split-Path -Parent $PSScriptRoot
Set-Location $themeDir
$themeName = Split-Path -Leaf $themeDir

# コミットしていない変更があれば止める
$dirty = git status --porcelain
if ($dirty -and -not $Force) {
    Write-Host 'コミットしていない変更があります。ZIP には入らないので、先にコミットしてください。' -ForegroundColor Yellow
    Write-Host '（このまま HEAD の内容で作るなら -Force を付けて実行）'
    $dirty | ForEach-Object { Write-Host "  $_" }
    exit 1
}

$stamp = Get-Date -Format 'yyyyMMdd-HHmm'
$outDir = Join-Path $themeDir '_dist'
New-Item -ItemType Directory -Force $outDir | Out-Null
$zip = Join-Path $outDir "$themeName-$stamp.zip"

git archive --format=zip --prefix="$themeName/" -o "$zip" HEAD
if ($LASTEXITCODE -ne 0) { throw 'git archive に失敗しました' }

# 念のため、制作用のファイルが入っていないか確認する
Add-Type -AssemblyName System.IO.Compression.FileSystem
$entries = [System.IO.Compression.ZipFile]::OpenRead($zip)
try {
    $names = $entries.Entries | ForEach-Object { $_.FullName }
} finally {
    $entries.Dispose()
}
$leak = $names | Where-Object { $_ -match '\.md$|/\.claude/|/docs/|/_design/|/_samples/|/_tools/|/page-capture/|\.docx$|/\.git' }
if ($leak) {
    Write-Host '制作用のファイルが入っています。.gitattributes の export-ignore を確認してください：' -ForegroundColor Red
    $leak | ForEach-Object { Write-Host "  $_" }
    exit 1
}

$size = [math]::Round((Get-Item $zip).Length / 1MB, 1)
Write-Host "作成しました：$zip（$size MB、$($names.Count) 件）" -ForegroundColor Green
