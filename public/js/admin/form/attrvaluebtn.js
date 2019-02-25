function addAttrVal(obj)
{
    var i = $(obj).parent('div').parent('div').parent('div').children('input').attr('name');
    i = i.substring(12,17);
    var input = '<div style="position: relative;display: table; margin-top: 10px;">\n' +
        '        <input type="text"  placeholder="规格属性" style="height: 34px;padding: 6px 12px;\n' +
        '        font-size: 14px;line-height: 1.42857143;color: #555;border: 1px solid #ccc;float: left;"' +
        ' name="attrValue['+ i+'][]">\n' +
        '<div style="float: left;cursor:pointer;height: 34px;padding: 6px 12px;font-size: 14px;line-height: 1.42857143;color:#ccc " ' +
        'class="glyphicon glyphicon-remove" onclick="closeAttrVal(this)"></div></div>';
    $(obj).parent('div').append(input);
    console.log(i);
}
function closeAttrVal(obj)
{
    $(obj).parent('div').remove();
}