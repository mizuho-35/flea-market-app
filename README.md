# flea-market-app
## 環境構築
### Dockerビルド
1. `git clone git@github.com:mizuho-35/flea-market-app.git`
2. `docker-compose up -d --build`
MacのM1・M2チップのPCの場合、`no matching manifest for linux/arm64/v8 in the manifest list entries`のメッセージが表示されビルドができない場合があります。 エラーが発生する場合は、docker-compose.ymlファイルの「mysql」内に「platform」の項目を追加して記載してください

```
mysql:
    platform: linux/x86_64(この文追加)
    image: mysql:8.0.26
    environment:
```
### Laravel環境構築
1. `docker-compose exec php bash`
2. `composer install`
3. `cp .env.example .env`　←環境変数を変更
4. .env以下の環境変数を追加
```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```
5. アプリケーションキーの作成
```
php artisan key:generate
```
6. マイグレーションファイルの実行
```
php artisan migrate
```
7. シーディングの実行
```
php artisan db:seed
```
## 使用技術（実行環境）
- PHP 8.1
- Laravel　8.83.29
- MySQL 8.0.35
- mailhog （SMTP:1025 / Web UI:8025）

## URL
- 開発環境: http://localhost/
- phpMyAdmin: http://localhost:8080/
