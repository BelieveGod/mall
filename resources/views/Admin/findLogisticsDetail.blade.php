<style>
    .logistics_ul{
        padding: 30px;
    }
    .logistics_ul li{
        margin-top: 20px;
        list-style-type:disc;
        color: #8c8c8c;
    }
    .logistics_ul li:first-child{
        color:#ff7a22;
    }
</style>
@if(!empty($data['data']))
<ul class="logistics_ul">
    @foreach($data['data'] as $value)
    <li>
        <i style="color: #8c8c8c">{{isset($value['time'])?$value['time']:null}}</i>
        <span style="margin-left: 40px;color: #8c8c8c">{{isset($value['context'])?$value['context']:null}}</span>
    </li>
    @endforeach
</ul>
@else
    <div style="margin-top: 100px;margin-bottom: 100px;text-align: center;">
        <img src="/image/home/no_data.png" width="150px;"/>
    </div>
@endif