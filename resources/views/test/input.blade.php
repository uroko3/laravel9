@foreach ($errors->all() as $error)
  <li>{{$error}}</li>
@endforeach
<form method="post">
	@csrf
	名前<input type="text" name="name" value="{{old('name')}}"><br>
	<x-radio-input name="radio" value="1" :default="2" />Yes
	<x-radio-input name="radio" value="2" :default="2" />No
	<x-radio-input name="radio" value="3" :default="2" />both
	<button type="submit" name="submit" value="submit" formaction="{{route('test.store')}}">登録</button>
</form>
