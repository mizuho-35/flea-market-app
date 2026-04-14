# flea-market-app
## 環境構築
### Dockerビルド
1. `git clone git@github.com:mizuho-35/flea-market-app.git`
2. `cd flea-market-app` ←クローンしたフォルダに移動
3. `docker-compose up -d --build`
- MacのM1・M2チップのPCの場合、`no matching manifest for linux/arm64/v8 in the manifest list entries`のメッセージが表示されビルドができない場合があります。 エラーが発生する場合は、docker-compose.ymlファイルの「mysql」内に「platform」の項目を追加して記載してください

```
mysql:
    platform: linux/x86_64(この文追加)
    image: mysql:8.0.26
    environment:
```
- Windows/WSL2環境で、MySQLのコンテナが起動しない場合は以下を実行してください。
1. Docker Desktop を完全に終了
2. `cd ~/coachtech/flea-market-app`←flea-market-app のディレクトリに移動
3. `rm -rf docker/mysql/data`←docker/mysql/dataの中身を削除

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

MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="test@example.com"
MAIL_FROM_NAME="${APP_NAME}"
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
8. 画像をstorageに保存する設定
```
php artisan storage:link
```
## 使用技術（実行環境）
- PHP 8.1
- Laravel　8.83.29
- MySQL 8.0.35
- mailhog （SMTP:1025 / Web UI:8025）

## ER図
<details>
<summary>ER図</summary>
    <img width="820" height="1020" alt="index drawio" src="https://github.com/user-attachments/assets/a11ec417-0068-4562-92e9-5ec6831c0d9c" />
</details>

## URL
- 開発環境: http://localhost/
- phpMyAdmin: http://localhost:8080/
---
## テストケース
以下のユーザーを作成し、テストを実行した。(テスト環境：windows11)
- ユーザー名：テスト
- メールアドレス：test@test.com
- 郵便番号：000-0000
- 住所：住所
- 建物名：建物

### 会員登録画面
<details>
<summary>会員登録画面にアクセス</summary>
    <img width="1920" height="1080" alt="スクリーンショット (39)" src="https://github.com/user-attachments/assets/2fb6e44d-7ccc-47f0-bc3a-f390d3227eb5" />
</details>
<details>
<summary>名前が入力されていない場合</summary>
    <img width="1920" height="1080" alt="スクリーンショット (41)" src="https://github.com/user-attachments/assets/33db4f61-5a35-431d-b142-fa1d38f147f2" />
</details>
<details>
<summary>メールアドレスが入力されていない場合</summary>
    <img width="1920" height="1080" alt="スクリーンショット (42)" src="https://github.com/user-attachments/assets/9ae27681-e936-4770-b01f-003527520703" />
</details>
<details>
<summary>パスワードが入力されていない場合</summary>
    <img width="1920" height="1080" alt="スクリーンショット (91)" src="https://github.com/user-attachments/assets/c6e5beb5-dc43-44ae-a50a-8985ae4206ee" />
</details>
<details>
<summary>パスワードが7文字以下の場合</summary>
    <img width="1920" height="1080" alt="スクリーンショット (43)" src="https://github.com/user-attachments/assets/aab462c0-56d7-4771-909a-54e75c3891f0" />
</details>
<details>
<summary>パスワードが確認パスワードと一致しない場合</summary>
    <img width="1920" height="1080" alt="スクリーンショット (44)" src="https://github.com/user-attachments/assets/69df48da-4bad-4bce-b948-0c39c10f58ff" />
</details>

### メール認証画面
<details>
<summary>メール認証画面</summary>
    <img width="1920" height="1080" alt="スクリーンショット (45)" src="https://github.com/user-attachments/assets/40f2e6d3-1454-4196-a6de-ce0cd530c2ef" />
</details>

### プロフィール設定画面
<details>
<summary>メール認証後、プロフィール設定画面を表示</summary>
    <img width="1920" height="1080" alt="スクリーンショット (48)" src="https://github.com/user-attachments/assets/40d0e368-b124-4082-a16f-88a5615e6a1b" />
</details>

### ログイン画面
<details>
<summary>ログイン画面にアクセス</summary>
    <img width="1920" height="1080" alt="スクリーンショット (56)" src="https://github.com/user-attachments/assets/6601e72c-c861-455e-9192-b74c50d6d54b" />
</details>
<details>
<summary>メールアドレスが入力されていない場合</summary>
    <img width="1920" height="1080" alt="スクリーンショット (58)" src="https://github.com/user-attachments/assets/649b0860-a22e-448f-b7da-b4e1922af9d6" />
</details>
<details>
<summary>パスワードが入力されていない場合</summary>
    <img width="1920" height="1080" alt="スクリーンショット (60)" src="https://github.com/user-attachments/assets/670c4aea-5502-47a1-b5c1-2bb90442c4e4" />
</details>
<details>
<summary>入力情報が間違っている場合</summary>
    <img width="1920" height="1080" alt="スクリーンショット (61)" src="https://github.com/user-attachments/assets/17fe7ad3-ccb0-4752-9ec3-43188965636d" />
</details>

### 商品一覧画面
<details>
<summary>商品一覧画面にアクセス</summary>
    <img width="1920" height="1080" alt="スクリーンショット (54)" src="https://github.com/user-attachments/assets/78ba4578-2f4c-4875-b422-2d5e36f4f40c" />
    <img width="1920" height="1080" alt="スクリーンショット (55)" src="https://github.com/user-attachments/assets/888d8da8-aed0-43f5-aed3-cab8b8657681" />
