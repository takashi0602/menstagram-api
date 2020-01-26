# menstagram-api

**🍜 SUSURU FOREVER, SUSURU ANYWHERE 🍜**

menstagram-apiはMenstagramのバックエンド開発のためのリポジトリです。

### 環境構築（macOS）
現状, macOSでの環境のみdocker-syncによる高速化の恩恵を受けることができる.

```bash
$ git clone https://github.com/uyupun/menstagram-api.git
$ cd menstagram-api
$ docker network create menstagram  // menstagram-aiですでに作成している場合は実行しなくて良い
$ make init
```

### 環境構築（Windows/Linux）

```bash
$ git clone https://github.com/uyupun/menstagram-api.git
$ cd menstagram-api
$ docker network create menstagram  // menstagram-aiですでに作成している場合は実行しなくて良い
$ make -f Makefile.gen init
```

### コマンド（macOS）

```bash
$ make up       // 起動(localhost:8000)
$ make down     // 終了
$ make db       // DBの作り直し
$ make sh       // Bashの起動
$ make dbg      // デバッガ(Telescope)の起動
$ make qual     // 品質チェックツール(PHP Insights)の起動
$ make test     // テスト(PHPUnit)の実行
```

### コマンド（Windows/Linux）

```bash
$ make -f Makefile.gen up       // 起動(localhost:8000)
$ make -f Makefile.gen down     // 終了
$ make -f Makefile.gen db       // DBの作り直し
$ make -f Makefile.gen sh       // Bashの起動
$ make -f Makefile.gen dbg      // デバッガ(Telescope)の起動
$ make -f Makefile.gen qual     // 品質チェックツール(PHP Insights)の起動
$ make -f Makefile.gen test     // テスト(PHPUnit)の実行
```

### コマンド（共通）

```bash
$ php artisan make:usecase {name}   // ユースケースのレンプレートを生成
```