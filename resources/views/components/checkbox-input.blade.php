@props([
	'name' => '',
	'value' => '',
	'default' => [],
])
@php
if(empty($errors->all())) {
	$old = (array)old(str_replace(['[', ']'], ['.', ''], preg_replace("/\[\s*\]/", '', $name)), $default);
}
else {
	$old = (array)old(str_replace(['[', ']'], ['.', ''], preg_replace("/\[\s*\]/", '', $name)));
}
@endphp
<input type="checkbox" name="{{$name}}" value="{{$value}}" {!! $attributes->merge(['class' => '']) !!}{{ in_array((string)$value, array_map('strval', $old), true) ? ' checked' : '' }}>