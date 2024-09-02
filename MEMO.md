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

# flash系（一時的なメッセージ）
コントローラでは、以下のように書ける。

//\Session::flash('message', '更新しました'); // withのかわりにこれでもいい
//$request->session()->flash('message', '更新しました'); // withのかわりにこれでもいい
        
return redirect(route('user.index'))->with('message', '更新しました');


viewでは、以下のように書く
@if (session('message'))
    <div>
        {{ session('message') }}
    </div>
@endif

# バリデーション系
viewでは、以下のように書く

@if ($errors->any())
<div>
	<ul>
		@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif

# 連関テーブル
https://readouble.com/laravel/9.x/ja/eloquent-relationships.html#many-to-many
例）リレーション
users --> hobby_user <-- hobbies

hobby_userは連関テーブル
この名前は、hobbiesとusersの単数形のアルファベット順で命名する。
このルール以外の名前をつける場合は、リレーション設定時に連関テーブル名を明示する必要がある。

テーブル構造

users
id（主キー）

hobbies
id（主キー）

hobby_user
user_id（usersの主キー）（外部キー）
hobby_id（hobbiesの主キー）（外部キー）

hobby_userにidは特にいらない。
hobby_userの主キーはuser_id,hobby_idの複合主キーにする。
各外部キーはforeign_key設定なしでもlaravel上は問題なくリレーションが機能する

usersテーブルはすでに存在する前提
php artisan make:migration create_hobbies_table
php artisan make:migration create_hobby_user table

▼hobbiesテーブル
public function up()
{
    Schema::create('hobbies', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->timestamps();
    });
}

▼hobby_userテーブル
public function up()
{
    Schema::create('hobby_user', function (Blueprint $table) {
        $table->unsignedBigInteger('user_id');
        $table->unsignedBigInteger('hobby_id');
        $table->primary(['user_id', 'hobby_id']);
    });
}

php artisan migrate

php artisan make:model Hobby

▼Hobbyモデルに以下追加
protected $fillable = [
   'name',
];

public function users()
{
	// テーブル名、カラム名のルールに則っていれば第一引数のみでよい
    return $this->belongsToMany(User::class, 'hobby_user', 'hobby_id', 'user_id');
}

▼Userモデルに以下追加
public function hobbies()
{
	// テーブル名、カラム名のルールに則っていれば第一引数のみでよい
    return $this->belongsToMany(Hobby::class, 'hobby_user', 'user_id', 'hobby_id');
}



