@props(['field', 'text', 'table'])

<div>
    <x-input-label for="{{ $field }}" :value="{{ '__(\''. $text .'\')' }}" />
    <x-text-input id="{{ $field }}" name="{{ $field }}" type="text" class="mt-1 block w-full" :value="old('{{ $field }}', {{ $table.'->'.$field }})" required :autofocus="$errors->isEmpty()" autocomplete="{{ $field }}" />
    <x-input-error class="mt-2" :messages="$errors->get('{{ $field }}')" />
</div>