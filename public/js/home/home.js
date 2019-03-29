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
            $('#uploadImgPath').val(response);
            $(obj).parent().find('img').attr('src',response);
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

function updatenum(obj)
{
    var action = $(obj).attr('class');
    if(action === 'jia'){
        num = $(obj).parent().find('input').val();
        $(obj).parent().find('input').val(parseInt(num)+1);
    }else{
        num = $(obj).parent().find('input').val();
        //商品件数不可能为负数，所以小于1就不可以减
        if(num > 1){
            $(obj).parent().find('input').val(parseInt(num)-1);
        }
    }
}

