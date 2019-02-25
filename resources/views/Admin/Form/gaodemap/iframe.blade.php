<div class="form-group {!! !$errors->has($label) ?: 'has-error' !!}">

    <label for="{{$id}}" class="col-sm-2 control-label">{{$label}}</label>

    <div class="col-sm-8">
        <iframe  src="/admin/api/map/{{$name}}/{{$value}}" style="width:100%;height:500px;border:2px solid grey;"  allowtransparency="yes" marginheight="0" marginwidth="0" scrolling="no" frameborder="no" ></iframe>
        <input type="hidden" name="{{$name}}" value="{{$value}}" class="gps" id="{{$name}}" />
    </div>
</div>

