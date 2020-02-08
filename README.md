# menstagram-api

<img src="logo.png" width="500">

**🍜 SUSURU FOREVER, SUSURU ANYWHERE 🍜**  
menstagram-apiはMenstagramのWeb API開発のためのリポジトリです。

### 環境構築（macOS）
現状, macOSでの環境のみdocker-syncを使用しているため, 他のプラットフォームと比べて若干環境構築が異なる.

```bash
$ git clone https://github.com/uyupun/menstagram-api.git
$ cd menstagram-api
$ docker network create menstagram  // menstagram-aiですでに作成している場合は実行しなくて良い
$ cp docker-compose-mac.yml docker-compose.yml
$ cp Makefile.mac Makefile
$ make init
```

### 環境構築（Windows/Linux）

```bash
$ git clone https://github.com/uyupun/menstagram-api.git
$ cd menstagram-api
$ docker network create menstagram  // menstagram-aiですでに作成している場合は実行しなくて良い
$ cp docker-compose-other.yml docker-compose.yml
$ cp Makefile.other Makefile
$ make init
```

### コマンド

```bash
$ make up       // 起動(localhost:8000)
$ make down     // 終了
$ make db       // DBの作り直し
$ make sh       // Bashの起動
$ make dbg      // デバッガ(Telescope)の起動
$ make qual     // 品質チェックツール(PHP Insights)の起動
$ make test     // テスト(PHPUnit)の実行
$ make tunnel   // localhost.runで公開
$ php artisan make:usecase {name}   // ユースケースのレンプレートを生成
```