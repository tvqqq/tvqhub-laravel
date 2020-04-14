<div>
    <input type="text" class="form-control" name="{{ $key }}" value="{{ isset($value[$key]) ? $value[$key] : old($key) }}">
</div>
