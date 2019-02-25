<div class="form-group {!! !$errors->has($label) ?: 'has-error' !!}">

    <label for="{{$id}}" class="col-sm-2 control-label">{{$label}}</label>
    <div class="col-sm-8">
        <div class="btn btn-primary send-address" >选择发货地址</div>
        <input type="hidden" class="send-adddress-hidden" name="{{$column}}">

    </div>
</div>

<div class="form-group form-group-bussness-address-text" style="display: none">
    <label  class="col-sm-2 control-label"></label>
    <div class="col-sm-8" >
        <div style="border: 1px solid #ccc;padding: 6px;">
            <div style="color: #707070;font-size: 14px;" class="send-man-bussiness">发货人：  何呵呵1</div>
            <div style="color: #707070;font-size: 14px;" class="send-address-business">发货地址：广东省 东莞市 东城区 万达广场A区18号</div>
        </div>

    </div>
</div>


<div id="send-address-back"  style="display:none;position: fixed;left: 0;top: 0;width: 100%;
    height: 100%;background-color: rgba(0,0,0,0.5);z-index: 10000">
    <div id="div1"  style="background:#eeeeee;width: 40%;z-index:10001;
        margin: 12% auto;overflow: auto;">
        <div id="close" style="padding: 5px;background: #3c8dbc;">
            <span id="send-address-close-button" style="color: white;cursor: pointer;
                padding-right: 15px;float: right;font-size: 30px;" >×</span>
            <h2 style="margin: 10px 0;color: white;padding-left: 8px; font-size: 18px">选择发货地址</h2>
        </div>
        <div id="div2" style="background:#eeeeee;margin: auto;height: 300px;padding: 0 20px;">
            <div style="border:1px solid #3c8dbc; height: 50px ; width: 98% ; margin: 6px;
                border-radius: 5px;padding: 5px;" class="checkBusinessAddress">
                <div style="color: #3c8dbc;font-size: 14px; " class="checkBusinessAddressSend"></div>
                <div style="color: #3c8dbc;font-size: 14px; " class="checkBusinessAddressSendAdd"></div>
            </div>
            <div class="singleli" style="width: 98% ;height: 185px; padding: 6px;
                overflow-y: scroll">
                <li>
                    <input type="checkbox" id="11" class="singleItem" >
                    <label for="11"  onclick="checkAddressBtn(this)">
                        <div style="color: #707070;font-size: 14px; ">发货人：何呵呵1</div>
                        <div style="color: #707070;font-size: 14px; ">发货地址：广东省 东莞市 东城区 万达广场A区18号</div>
                    </label>
                </li>
                <li>
                    <input type="checkbox" id="22" class="singleItem" >
                    <label for="22"  onclick="checkAddressBtn(this)">
                        <div style="color: #707070;font-size: 14px; ">发货人：何呵呵2</div>
                        <div style="color: #707070;font-size: 14px; ">发货地址：广东省 东莞市 东城区 万达广场A区19号</div>
                    </label>
                </li>
                <li>
                    <input type="checkbox" id="33" class="singleItem" >
                    <label for="33"  onclick="checkAddressBtn(this)">
                        <div style="color: #707070;font-size: 14px; ">发货人：何呵呵3</div>
                        <div style="color: #707070;font-size: 14px; ">发货地址：广东省 东莞市 东城区 万达广场A区17号</div>
                    </label>
                </li>
            </div>
            <div style="float: right;margin:8px; ">
                <span class="btn bg-light-blue" onclick="sureBusinessAddress()">确定</span>
            </div>
        </div>
    </div>
</div>


<script>
    $('.send-address').click(function (){
        $('#send-address-back').css('display','block');
    });

    $('#send-address-close-button').click(function (){
        $('#send-address-back').css('display','none');
    });

    $(".singleli input:checkbox").click(function () {
        var $this = $(this),
            label = $this.siblings('label'),
            siblingsLis = $this.parent('li').siblings('li');
        label.hasClass('mutliArrow') ? label.removeClass('mutliArrow') : label.addClass('mutliArrow');
        siblingsLis.find('input:checked').prop("checked", false).siblings('label').removeClass('mutliArrow');
    })

    function checkAddressBtn(obj)
    {
        var sendMan = $(obj).find('div').eq(0).text();
        var sendAdd = $(obj).find('div').eq(1).text();
        var addressId = $(obj).attr('for');
        // console.log(sendMan);
        // console.log(sendAdd);
        // console.log(addressId);
        $('.checkBusinessAddress').find('.checkBusinessAddressSend').text(sendMan);
        $('.checkBusinessAddress').find('.checkBusinessAddressSendAdd').text(sendAdd);
        $('.send-adddress-hidden').val(addressId);
    }

    function sureBusinessAddress()
    {
        var sendMan = $('.checkBusinessAddress').find('.checkBusinessAddressSend').text();
        var sendAdd = $('.checkBusinessAddress').find('.checkBusinessAddressSendAdd').text();

        $('.form-group-bussness-address-text').css('display' , 'block');
        $('.form-group-bussness-address-text').find('.send-man-bussiness').text(sendMan);
        $('.form-group-bussness-address-text').find('.send-address-business').text(sendAdd);
        $('#send-address-back').css('display','none');
    }
</script>