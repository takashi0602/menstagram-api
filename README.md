# menstagram-api

**🍜 SUSURU FOREVER, SUSURU ANYWHERE 🍜**

menstagram-apiはMenstagramのバックエンド開発のためのリポジトリです。

### 環境構築（macOS）

```bash
$ git clone https://github.com/uyupun/menstagram-api.git
$ cd menstagram-api
$ make init
```

### 環境構築（Windows）

```bash
$ git clone https://github.com/uyupun/menstagram-api.git
$ cd menstagram-api
$ make -f Makefile.win init
```

### コマンド（macOS）

```bash
$ make up       // 起動
$ make down     // 終了
$ make db       // DBの作り直し
$ make sh       // bashの起動
$ make dbg      // デバッガ(Telescope)の起動
$ make qual     // 品質チェックツール(PHP Insights)の起動
$ make test     // テスト(PHPUnit)の実行
```

### コマンド（Windows）

```bash
$ make -f Makefile.win up       // 起動
$ make -f Makefile.win down     // 終了
$ make -f Makefile.win db       // DBの作り直し
$ make -f Makefile.win sh       // bashの起動
$ make -f Makefile.win dbg      // デバッガ(Telescope)の起動
$ make -f Makefile.win qual     // 品質チェックツール(PHP Insights)の起動
$ make -f Makefile.win test     // テスト(PHPUnit)の実行
```

### コマンド（共通）

```bash
$ php artisan make:usecase {name}   // ユースケースのレンプレートを生成
```