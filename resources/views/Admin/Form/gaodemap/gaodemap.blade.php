<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no, width=device-width">
    <title>输入提示后查询</title>
    <link rel="stylesheet" href="https://cache.amap.com/lbs/static/main1119.css"/>
    <link rel="stylesheet" href="https://a.amap.com/jsapi_demos/static/demo-center/css/demo-center.css"/>
    <script type="text/javascript" src="https://webapi.amap.com/maps?v=1.4.11&key={{$GaodeKey}}&plugin=AMap.Autocomplete,AMap.Geocoder,AMap.PlaceSearch"></script>
    <script type="text/javascript" src="https://cache.amap.com/lbs/static/addToolbar.js"></script>
</head>
<body>
<div id="container"></div>
<div id="myPageTop">
    <table>
        <tr>
            <td>
                <label>请输入关键字：</label>
            </td>
        </tr>
        <tr>
            <td>
                <input id="tipinput" placeholder="搜索"/>
            </td>
        </tr>
    </table>
</div>
<div class="input-card" style='width:28rem;'>
    <label style='color:grey'>点击地图获取地址</label>
    <div class="input-item">
        <div class="input-item-prepend"><span class="input-item-text">经纬度</span></div>
        <input id='lnglat' type="text" value=''>
    </div>
    <div class="input-item">
        <div class="input-item-prepend"><span class="input-item-text" >地址</span></div>
        <input id='address' type="text" disabled>
    </div>
</div>
<script type="text/javascript">
    var value;
    var arr = [];

    if('{{$gps_value}}'){
        value = '{{$gps_value}}'?'{{$gps_value}}':'';
        if(value){
            arr = value.split(',');
        }
    }else{
        arr[0] = 113.759995;
        arr[1] = 23.048764;
    }
    //地图加载
    var map = new AMap.Map("container", {
        resizeEnable: true,
        zoom:15,
        center:[arr[0],arr[1]],
    });
    //搜索关键字 输入提示
    var autoOptions = {
        input: "tipinput"
    };
    var auto = new AMap.Autocomplete(autoOptions);
    var placeSearch = new AMap.PlaceSearch({
        map: map
    });  //构造地点查询类
    AMap.event.addListener(auto, "select", select);//注册监听，当选中某条记录时会触发
    function select(e) {
        placeSearch.setCity(e.poi.adcode);
        placeSearch.search(e.poi.name);  //关键字查询查询
    }
    var geocoder,marker;
    function regeoCode() {
        if(!geocoder){
            geocoder = new AMap.Geocoder({
                city: "010", //城市设为北京，默认：“全国”
                radius: 1000 //范围，默认：500
            });
        }
        var lnglat  = document.getElementById('lnglat').value.split(',');
        if(!marker){
            marker = new AMap.Marker();
            map.add(marker);
        }
        marker.setPosition(lnglat);

        geocoder.getAddress(lnglat, function(status, result) {
            if (status === 'complete'&&result.regeocode) {
                var address = result.regeocode.formattedAddress;
                document.getElementById('address').value = address;
                // parent.document.getElementById('detail_address').value = address;
            }else{alert(JSON.stringify(result))}
        });
    }
    //针对更新操作处理的函数
    if('{{$gps_value}}'){
        var lnglatObj = document.getElementById('lnglat');
        var gps = parent.document.getElementById('{{$gps_name}}');
        lnglatObj.value = gps.value;
        regeoCode();
    }

    map.on('click',function(e){
        var text = e.lnglat.getLng()+','+e.lnglat.getLat();
        var lnglatObj = document.getElementById('lnglat');
        var gps = parent.document.getElementById('{{$gps_name}}');
        lnglatObj.value = e.lnglat;
        regeoCode();
        //设置隐藏域的值
        gps.value = text;
    })
</script>
</body>
</html>