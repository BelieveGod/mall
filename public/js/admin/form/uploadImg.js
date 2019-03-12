function uploadFile(obj)
{
    var formData = new FormData();
    formData.append("img" , $(obj)[0].files[0]);
    // $.ajaxSetup({
    //     headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
    // });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
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
                '                color: #fff;text-align:center;right: 3px;bottom: 3px;cursor:pointer;" onclick="removeImg(this)"><i class="fa fa-trash"></i></div>\n' +
                '            <img src="'+ response +'" width="150px">\n' +
                '            <input type="hidden" value="'+response+'" name="up[]">\n'+
                '      </div>';
            $('.append-upload-img').append(html);
        },
        error : function(){ }
    });
}

function removeImg(obj)
{
    var del = $(obj).parent().find('input').val();
    var data = {};
    data.del = del;
    $(obj).parent().remove();
    $.get('/admin/api/deletedImg' , data , function (res) {
        console.log(res);
    });

}