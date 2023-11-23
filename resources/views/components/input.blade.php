@php

    // On met text si on a pas de type
    $type ??= 'text';

    // On met null si on a pas de class
    $class ??= null;

    // On met rien si on a pas de name
    $name ??= '';

    // On met rien si on a pas de valeur
    $value ??= '';

    // On met la valeur contenu dans le name si on a pas de label
    $label ??= ucfirst($name);

@endphp

<div @class(["form-group", $class])>
    <label for="{{ $name }}">{{ $label }}</label>
    @if ($type == 'textarea')
        <textarea class="form-control @error($name) is-invalid @enderror" type="{{ $type }}" id="{{ $name }}" name="{{ $name }}">{{ old($name, $value) }}</textarea>
    @else
        <input class="form-control @error($name) is-invalid @enderror" type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" value="{{ old($name, $value) }}">
    @endif
    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>