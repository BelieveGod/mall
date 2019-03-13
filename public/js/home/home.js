function uploadImg(obj)
{
    var formData = new FormData();
    formData.append("member_pic" , $(obj)[0].files[0]);
    // $.ajaxSetup({
    //     headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
    // });
    $.ajax({
        type : 'post',
        url : '/api/uploadImg',
        data :formData,
        cache : false,
        processData : false,
        contentType : false,
        success : function(response){
            var html = '<input type="hidden" value="'+response+'" name="upload_img">';
            $('#uploadImg').children().remove();
            $('#uploadImg').append(html);
            $(obj).parent().find('img').attr('src',response);
            // console.log(response);
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