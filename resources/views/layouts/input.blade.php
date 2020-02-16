<div class="form-group">
    <label for="{{ $field }}">{{ Str::title(str_replace('_', ' ', $field)) }}:</label>
    @if (isset($type) && $type === 'textarea')
        <textarea class="form-control" id="{{ $field }}" name="{{ $field }}">
            {{ $item->$field ?? old($field) }}
        </textarea>
    @else
        <input type="{{ $type ?? 'text' }}" class="form-control" id="{{ $field }}" name="{{ $field }}"
               value="{{ $item->$field ?? old($field) }}">
    @endif
</div>