</details>
<details>
<summary>SOLD表示</summary>
    <img width="1920" height="1080" alt="スクリーンショット (76)" src="https://github.com/user-attachments/assets/9c625e15-2526-4940-b0c1-f2faa6a1eac0" />
</details>
<details>
<summary>マイリスト表示</summary>
    <img width="1920" height="1080" alt="スクリーンショット (67)" src="https://github.com/user-attachments/assets/a6f24b79-e98b-412a-8b69-ed18fa8c2670" />
</details>

### 商品検索機能
<details>
<summary>おすすめで検索結果を表示</summary>
    <img width="1920" height="1080" alt="スクリーンショット (82)" src="https://github.com/user-attachments/assets/a13b8b6d-968a-4b73-afcc-1d7b7afbd4a5" />
</details>
<details>
<summary>マイリストで検索結果を表示</summary>
    <img width="1920" height="1080" alt="スクリーンショット (93)" src="https://github.com/user-attachments/assets/d34f57e8-e173-47d0-8b12-4290202c59ed" />
</details>

### 商品詳細画面
<details>
<summary>商品詳細を表示</summary>
    <img width="1920" height="1080" alt="スクリーンショット (89)" src="https://github.com/user-attachments/assets/eeb2ea16-e093-405a-8f22-2fe2a56db582" />
    <img width="1920" height="1080" alt="スクリーンショット (90)" src="https://github.com/user-attachments/assets/71695adb-fcdd-40ed-96b9-d56c220bec63" />
</details>
<details>
<summary>売り切れ(購入不可)の商品詳細を表示</summary>
    <img width="1920" height="1080" alt="スクリーンショット (86)" src="https://github.com/user-attachments/assets/0232469e-0983-4ae7-9305-9c47c168dcca" />
    <img width="1920" height="1080" alt="スクリーンショット (87)" src="https://github.com/user-attachments/assets/1f04c421-e1c6-42db-8a87-b9fd96768aac" />
</details>
<details>
<summary>いいね表示</summary>
    <img width="1920" height="1080" alt="スクリーンショット (64)" src="https://github.com/user-attachments/assets/efc71e73-3a01-41e7-984e-6541cee11c61" />
</details>

### コメント機能
<details>
<summary>コメント表示</summary>
    <img width="1920" height="1080" alt="スクリーンショット (66)" src="https://github.com/user-attachments/assets/3c13f960-2457-44d7-bdcb-22d922af421a" />
</details>
<details>
<summary>コメントを入力せず、送信ボタンを押した場合</summary>
    <img width="1920" height="1080" alt="スクリーンショット (80)" src="https://github.com/user-attachments/assets/063784ae-96f9-4041-bb18-f4c6ebbe5715" />
</details>
<details>
<summary>コメントが255文字以上の場合</summary>
    <img width="1920" height="1080" alt="スクリーンショット (94)" src="https://github.com/user-attachments/assets/825be511-d349-46d8-9c61-cbb8b767657f" />
</details>

### 商品購入画面
<details>
<summary>商品購入画面を表示</summary>
    <img width="1920" height="1080" alt="スクリーンショット (72)" src="https://github.com/user-attachments/assets/b9fe31a0-9746-40a7-8f3c-29828817889e" />
</details>
<details>
<summary>支払方法プルダウン・選択後の表示</summary>
    <img width="1920" height="1080" alt="スクリーンショット (95)" src="https://github.com/user-attachments/assets/ab83fc89-3ba2-49c0-b2b2-f71e084fcfb0" />
    <img width="1920" height="1080" alt="スクリーンショット (96)" src="https://github.com/user-attachments/assets/6c566a8d-5441-41d4-a76d-ef4cddb97e60" />
</details>

### 配送先住所変更ページ
<details>
<summary>変更するボタンを押して変更ページにアクセス</summary>
    <img width="1920" height="1080" alt="スクリーンショット (75)" src="https://github.com/user-attachments/assets/7622742c-7640-4478-8fe2-13fe524497da" />
</details>

### 商品出品画面
<details>
<summary>出品ボタンを押して商品出品ページにアクセス</summary>
    <img width="1920" height="1080" alt="スクリーンショット (68)" src="https://github.com/user-attachments/assets/3eb966bd-4f2e-42e7-91aa-3acb8d6e993a" />
    <img width="1920" height="1080" alt="スクリーンショット (69)" src="https://github.com/user-attachments/assets/859389f9-ee53-4572-8cd9-11946800a446" />
</details>
<details>
<summary>何も入力せず出品するボタンを押した場合</summary>
    <img width="1920" height="1080" alt="スクリーンショット (83)" src="https://github.com/user-attachments/assets/839baa4f-719f-4b53-917a-54db04fd525c" />
    <img width="1920" height="1080" alt="スクリーンショット (84)" src="https://github.com/user-attachments/assets/3d805a81-a8ac-4b4b-b47c-ec96a6e50a71" />
</details>

### マイページ
<details>
<summary>マイページを表示</summary>
    <img width="1920" height="1080" alt="スクリーンショット (85)" src="https://github.com/user-attachments/assets/09ebdd2a-7e5c-45be-8440-e7120f2b7339" />
</details>
<details>
<summary>購入した商品を表示</summary>
    <img width="1920" height="1080" alt="スクリーンショット (77)" src="https://github.com/user-attachments/assets/e34d1a59-ced4-4ace-a908-34241b5db389" />
</details>


