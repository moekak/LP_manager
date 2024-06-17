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

    ```bach
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

    ```bash
    npm run build
    ```


## ビルド
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
| created_at     | TIMESTAMP   | DEFAULT CURRENT_TIMESTAMP | LPスクリーンショット作成日時       |
| updated_at     | TIMESTAMP   | DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP | LPスクリーンショット更新日時         |



## ディレクトリ構造

プロジェクトのディレクトリ構造は以下の通りです。
 ```bash
app
├── Http            .... # HTTPリクエスト処理関連のフォルダ
│   ├── Controllers
│   └── Requests
├── Models
├── Services
dist
├── index.js
node_modules
public
├── img
├── js
├── module
├── screenshot
├── style
├── index.js
└── test.php
src
├── config
│   ├── development
│   └── production
│       └── htaccess
├── views
│   ├── common
│   │   ├── header.php
│   │   └── menu.php
│   ├── modal
│   │   ├── group_create.php
│   │   ├── group_edit.php
│   │   ├── lp_create.php
│   │   └── lp_delete.php
│   ├── index.php
│   └── screenshot.php
.htaccess
index.php
package-lock.json
package.json
README.md
webpack.config.js
```