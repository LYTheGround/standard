<div class="form-group">
    <div class="form-focus">
        {{ Form::label($name, ucfirst($title), ['class' => 'control-label']) }}
        {{ Form::text($name, $value, ['class' => 'form-control form-floating']) }}
    </div>
    @if($errors->has($name))
        <span class="text-danger">{{ $errors->first($name) }}</span>
    @endif
 </div>