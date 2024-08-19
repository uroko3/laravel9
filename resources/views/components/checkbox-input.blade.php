@props([
	'name' => '',
	'value' => '',
	'default' => [],
])
<input type="checkbox" name="{{$name}}" value="{{$value}}" {!! $attributes->merge(['class' => '']) !!}{{ in_array((string)$value, array_map('strval', (array)old(str_replace(['[',']'], ['.',''], preg_replace("/\[\s*\]/", '', $name)), $default)), true) ? ' checked' : '' }}>