
# フロントエンド自動化開発環境

Gulp, Webpack, Sass などによるフロントエンド開発・ビルドと、
画像・JS・CSS最適化自動化のためのテンプレートです。


## 🟢 Node.jsについて

このプロジェクトのセットアップには**Node.js（推奨: v18系）**が必要です（本リポジトリはVolta用設定あり）。

### Node.js のインストール状況確認

ターミナルまたはコマンドプロンプトで下記を実行します。

```
node -v
```
例:
```
v18.20.2
```

バージョン番号が表示されればすでにインストール済みです **（推奨: v18系）**

### 未インストールの場合

公式サイトからインストールできます。

- [Node.js 公式サイト](https://nodejs.org/ja/)

Node.js はバージョン管理ツールを利用すると、
プロジェクトごとに異なるNode.jsバージョンを使い分けできるので便利です。

- [nodebrew 公式サイト](https://formulae.brew.sh/formula/nodebrew)
- [Volta 公式サイト](https://volta.sh)
- [nvm](https://github.com/nvm-sh/nvm)


## 📁 主なディレクトリ・ファイル構成

- `src/`, `scss/`, `js/`, `images/`, `dist/`, など（config.jsonに合わせて適宜セットアップ）
- `config.json` : 各種入出力パス管理

## 🛠️ セットアップ手順

1. 依存パッケージをインストール
   ```sh
   npm install
   ```

2. `config.json` のパスなどを用途に合わせて編集
   例（パスはサンプル、必要に応じて変更）:
   ```json
   {
     "paths": {
        "pages": {
          "src": "./src/pages",
          "target": "./src/pages/**/*.{html,php}",
          "dist": "/"
        },
        "include": {
          "src": "./src/include",
          "target": "./src/include/**/*.{html,php,inc}",
          "dist": "/include"
        },
       "styles": {
         "src": "./src/scss",
         "target": "./scss/**/*.scss",
         "dist": "/assets/css/"
       },
       "js": {
         "src": "./src/js/",
         "target": "./js/**/*.js",
         "dist": "/assets/js/"
       },
       "image": {
         "src": "./src/img",
         "target": "./src/img/**",
         "dist": "/assets/img/"
       },
      "copy": {
        "src": "./src/!(pages|include|js|img)",
        "target": "./src/!(pages|include|js|img)/**/*",
        "dist": "/assets/"
      }
     },
    "replace": [
      { "from": "url('https://www.example.com/assets/", "to": "url('/assets/" },
      { "from": "href=\"https://www.example.com/assets/", "to": "href=\"/assets/" },
      { "from": "src=\"https://www.example.com/assets/", "to": "src=\"/assets/" }
    ]
   }
   ```


## 🚩 主なnpmスクリプト

| コマンド              | 機能概要                                   |
|----------------------|--------------------------------------------|
| `npm run dev`        | Gulpタスク全体をデフォルトで実行（ファイル監視・自動リロード付） |
| `npm run build`      | 本番用ビルド（~~minify等も有効~~・distを初期化後ビルド） Windows用            |
| `npm run build2`      | build の Mac Linux 版           |
| `npm run fix`        | stylelintによるscss/css自動修正             |
| `npm run server`     | PHPローカルサーバー起動（`localhost:8000`） |



## 🚀 開発の手順

-  `npm run dev` を実行します。

  ```
  npm run dev
  ```


- 別のターミナルでPHPローカルサーバー起動します。
  ```
  npm run server
  // devディレクトリが存在しない場合にはエラーになります
  ```

- 自動でローカルサーバー（`localhost:3000`）が起動します。
  ページに変更を加えると、ブラウザがオートリロードされリアルタイムに反映されます。

- 画像（例: `src/img/` ディレクトリに保存した画像）は自動でWebP形式にも変換され、同時に出力されます。

- ページ制作が完了したら、下記コマンドで本番用データを `dist` ディレクトリに出力します。

  ```
  npm run build
  ```

  これにより、~~minify済み~~CSS・JSや最適化画像など本番運用に適した成果物が生成されます。

### `npm run build`で実行される主なタスク

1. **スタイルシート（styles, minify）**
    - Sass/SCSS ファイル（`src/scss/`）を CSS にコンパイルし、ベンダープレフィックスを自動付与します。
    - ~~さらに本番用は minify（圧縮）し、`.min.css` を出力します。~~ <br>→ 現環境に則して、minify無しにしています

2. **JavaScript ファイル（copyJs）**
    - `src/js/` 以下の JS ファイルをビルド（またはコピー）し、出力ディレクトリへ配置します。

3. **HTMLファイルのコピー＆置換（copyPages, replaceAll）**
    - `src/pages/` 以下の HTML/PHPファイルを出力ディレクトリにコピーします。
    - PHPファイルはhtmlに拡張子を変更します
    - その上で、置換ルール（`config.json`で指定したキーワード等）の適用処理を行います。

4. **画像の最適化とWebP変換（image, webpImage）**
    - 画像ファイル（`src/img/`）を最適化・圧縮し、さらにWebP形式にも変換して出力します。
    - webpファイルを個別で手配する必要はありません。

5. **その他ファイルのコピー（copyOther）**
    - コンパイル対象外の`src/`内ディレクトリ（`pages`, `js`, `img`以外）をそのまま出力ディレクトリ（dist）にコピーします。


### 🚩 Tips
- `npm run fix` を実行すると、stylelintによってscss/cssのプロパティの並び順を整頓できます。コミット前に実行するのがオススメです。

## 使用主要パッケージ

### 開発用
- Gulp, Webpack, 各種Gulpプラグイン群
- Stylelint, style-loader, css-loader, browser-sync など

### 本番/開発共通
- CSS、モダンUI/JS用パッケージ等は導入していません

## 主なgulpタスク（gulpfile.js内で自動選択されます）

- **styles** : Sass→CSSビルド、オートプレフィックス、minify付き出力
- **copyPages** : src/pages ディレクトリのhtml/phpファイルをコピーする
- ~~**js** : Webpack経由でJSバンドル圧縮~~ ※現状のJSだと非対応の為、下記のcopyJsを採用しています。
- **copyJs** : src/js ディレクトリのJSファイルをコピーする
- **image** : 画像（png/jpg/svg/gif）最適化保存
- **webpImage** : 画像WebP自動生成
- **browserSync** : ファイル監視 & ブラウザリロード
- **replaceAll** : 生成後のhtmlファイルから、文字列を置換します。（正規表現は現在非対応です）
  - 本番では相対パスを利用したい時などに活用してください
- 各タスクは個別にも`gulp styles`, `gulp js`, `gulp image` 等で実行可能なものがあります。（動作テストの名残です）

## その他

- **Node.jsバージョン管理**
  voltaにて指定（推奨 Node 18.20.2）。適宜Node.jsのバージョンを合わせてください。
- **パッケージ管理**
  依存はすべて`package.json`で管理。新規追加時は`npm install パッケージ名 --save`または`--save-dev`。

---