@props([
    'name',
    'label',
    'type' => 'text',
    'value' => null,
    'required' => false,
    'disabled' => false,
    'attributes' => [],
])

<div class="form-group">
    <label class="form-label" for="{{ $attributes['id'] ?? $name }}">
        {{ $label }}
        @if ($required)
            <span class="text-danger">*</span>
        @endif
    </label>
    <br/>
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $attributes['id'] ?? $name }}"
        value="{{ $value }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'form-control ' . ($errors->has($name) ? 'is-invalid' : '')]) }}
        {{ $disabled? 'disabled':''  }}
    >
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
