# バックエンド/AWS研修のデモアプリ開発

##  目次

1. [1-インストール](#1-インストール)
2. [2-使用方法](#2-使用方法)
3. [3-コマンド一覧](#3-コマンド一覧)
4. [4-ディレクトリ構成](#4-ディレクトリ構成)
5. [5-課題概要](#5-課題概要)

<br>

### 1-インストール
1. リポジトリをクローンします
```bash
https://github.com/happyriku/partone_traning_program
```

<br>

### 2-使用方法
1. DockerDesktpoを立ち上げる (OSがLinux以外の場合)

2. buildを行う
```bash
docker-compose build
```
3. dockerコンテナをバックグラウンドで立ち上げる
```bash
docker-compose up -d
```

<br>

### 3-コマンド一覧

|コマンド|実行する処理|
|:--|:--|
|docker-compose build|docker-compose.ymlで定義したイメージをbuildする|
|docker-compose up -d|dockerコンテナをバックグラウンドで立ち上げる|
|docker-compose down|起動したコンテナを停止して削除する|
|docker exec -it (コンテナ名) bash|bashシェルを起動して(コンテナ名)と接続する|
|mysql -h (ホスト名) -P (ポート番号) -u (ユーザ名) -p (パスワード)|mysqlと接続する|

<br>

### 4-ディレクトリ構成

```
├── README.md
├── SampleProject
│   ├── README.md
│   ├── app
│   ├── artisan
│   ├── bootstrap
│   ├── composer.json
│   ├── composer.lock
│   ├── config
│   ├── database
│   ├── package.json
│   ├── phpunit.xml
│   ├── postcss.config.js
│   ├── public
│   ├── resources
│   ├── routes
│   ├── storage
│   ├── tailwind.config.js
│   ├── tests
│   ├── vendor
│   └── vite.config.js
├── doc
│   ├── 00_mail_auth_api.md
│   ├── 01_mail_auth_code_send_api.md
│   ├── 02_individual_membership_registration_api.md
│   ├── 03_password_change_api.md
│   ├── 04_password_reset_api.md
│   ├── 05_login_api.md
│   ├── 06_membership_info_api.md
│   ├── README.md
│   └── partone研修課題DB設計 テーブル定義書.xlsx
├── docker
│   └── server
├── docker-compose.yml
└── エンジニア育成プログラム.docx
```

<br>

### 5-課題概要

[エンジニア育成プログラム](https://github.com/happyriku/partone_traning_program/blob/main/%E3%82%A8%E3%83%B3%E3%82%B7%E3%82%99%E3%83%8B%E3%82%A2%E8%82%B2%E6%88%90%E3%83%95%E3%82%9A%E3%83%AD%E3%82%AF%E3%82%99%E3%83%A9%E3%83%A0.docx)

```txt
上記のエンジニア育成プログラムファイルに書かれていたUzoneの会員登録・マイページ系APIの作成に取り組みました。
```

- API設計書とデータベース設計書はdocディレクトリの中に格納しました。また，		SampleProjectは，laravelプロジェクトです。

- データベーステーブルの数に指定がなかったので会員情報を保持するテーブルと，メール認証の際に一時的にメールアドレス情報を保持するテーブルの2つ作成しました。

- データベースの動作確認では，コマンドラインからmysqlに接続して確認するやり方を取りました。

- APIの動作確認では，Postmanを使用しました。

<br>
