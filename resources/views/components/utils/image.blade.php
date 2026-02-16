@props([
    'name',
    'label',
    'required' => false,
    'attributes' => [],
    'value' => null,
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
        type="file"
        name="{{ $name }}"
        id="{{ $attributes['id'] ?? $name }}"
        class="form-control {{ $errors->has($name) ? 'is-invalid' : '' }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes }}
    >
    @if ($value)
        <div class="mt-2">
            <img src="{{ asset($value) }}" alt="Current Image" style="max-width: 150px; height: 150px; object-fit:cover">
        </div>
    @endif
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
