@props([
	'name' => '',
	'options' => [],
	'default' => [],
])
@php
	$old_key = str_replace(['[', ']'], ['.', ''], preg_replace("/\[\s*\]/", '', $name));
	$old_val = $errors->any()?(array)old($old_key):(array)old($old_key, $default);
@endphp
<select name="{{$name}}" {!! $attributes->merge(['class' => '']) !!}>
	@foreach($options as $option_value=>$option_name)
		<option value="{{$option_value}}"{{ in_array((string)$option_value, array_map('strval', $old_val), true) ? ' selected' : '' }}>{{$option_name}}</option>
	@endforeach
</select>