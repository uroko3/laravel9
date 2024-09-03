@props([
	'name' => '',
	'value' => '',
	'default' => [],
])
@php
	$old_key = str_replace(['[', ']'], ['.', ''], preg_replace("/\[\s*\]/", '', $name));
	$old_val = $errors->any()?(array)old($old_key):(array)old($old_key, $default);
	$boolean = in_array((string)$value, array_map('strval', $old_val), true);
@endphp
<input type="checkbox" name="{{$name}}" value="{{$value}}" {!! $attributes->merge(['class' => '']) !!}{{ $boolean ? ' checked' : '' }}>