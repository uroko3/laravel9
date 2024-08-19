@props([
	'name' => '',
	'options' => [],
	'default' => [],
])

<select name="{{$name}}" {!! $attributes->merge(['class' => '']) !!}>
	@foreach($options as $option_name=>$value)
		<option value=""{{ in_array((string)$value, array_map('strval', (array)old(str_replace(['[',']'],['.',''],preg_replace("/\[\s*\]/", '', $name)), $default)), true) ? ' selected' : '' }}>{{$option_name}}</option>
	@endforeach
</select>