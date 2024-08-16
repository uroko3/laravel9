# チェックボックスコンポーネント利用
<x-checkbox-input name="hoge[]" value="{{hoge}}" :default="$hoge_default" />チェックボックス

# ポリシー作るときのコマンド
php artisan make:policy HogePolicy --model=Hoge

※作成されるポリシーファイルの各メソッドの
第一引数は、ログインしているUserモデルのインスタンス
第二引数は、Hogeモデルのインスタンス(更新対象のモデル）
各メソッドには、booleanをreturnするように処理を書き足す。

コントローラのアクションなどから
$this->authorize('update', $m_hoge);
と呼び出す。

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

