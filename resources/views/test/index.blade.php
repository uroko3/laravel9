<a href="{{route('test.input')}}">作成</a>
<div>
@foreach($tests as $test)
	<div>
		<a href="{{route('test.edit', $test->id)}}">{{$test->id}}</a>　{{$test->name}}
	</div>
@endforeach
</div>