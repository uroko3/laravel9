@if ($errors->any())
<div>
	<ul>
		@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif
 
 <!-- component属性の:default=""、:options=""指定はできないエラーで動かない（空文字指定） -->
 <!-- componentのname属性に配列形式を使う場合、そのキーにドットを含めることはできない。例）data[abc.txt]など。old関数が.付きキーを処理できないため -->
 
<form method="post" action="{{route('user.update', $user->id)}}" class="form">
	@csrf
	お名前：<input type="text" name="name" value="{{old('name', $user->name)}}"><br>
	メール：<input type="text" name="email" value="{{old('email', $user->email)}}"><br>
	
	権限：<x-form.selectbox name="role" :options="['0'=>'一般','1'=>'管理者']" :default="$user->role" /><br>
	
	一般　（ラジオ）：<x-form.radio name="raido" value="0" :default="$user->role" /><br>
	管理者（ラジオ）：<x-form.radio name="raido" value="1" :default="$user->role" /><br>
	
	@foreach($hobbies as $hobby)
		<li>
			<x-form.checkbox name="hobby[/a/b/c][]" value="{{$hobby->id}}" :default="$user->hobbies->pluck('id')->toArray()" />{{$hobby->name}}
		</li>
	@endforeach
	
	<div>
		<x-form.selectbox name="hobby2[]" :options="$hobbies->pluck('name', 'id')->toArray()" :default="$user->hobbies->pluck('id')->toArray()" multiple />
	</div>
	<button type="submit">更新</button>
</form>