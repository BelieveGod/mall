function addAttrName(){
    var type_id = $('#typeId').val();
    var data = {};
    // console.log(type_id);
    data.type_id = type_id;
    $.get('/admin/api/showAttr/',data,function(ret){
        $('#optionattr').children().remove();
        $('#optionattr').append(ret);
    });
}

