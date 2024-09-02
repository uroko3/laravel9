@if ($errors->any())
<div>
	<ul>
		@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif
 
<form method="post" action="{{route('user.update', $user->id)}}" class="form">
	@csrf
	お名前：<input type="text" name="name" value="{{old('name', $user->name)}}"><br>
	メール：<input type="text" name="email" value="{{old('email', $user->email)}}"><br>
	権限：<x-selectbox-input name="role" :options="['一般'=>'0','管理者'=>'1']" :default="$user->role" />
	@foreach($hobbies as $hobby)
		<li>
			<x-checkbox-input name="hobby[]" value="{{$hobby->id}}" :default="$user->hobbies->pluck('id')->toArray()" />{{$hobby->name}}
		</li>
	@endforeach
	<button type="submit">更新</button>
</form>