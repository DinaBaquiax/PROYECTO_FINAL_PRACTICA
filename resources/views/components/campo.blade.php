@props(['name', 'label', 'type' => 'text', 'value' => null, 'opciones' => null, 'ancho' => 'col-md-6'])
<div class="{{ $ancho }}">
    <label class="form-label">{{ $label }}</label>
    @if ($opciones)
        <select name="{{ $name }}" @class(['form-select', 'is-invalid' => $errors->has($name)])>
            @foreach ($opciones as $o)
                <option @selected(old($name, $value) == $o)>{{ $o }}</option>
            @endforeach
        </select>
    @else
        <input type="{{ $type }}" name="{{ $name }}" value="{{ old($name, $value) }}" step="any"
               @class(['form-control', 'is-invalid' => $errors->has($name)])>
    @endif
</div>