<div class="form-group" id="addAttrName">
    <label for="{{$id}}" class="col-sm-2 control-label">{{$label}}</label>
    <div class="col-sm-8">
        <input type="hidden" name="type_id"/>
        <select class="form-control type_id" style="width: 100%;" name="type_id" data-value=""
                onchange="addAttrName()" id="typeId" >
            <option value=""></option>
            @foreach ($type as $val)
                <option value="{{$val['type_id']}}"  {{ $val['type_id'] == old($column, $value) ?'selected':'' }}>{{$val['type_name']}}</option>
            @endforeach
        </select>
    </div>
</div>
<div id="optionattr"></div>

<script>
    $('#typeIdv').ready(function (){

        var checked = $('#typeId').find('option:selected').text();
        var checked_id = $('#typeId').find('option:selected').val();
        var data = {};
        console.log(checked_id);
        if(checked){
            var product_id = "{{$product_id}}";
            data.type_id = checked_id;
            data.typpe_name = checked;
            data.product_id = product_id;
                $.get('/admin/api/showAttr/',data,function(ret){
                $('#optionattr').children().remove();
                $('#optionattr').append(ret);
            });
        }
    });
</script>










