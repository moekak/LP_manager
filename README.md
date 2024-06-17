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
