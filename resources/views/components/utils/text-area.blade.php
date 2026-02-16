@props([
    'name',
    'label',
    'value' => null,
    'required' => false,
    'attributes' => [],
    'rows' => 3, // Default number of rows for the textarea
])

<div class="form-group">
    <label class="form-label" for="{{ $attributes['id'] ?? $name }}">
        {{ $label }}
        @if ($required)
            <span class="text-danger">*</span>
        @endif
    </label>
    <br/>
    <textarea
        name="{{ $name }}"
        id="{{ $attributes['id'] ?? $name }}"
        rows="{{ $rows }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'form-control ' . ($errors->has($name) ? 'is-invalid' : '')]) }}
    >{{ $value }}</textarea>
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
