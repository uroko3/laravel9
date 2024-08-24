#デバッグバーインストール
composer require barryvdh/laravel-debugbar --dev

# テーブル作成コマンド
使用例 (テーブル名：tests)
php artisan make:migration create_tests_table

database\migrations/2024_08_18_090926_create_tests_table.php
が作成されるので編集

public function up()
{
    Schema::create('tests', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->timestamps();
    });
}

など。

編集したら、

php artisan migrate

# テーブルカラム追加コマンド
// 構文
php artisan make:migration 任意のマイグレーション名 --table=テーブル名

// 例 usersテーブルにroleカラムを追加
php artisan make:migration add_column_role_users_table --table=users

2024_08_24_071352_add_column_role_users_table.php
が作成されるので編集

//roleカラムをTINYINT型でpasswordカラムの後に追加
public function up()
{
	Schema::table('users', function (Blueprint $table) {
	  $table->tinyInteger('role')->default(0)->after('password')->comment('権限');
	});
}

// roleカラムの削除を同時に追加
public function down()
{
    Schema::table('users', function (Blueprint $table) {
      $table->dropColumn('role');
    });
}

//artisanコマンドでマイグレーションを実行
php artisan migrate


# モデル作成コマンド
使用例（モデル名Test）
php artisan make:model Test

モデル作成したら編集
fillableかguardedにカラム名を指定する。
fillableは更新可カラムを記述。
guardedは更新不可カラムを記述。

protected $fillable = [
    'name',
];

/*
protected $guarded = [
    
];
*/

# リクエスト作成コマンド
使用例（リクエスト名Test）
php artisan make:request TestRequest

リクエスト作成したら以下をtrueにする。

public function authorize()
{
    return true;
}

バリデーションルールや対応するメッセージは以下のように書く
public function rules()
{
    return [
        'name' => 'required|max:10',
    ];
}

public function messages() {
    return [
        'name.required' => 'なまえはひっす',
        'name.max' => 'なまえは10もじいないで',
    ];
}



# チェックボックスコンポーネント利用
<x-checkbox-input name="hoge[]" value="{{hoge}}" :default="$hoge_default" />チェックボックス

# ポリシー作るときのコマンド
使用例（モデル名Testに対するポリシー作成）
php artisan make:policy TestPolicy --model=Test

※作成されるポリシーファイルの各メソッドの
第一引数は、ログインしているUserモデルのインスタンス
第二引数は、Testモデルのインスタンス(更新対象のモデル）
各メソッドには、booleanをreturnするように処理を書き足す。

コントローラのアクションなどから
$this->authorize('update', $test);
と呼び出す。
$testはTestモデルのインスタンス。

# オリジナルlayoutファイルを作成する

resources/layouts/hoge.blade.php
を適当に作成。

Http/View/Components/HogeLayout.php
を以下のように作成

<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class HogeLayout extends Component
{
	public function render(): View
	{
		return view('layouts.hoge');
	}
}

このコンポーネントクラスにデフォルト値を与えたい場合は、コンストラクタをつかってメンバ変数を設定する

public $hogeMessage; // これ無いとviewに値が渡らないので注意

public function __construct($hogeMessage="デフォルトメッセージ") { // view側でこのデフォルト値を変更するには、hoge-messageと記述する
	$this->hogeMessage = $hogeMessage;
}

このレイアウトを適用するviewにて以下のようにタグを書く。

<x-hoge-layout>
</x-hoge-layout>

コンポーネントのデフォルト値（$hogeMessage）をviewで変更する場合は、
このコンポーネントを利用するviewで以下のようにする。

<x-hoge-layout hoge-message="なんとか">
や
<x-hoge-layout :hoge-message="$hoge_message">
と記述すると

コンポーネントで設定されているデフォルト値（$hogeMessage）を変更できる。

layouts/hoge.blade.php
側で上記の値を参照するには、
同ファイル内で
{{$hogeMessage}}
で参照できる。

