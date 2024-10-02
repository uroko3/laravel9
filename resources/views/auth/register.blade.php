@if ($errors->any())
<div>
	<ul>
		@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif
 
<form method="post" action="{{route('register')}}" class="form">
	@csrf
	お名前：<input type="text" name="name" value="{{old('name')}}"><br>
	メール：<input type="text" name="email" value="{{old('email')}}"><br>
	権限：<x-form.selectbox name="role" :options="['0'=>'一般','1'=>'管理者']" /><br>
	パスワード：<input type="password" name="password"><br>
	パスワード再入力：<input type="password" name="password_confirmation"><br>
	<button type="submit">Register</button>
</form>