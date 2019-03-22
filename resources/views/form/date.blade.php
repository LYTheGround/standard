<div class="form-group">
    <div class="form-focus">
        {{ Form::label($name, $title, ['class' => 'control-label']) }}
        <div class="cal-icon">
            {{ Form::date($name, $value, array_merge(['class' => 'form-control form-floating'], $attributes)) }}
        </div>
    </div>
    @if($errors->has($name))
        <span class="text-danger">{{ $errors->first($name) }}</span>
    @endif
</div>