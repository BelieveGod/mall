<div class="form-group">
    <div class="col-sm-2"></div>
    <div class="col-sm-8 append-upload-img">

    </div>
</div>

<div class="form-group {!! !$errors->has($errorKey) ?: 'has-error' !!}">
    <label for="{{$id}}" class="col-sm-2 control-label">{{$label}}</label>
    <div class="col-sm-8">
        <label for="upload-img" class="btn btn-info">上传图片</label>
        <input type="file" style="width: 100px" id="upload-img" name="img" class="hidden"  onchange="uploadFile(this)"/>
    </div>
</div>

<script>
    function uploadFile(obj)
    {
        var formData = new FormData();
        formData.append("img" , $(obj)[0].files[0]);
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
        });
        $.ajax({
            type : 'post',
            url : '/admin/api/uploadImg',
            data :formData,
            cache : false,
            processData : false,
            contentType : false,
                success : function(response){
                    var html = '<div style="float: left;margin-right: 8px;padding: 3px;background-color: #848484;margin-bottom: 8px;position: relative">\n' +
                        '            <div style="position: absolute;width: 20px;height: 20px;background-color: #9f191f;border-radius:10px;\n' +
                        '                color: #fff;text-align:center;right: 3px;bottom: 3px;" onclick="removeImg(this)"><i class="fa fa-trash"></i></div>\n' +
                        '            <img src="'+ response +'" width="150px">\n' +
                        '        </div>';

                    $('.append-upload-img').html(html);
            },
            error : function(){ }
        });
    }

    function removeImg(obj)
    {
        $(obj).parent().remove();
    }

</script>