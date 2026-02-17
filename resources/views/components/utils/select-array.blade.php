@props([
    'name',
    'label',
    'options' => [], // Array of options: ['value' => 'Label']
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
    <option value="">
        Select {{ $label }}
    </option>
        @foreach ($options as $value => $optionLabel)
            <option value="{{ $value }}" {{ (string) $selectedValue === (string) $value ? 'selected' : '' }}>
                {{ $optionLabel }}
            </option>
        @endforeach
    </select>
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
