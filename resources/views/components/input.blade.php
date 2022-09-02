@props(['disabled' => false, 'name', 'value' => ''])

@php
	$class = 'form-control';
	if ($errors->has($name)) {
		$class .= ' is-invalid';
	}
@endphp

<input name="{{ $name }}" {{ $disabled ? 'disabled' : ''}} {!! $attributes->merge(['class' => $class]) !!}
 	   value="{{ old($name, $value) }}" />