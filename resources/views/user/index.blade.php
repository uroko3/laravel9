<h1>ユーザ一覧</h1>
@if (session('message'))
    <div>
        {{ session('message') }}
    </div>
@endif
@foreach($users as $user)
	<div>
		<a href="{{route('user.edit', $user->id)}}">{{$user->id}}</a>　{{$user->name}}　{{$user->email}}　{{$user->role}}
	</div>
@endforeach