<form method="post">
	@csrf
	<button type="submit" formaction="{{route('logout')}}">ログアウト</button>
</form>
<div>
	<a href="{{route('user.index')}}">ユーザ一覧</a>
</div>