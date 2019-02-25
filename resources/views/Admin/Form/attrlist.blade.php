@foreach ($attr as $value)
<div class="form-group" >
    <span class="{{isset($ao)?$ao:''}}">
    <div class="col-sm-2 control-label attr_value_name">{{$value['attr_name']}}</div>
        <div class="col-sm-8">
            <div class="mutli">
                @foreach ($value['attr_value'] as $val)
                <li><input type="checkbox" id="{{$val['attr_value_id']}}"
                           class="singleItem"   >
                    <label for="{{$val['attr_value_id']}}"  onclick="attrValueBtn(this)"
                           attr_id="{{$val['attr_value_id']}}" class = "{{isset($abs)?$abs:''}} {{isset($ao)?'mutliArrow':''}}">{{$val['attr_value_name']}}</label></li>
                @endforeach
            </div>
        </div>
    </span>
</div>
@endforeach

<div class="form-group" >
    <div class="col-sm-2 control-label"></div>
    <div class="col-sm-8">
        <table id="skutable">
            @if(isset($attrname))
                <tr>
                    @foreach($attrname as $val)
                        <td>{{$val}}</td>
                    @endforeach
                </tr>
                @foreach($data as $val)
                <tr>
                    @for($i=0 ; $i<$val['count'] ; $i++)
                        <td>{{$val[$i]}}</td>
                    @endfor
                    <input type="hidden" name="sku[]" value="{{$val['sku_val']}}" />
                    <td><input type="text" name="kucun[]" value="{{$val['num']}}" placeholder=""/></td>
                    <td><input type="text" name="price[]" value="{{$val['price']}}" placeholder="请输入价格"/></td>
                </tr>
                @endforeach


            @endif
        </table>
    </div>

</div>

<script>
    //自定义复选框的点击事件
    $(".mutli input:checkbox").click(function () {
        var _this = $(this),
            label = _this.siblings("label");
        label.hasClass('mutliArrow') ? label.removeClass('mutliArrow') : label.addClass('mutliArrow');
        if (_this.hasClass("checkAll")) {//全选事件
            var siblingsLis= _this.parent("li").siblings("li");
            label.hasClass('mutliArrow') ? siblingsLis.find('input:not(":checked")').prop("checked", true)
                .siblings('label').addClass('mutliArrow') : siblingsLis.find('input:checked').prop("checked", false)
                .siblings('label').removeClass('mutliArrow');
        } else {
            $(".checkAll").removeAttr("checked").siblings("label").removeClass("mutliArrow");
        }
    });

    // $('#skutable').ready(function (){
    //     attrValueTable();
    // });

    function attrValueBtn(obj){
        var attr = [];
        $(obj).toggleClass('am-btn-success');
        var len = $(obj).parents('span').find('.am-btn-success').length;
        console.log(len);
        if( len>0 ){
            $(obj).parents('span').addClass('attr-on');
        }else{
            $(obj).parents('span').removeClass('attr-on');
        }
        attrValueTable();
    }

    function attrValueTable()
    {
        var attrName = [];
        var attr = [];
        var sku_id = [];
        $('#optionattr').find('.attr-on').find('.attr_value_name').each(function(){
            attrName.push($(this).text());
        });
        console.log(attrName);
        var html = '<tr>';
        for(var i = 0 ; i < attrName.length ; i++){
            html += "<td>"+attrName[i]+"</td>";
        }
        html += '<td>库存</td>';
        html += '<td>价格</td>';
        html += '</tr>';

        $('#optionattr').find('.attr-on').each(function(){
            var tmp = [];
            var temp = [];
            $(this).find('.am-btn-success').each(function(){
                var attrVals = $(this).text();
                tmp.push(attrVals);
                sku_id[attrVals] = $(this).attr('attr_id');
            });
            attr.push(tmp);
        });
        console.log(attr);
        // console.log(sku_id);
        var attrValue = deal(attr);

        $('#skutable').find('tbody').remove();
        for(var i = 0 ; i<attrValue.length ; i++){
            html += '<tr>';
            var tmp = attrValue[i];
            if(Array.isArray(tmp)){
                var attr_id = "";
                for(var j = 0 ; j<tmp.length ; j++){
                    html += '<td>'+tmp[j]+'</td>';

                    if(attr_id == ""){
                        attr_id = sku_id[tmp[j]];
                    }else{
                        attr_id += "_" + sku_id[tmp[j]];
                    }
                }
            }else{
                var attr_id = "";
                html += '<td>'+tmp+'</td>';
                attr_id = sku_id[tmp];
            }
            html += '<input type="hidden" name="sku[]" value="'+ attr_id +'" />';
            html += '<td><input type="text" name="kucun[]" value="" placeholder="请输入库存"/></td>';
            html += '<td><input type="text" name="price[]" value="" placeholder="请输入价格"/></td>';
            html += '</tr>';
        }

        $('#skutable').html(html);
    }
    function deal(arr){
        if(arr.length>1){
            var data = [];
            for(var i=0 ; i<arr[0].length ; i++){
                var temp = [];
                for(var j=0 ; j<arr[1].length ; j++){
                    if(!Array.isArray(arr[0][i])){
                        temp = [arr[0][i],arr[1][j]];
                        data.push(temp);
                    }else{
                        var t = [];
                        t = arr[0][i];
                        t = t.concat(arr[1][j]);
                        data.push(t);
                    }
                }
            }
            arr[0] = data;
            arr.splice(1,1);
            return deal(arr); //递归

        }else{
            return arr[0];
        }
    }
</script>