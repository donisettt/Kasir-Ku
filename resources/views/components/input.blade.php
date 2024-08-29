@props(['name'=>null,'value'=>null])
@php
$is_invalid = $errors->has($name) ? ' is-invalid':'';
@endphp
<input name="{{ $name }}" {{ $attributes->merge([
'class' => 'form-control form-control-sm'.$is_invalid
]) }} value="{{ old($name, $value) }}" />
@error($name)
<div class="invalid-feedback">
    {{ $message }}
</div>
@enderror