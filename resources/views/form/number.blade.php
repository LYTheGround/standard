<div class="form-group">
    <div class="form-focus">
        {{ Form::label($name, ucfirst($title), ['class' => 'control-label']) }}
        {{ Form::number($name, $value, array_merge(['class' => 'form-control form-floating'], $attributes)) }}
    </div>
    @if($errors->has($name))
        <span class="text-danger">{{ $errors->first($name) }}</span>
    @endif
</div>