<div class="form-group">
    <div class="form-focus">
        <label for="city"
               class="control-label">{{ $title }}</label>
        <select name="{{ $name }}" id="{{ $name }}" title="{{ $title }}"
                class="form-control floating" @foreach($attributes as $attribute) {{ $attribute }} @endforeach
        >
            <option disabled selected
                    value>{{ $title  }}</option>
            @foreach($values as $value)
                <option value="{{ $value->id }}"
                        @if(old($name) === $value->id)
                        selected
                        @elseif(isset($val) && !is_null($val) && ($val === $value->id))
                        selected
                        @endif
                >{{ $value->$name }}</option>
            @endforeach
        </select>
    </div>
    @if($errors->has($name))
        <span class="text-danger">{{ $errors->first($name) }}</span>
    @endif
</div>