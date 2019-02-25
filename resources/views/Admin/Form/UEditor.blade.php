<div class="form-group {!! !$errors->has($errorKey) ?: 'has-error' !!}">
    <label for="{{$id}}" class="col-sm-2 control-label">{{$label}}</label>
    <div class="col-sm-8">
        @include('admin::form.error')
        <textarea class="{{ $class }}" id="{{$name}}" name="{{$name}}" placeholder="{{ $placeholder }}" {!! $attributes !!}
        style="width: 100%;height: 300px;" >{{ old($column, $value) }}</textarea>
        @include('admin::form.help-block')
    </div>
</div>