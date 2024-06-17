# LP一覧システム

## 概要
スプレッドシートに代わってLP一覧を管理できるシステムです。

## 前提条件
以下のソフトウェアがインストールされている必要があります。

- PHP >= 7.4
- Composer
- Node.js (推奨バージョン)
- npm (Node.jsに含まれています)


## インストール方法
1. リポジトリをクローンします。
    ```bash
    git clone git@github.com:If-you-give-up-then-it-all-ends-here/LPManager.git
    ```

2. ディレクトリに移動します。

    ```bash
    cd LPManager
    ```

3. ComposerでPHPの依存関係をインストールします。

    ```bash
    composer install
    ```

4. npmでJavaScriptの依存関係をインストールします。

    ```bash
    npm install
    ```

## ビルド方法
プロジェクトをビルドするには、以下のコマンドを実行します。

1. 開発環境

    ```bash
    npm run build
    ```

2. 本番環境

    ```bash
    npm run build:prod
    ```



## データベース構造

データベースの構造について説明します。

### テーブル一覧

- groups
- lp_sites
- lp_screenshots

### groups テーブル

| カラム名        | データ型    | 制約                     | 説明                   |
| -------------- | ----------- | ------------------------ | ---------------------- |
| id             | INT         | PRIMARY KEY, AUTO_INCREMENT | グループの一意なID       |
| title          | VARCHAR(20)| NOT NULL, UNIQUE          | グループのタイトル       |
| created_at     | TIMESTAMP   | DEFAULT CURRENT_TIMESTAMP | ポスト作成日時         |
| updated_at     | TIMESTAMP   | DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP | グループ更新日時         |

### lp_sites テーブル

| カラム名         | データ型    | 制約                     | 説明                   |
| -------------- | ----------- | ------------------------ | ---------------------- |
| id             | INT         | PRIMARY KEY, AUTO_INCREMENT | LPの一意なID     |
| group_id        | INT         | FOREIGN KEY (groups.id)   | LPに紐ずくグループID |
| title        | VARCHAR(20)       | NOT NULL                 | LP名称        |
| domain        | VARCHAR(256)       | NOT NULL                 | ドメイン名        |
| content        | VARCHAR(256)       |              | 備考        |
| created_at     | TIMESTAMP   | DEFAULT CURRENT_TIMESTAMP | コメント作成日時       |
| updated_at     | TIMESTAMP   | DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP | LP更新日時         |

### lp_screenshots テーブル

| カラム名          | データ型    | 制約                     | 説明                   |
| -------------- | ----------- | ------------------------ | ---------------------- |
| id             | INT         | PRIMARY KEY, AUTO_INCREMENT | LPスクリーンショット の一意なID     |
| lp_id        | INT         | FOREIGN KEY (lp_sites.id)   | LPスクリーンショットに紐ずくLPID |
| group_id        | INT         | FOREIGN KEY (groups.id)   | LPスクリーンショットに紐ずくグループID |
| screenshot        | VARCHAR(256)       | NOT NULL                 | スクリーンショット        |
| created_at     | TIMESTAMP   | DEFAULT CURRENT_TIMESTAMP | LPスクリーンショット作成日時       |
| updated_at     | TIMESTAMP   | DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP | LPスクリーンショット更新日時         |



## ディレクトリ構造

プロジェクトのディレクトリ構造は以下の通りです。
 ```bash
app
├── Http                        .... HTTPリクエスト処理関連のフォルダ
│   ├── Controllers             .... コントローラーを格納し、リクエストを処理
│   └── Requests                .... リクエストバリデーション関連のファイル
├── Models　　　　　             .... データベースモデルを格納
├── Services                    .... ビジネスロジックを実装するサービスクラスを格納
dist
├── index.js                    .... ビルドされたJavaScriptファイル
node_modules                    .... npmでインストールされた依存パッケージ
public
├── img                         .... 画像ファイルを格納
├── js                          .... JavaScriptファイルを格納
├── module                      .... モジュール関連のファイルを格納
├── screenshot                  .... スクリーンショットを格納
├── style                       .... CSSスタイルシートを格納
├── index.js                    .... メインのJavaScriptファイル
└── test.php                    .... テスト用のPHPファイル
src
├── config                      .... 設定ファイルを格納
│   ├── development             .... 開発環境用の設定ファイル
│       └── htaccess            .... 開発環境用のApache設定ファイル
│   └── production　            .... 本番環境用の設定ファイル
│       └── htaccess            .... 本番環境用のApache設定ファイル
│   └── conf.php　              .... システム設定ファイル
├── views                       .... ビュー（テンプレート）ファイルを格納
│   ├── common                  .... 共通テンプレートを格納
│   │   ├── header.php          .... ヘッダーのテンプレート
│   │   └── menu.php            .... 左メニューのテンプレート
│   ├── modal                   .... モーダル関連のテンプレート
│   │   ├── group_create.php    .... グループ作成モーダル
│   │   ├── group_edit.php      .... グループ編集モーダル
│   │   ├── lp_create.php       .... LP作成モーダル
│   │   └── lp_delete.php       .... LP削除モーダル
│   ├── index.php               .... メインのインデックスビュー
│   └── screenshot.php          .... スクリーンショットビュー
.htaccess                       .... Apache設定ファイル
index.php                       .... アプリケーションのエントリーポイント
package-lock.json               .... npmの依存関係を固定
package.json                    .... npmのプロジェクト設定と依存関係
README.md                       .... プロジェクトの説明
webpack.config.js               .... Webpackの設定ファイル
