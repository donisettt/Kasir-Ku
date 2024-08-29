@props(['name'=>null,'value'=>null,'dataOption'=>[]])
@php
$is_invalid = $errors->has($name) ? ' is-invalid':'';
$default = old($name, $value);
@endphp
<select name="{{ $name }}" {{ $attributes->merge([
 'class' => 'form-control form-control-sm'.$is_invalid
])}}>
    @foreach ( $dataOption as $row)
    @if ($default == $row['value'])
    <option value="{{ $row['value'] }}" selected>{{ $row['option'] }}</option>
    @else
    <option value="{{ $row['value'] }}">{{ $row['option'] }}</option>
    @endif
    @endforeach
</select>
@error($name)
<div class="invalid-feedback">
    {{ $message }}
</div>
@enderror