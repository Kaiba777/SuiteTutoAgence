@php
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
    {{-- Comme c'est un select multiple voila pourquoi il faut même les crochets --}}
    <select name="{{ $name }}[]" id="{{ $name }}" multiple>
        {{-- $k pour les id et $v pour les noms  --}}
        @foreach ($options as $k => $v) 
            <option @selected($value->contains($k)) value="{{ $k }}">{{ $v }}</option>
        @endforeach
    </select>
    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>