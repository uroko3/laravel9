@foreach ($errors->all() as $error)
  <li>{{$error}}</li>
@endforeach
<form method="post">
	@csrf
	名前<input type="text" name="name" value="{{old('name')}}">
	<button type="submit" name="submit" value="submit" formaction="{{route('test.store')}}">登録</button>
</form>
