
## Many_団体さんいらっしゃい

リモートワークが普及して、団体で過ごす時間は貴重になっています。せっかくの貴重な機会だからこそ、気の合う仲間を集めて、行きたい場所、やりたいことをして団体行動を最大限楽しむためのサービスです。

- スムーズな予約機能：団体客と施設（宿泊施設・体験プログラム）がスムーズにマッチングできるサービスを提供します。このサービスによって、合宿や懇親イベント、勉強会などの企画・実施を担う幹事の負担を軽減します。
- 個人よりも割安な価格：個人だと金銭的な負担が大きいサービスを団体で購入することで、一人当たりの単価を下げます
- 団体だからこそ味わえるオプション：一人だと提供してくれないサービスも団体だからこそ利用できます


## 参考にしたサイト

- https://fontawesome.com/search アイコン使用
- https://juno-engineer.com/article/laravel-fullcalendar/ カレンダー使用
- https://stackoverflow.com/questions/76898705/why-is-laravel-sail-docker-not-running-on-localhost ポートのエラー
- ジーズアカデミーのエキスパンションコースはとても参考になったが、非公開！

## デプロイ時の注意メモ　以下でもうまくいかないときはGPT活用！！
<p>１：Unable to create a directory at /home/bitnami/many/storage/app/public/images.</p>
<p>/home/bitnami/many/storage/app/public/imagesディレクトリを作成できないようです。これは、通常、ディレクトリのパーミッション設定が原因で発生します。
<h1>解決策</h1>
<p>以下コマンドを入力</p>
<p>sudo mkdir -p /home/bitnami/many/storage/app/public/images</p>
<p>sudo chown -R $USER:www-data /home/bitnami/many/storage</p>
<p>sudo chmod -R 775 /home/bitnami/many/storage</p>
<p>これもたぶん必要 php artisan storage:link</p>
<h1>2:更新したときの作業</h1>
<p>git branchで現在アクティブなブランチを確認</p>
<p>サーバーでgit pull origin ~確認したブランチ~を入力</p>
<p>cd ~/＊＊＊でディレクトリを指定することを忘れないように！</p>


