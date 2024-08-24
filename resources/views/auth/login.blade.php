@if ($errors->any())
<div>
	<ul>
		@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif
 
<form method="post" action="{{route('login')}}" class="form">
	@csrf
	メール：<input type="text" name="email"><br>
	パスワード：<input type="password" name="password"><br>
	<button type="submit">ログイン</button>
</form>