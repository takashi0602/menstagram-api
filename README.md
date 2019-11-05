# menstagram-api

**🍜 SUSURU FOREVER, SUSURU ANYWHERE 🍜**

menstagram-apiはMenstagramのバックエンド開発のためのリポジトリです。

### 環境構築

```bash
$ git clone https://github.com/uyupun/menstagram-api.git
$ cd menstagram-api
$ make install
```

### コマンド一覧

```bash
$ make up       // 起動
$ make down     // 終了
$ make db       // DBの作り直し
$ make sh       // bashの起動
$ make dbg      // デバッガ(Telescope)の起動
$ make qual     // 品質チェックツール(PHP Insights)の起動
$ make test     // テスト(PHPUnit)の実行
$ php artisan make:usecase {name}   // ユースケースのレンプレートを生成
```