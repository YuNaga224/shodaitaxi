# 商大タクシー
## URL
[商大タクシー](https://shodaitaxi.space)
## どんなサービスか？
### 概要
小樽商科大学の学生向けのタクシー相乗り募集サービスです。駅から大学まで一緒にタクシーに乗るメンバーを簡単に見つけることができます！

### なぜ作ったのか？
小樽商科大学には、見ず知らずの学生同士がタクシーに一緒に乗って大学へ向かうというタクシー相乗り文化がありました。（参考記事:https://www.chukei-news.co.jp/news/2019/05/20/OK0001905200f01_05/ ）しかしコロナ禍で授業が完全オンラインとなったことで、この文化は途絶え、対面授業になった現在も多くの学生がタクシーではなく満員のバスで登校するようになってしまいました。このタクシー相乗り文化という伝統を私達の代で絶やしたくないという思いから「商大タクシー」の開発に着手しました。

### 使い方
#### メールアドレス無しで簡単にユーザー登録・ログインできます。
![ezgif com-gif-maker](https://user-images.githubusercontent.com/115802057/206840436-9ef6c993-2dd2-4b98-bb3d-52575f0b4149.png)
#### ホーム画面では募集中のグループが一覧表示されます。日付とJRを選択してグループを検索することもできます。
![ezgif com-gif-maker (1)](https://user-images.githubusercontent.com/115802057/206840490-00f5107b-8bc4-41c2-aaf0-8bf033c116ef.png)
#### メンバーが集まるとチャット画面に推移します。
![ezgif com-gif-maker (2)](https://user-images.githubusercontent.com/115802057/206840537-055fc72b-70f0-4439-a6c3-a452693ff8b7.png)
#### Ajaxによりロード無しでチャットのやり取りができます。ここで集合場所を決めましょう！
![ezgif com-gif-maker](https://user-images.githubusercontent.com/115802057/206840257-fad0e4e9-f3ae-4ad5-bd43-205d087993f0.gif)

## 使用技術
- PHP
- MySQL
- JavaScript
- HTML/CSS
- Ajax
- Apache
- AWS
  - VPC
  - EC2
  - RDS
  - Route53  

長期的な視点で考えたときにエンジニアとして成長していくためにもっとも重要なのは基礎の仕組みを理解することだと考え、Laravel等のフレームワークは使用せず、素のPHPを使ってMVCアーキテクチャに基づいて開発を行いました。
## データベース設計
### usersテーブル
|Column|Type|Options|
|-----|----|---------|
|id|varchar(20)|primary key|
|pwd|varchar(60)|not null|
|nickname|varchar(8)|notnull|
|relate_carpool|varchar(20)|not null, default 'none'|
|user_num|int(1)|not null default '0'|
### carpoolテーブル
|Column|Type|Options|
|-----|----|---------|
|id|int(10)|primary key, auto_increment|
|rep_id|varchar(20)|not null|
|user_1|varchar(8)| not null, default =""|
|user_2|varchar(8)| not null, default =""|
|user_3|varchar(8)| not null, default =""|
|user_4|varchar(8)| not null, default =""|
|selected_date|varchar(50)|not null|
|selected_jr|varchar(50)|not null|
### chatテーブル
|Column|Type|Options|
|-----|----|---------|
|id|int(10)|primary key, auto_increment|
|carpool_id|int(10)|not null|
|nickname|varchar(8)|not null|
|body|varchar(50)|not null|
## 機能一覧
- ユーザー登録・ログイン機能
- グループ機能
  - グループ作成機能
  - グループ検索機能
- チャット機能（Ajax）