# スロットゲーム  
このスロットゲームはデータベースとphpを使用しています。具体的な機能は以下のようになっております。　　
* なりすましを防ぐために初回プレイ時にユーザー登録を行っている。
* ユーザー登録はメール認証を採用している。
* 訪問時にはユーザーログイン機能を備えている。  
ゲームの仕組みは以下のようになっています。
* 挑戦者の所持金は1000円からスタートする。
* 「スロットを回す！」ボタンを押すと100円を失い、1~9のランダムの数字が3つ表示される。　　
* 3つの数字が同じであった場合でのみ、所持金が500円増える。
* ここまでで1ラウンドとし、「スロットを回す！」ボタンを押して次のラウンドに進む。
* 以上を繰り返し、所持金が0円になったらゲームは終了である。
* 終了時には時間と最終ラウンドがデータベースに記録され、ゲームページに掲示される。

