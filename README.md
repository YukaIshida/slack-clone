### セットアップ

- git clone
```
git clone git@github.com:YukaIshida/slack-clone.git
cd slack-clone
cp .env.example .env
```

- composerインストール
```
composer install
```

- 初回起動
```
./vendor/bin/sail up
```

- 初回以降の起動は以下でOK
```
docker-compose up -d
```

- コンテナ停止
```
docker-compose down
```

### 一般画面

```
http://127.0.0.1:40050/
```

### 管理画面

```
http://127.0.0.1:40050/admin

admin / admin
```

### laravel-baseについて

laravel baseをベースに以下を追加
- timezoneを日本時間
- ログイン機能追加
- Tailwindcss導入

※ Tailwindcssを使用する場合は以下ファイルのbootstrapを無効にし、bootstrapを使用する場合はTailwindcssを無効にする。
```
resources/sass/app.scss
```
※ .env.exampleはリポジトリごとに書き換えること