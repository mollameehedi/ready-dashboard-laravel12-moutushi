@props([
    'name',
    'label',
    'options' => null,
    'selectedValue' => null,
    'required' => false,
    'attributes' => [], // Any additional attributes for the select element
])

<div class="form-group">
    <label class="form-label" for="{{ $attributes['id'] ?? $name }}">
        {{ $label }}
        @if ($required)
            <span class="text-danger">*</span>
        @endif
    </label>
    <select
        name="{{ $name }}"
        id="{{ $attributes['id'] ?? $name }}"
        class="form-control {{ $errors->has($name) ? 'is-invalid' : '' }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes }}
    >
        @foreach ($options as $optionLabel)
            <option value="{{ $optionLabel->id }}" {{ (string) $selectedValue === (string) $optionLabel->id ? 'selected' : '' }}>
                {{ $optionLabel->name }}
            </option>
        @endforeach
    </select>
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
