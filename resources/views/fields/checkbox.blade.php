<div>
    <x-moonshine::form.input
        type="hidden"
        name="{{ $element->name() }}"
        :attributes="$element->attributes()->only(['x-bind:name'])"
        value="{{ $element->getOffValue() }}"
    />

    <x-moonshine::form.input
        :attributes="$element->attributes()->merge([
                'id' => $element->id(),
                'name' => $element->name(),
                'value' => $element->getOnValue(),
                'checked' => $element->isChecked()
            ])"
        @class(['form-invalid' => $errors->has($element->name())])
        x-bind:checked="{{ $element->attributes()->get('x-model-field') ? $element->attributes()->get('x-model-field') . '==`'.$element->getOnValue().'`' : '$el.checked' }}"
        x-on:change="$el.checked ? $el.value = '{{ $element->getOnValue() }}' : $el.value = '{{ $element->getOffValue() }}'"
    />
</div>
