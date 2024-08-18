@foreach ($errors->all() as $error)
  <li>{{$error}}</li>
@endforeach
<form method="post">
	@csrf
	名前<input type="text" name="name" value="{{old('name', $test->name)}}">
	<button type="submit" name="submit" value="submit" formaction="{{route('test.update', $test->id)}}">登録</button>
</form>
