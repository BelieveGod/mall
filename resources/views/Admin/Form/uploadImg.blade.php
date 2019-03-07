<div class="form-group">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        <div style="float: left;margin-right: 8px;padding: 3px;background-color: #848484;margin-bottom: 8px;position: relative">
            <div style="position: absolute;width: 20px;height: 20px;background-color: #9f191f;border-radius:10px;
                color: #fff;text-align:center;right: 3px;bottom: 3px;" onclick="removeImg(this)"><i class="fa fa-trash"></i></div>
            <img src="/image/test/1.jpg" width="150px">
        </div>
        <div style="float: left;margin-right: 8px;padding: 3px;background-color: #848484;margin-bottom: 8px;position: relative">
            <div style="position: absolute;width: 20px;height: 20px;background-color: #9f191f;border-radius:10px;
                color: #fff;text-align:center;right: 3px;bottom: 3px;" onclick="removeImg(this)"><i class="fa fa-trash"></i></div>
            <img src="/image/test/1.jpg" width="150px">
        </div>
        <div style="float: left;margin-right: 8px;padding: 3px;background-color: #848484;margin-bottom: 8px;position: relative">
            <div style="position: absolute;width: 20px;height: 20px;background-color: #9f191f;border-radius:10px;
                color: #fff;text-align:center;right: 3px;bottom: 3px;" onclick="removeImg(this)"><i class="fa fa-trash"></i></div>
            <img src="/image/test/1.jpg" width="150px">
        </div>
        <div style="float: left;margin-right: 8px;padding: 3px;background-color: #848484;margin-bottom: 8px;position: relative">
            <div style="position: absolute;width: 20px;height: 20px;background-color: #9f191f;border-radius:10px;
                color: #fff;text-align:center;right: 3px;bottom: 3px;" onclick="removeImg(this)"><i class="fa fa-trash"></i></div>
            <img src="/image/test/1.jpg" width="150px">
        </div>
        <div style="float: left;margin-right: 8px;padding: 3px;background-color: #848484;margin-bottom: 8px;position: relative">
            <div style="position: absolute;width: 20px;height: 20px;background-color: #9f191f;border-radius:10px;
                color: #fff;text-align:center;right: 3px;bottom: 3px;" onclick="removeImg(this)"><i class="fa fa-trash"></i></div>
            <img src="/image/test/1.jpg" width="150px">
        </div>
        <div style="float: left;margin-right: 8px;padding: 3px;background-color: #848484;margin-bottom: 8px;position: relative">
            <div style="position: absolute;width: 20px;height: 20px;background-color: #9f191f;border-radius:10px;
                color: #fff;text-align:center;right: 3px;bottom: 3px;" onclick="removeImg(this)"><i class="fa fa-trash"></i></div>
            <img src="/image/test/1.jpg" width="150px">
        </div>
    </div>
</div>

<div class="form-group {!! !$errors->has($errorKey) ?: 'has-error' !!}">
    <label for="{{$id}}" class="col-sm-2 control-label">{{$label}}</label>
    <div class="col-sm-8">
        <label for="upload-img" class="btn btn-info">上传图片</label>
        <input type="file" style="width: 100px" id="upload-img" class="hidden" name="img" onchange="uploadFile(this)"/>
    </div>
</div>

<script>
    function uploadFile(obj)
    {
        var data = new FormData();
        data.append("img" , $(obj)[0].files[0]);
        console.log(data);
        $.post('/api/uploadImg' , data , function () {

        });
    }

    function removeImg(obj)
    {
        $(obj).parent().remove();
    }

</script>