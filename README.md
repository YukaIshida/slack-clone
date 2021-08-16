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