$(function () {
    var hash = document.location.hash;
    if (hash) {
        $('.nav-tabs a[href="' + hash + '"]').tab('show');
    }
// Change hash for page-reload
    $('.nav-tabs a').on('shown.bs.tab', function (e) {
        history.pushState(null, null, e.target.hash);
    });
    if ($('.has-error').length) {
        $('.has-error').each(function () {
            var tabId = '#' + $(this).closest('.tab-pane').attr('id');
            $('li a[href="' + tabId + '"] i').removeClass('hide');
        });
        var first = $('.has-error:first').closest('.tab-pane').attr('id');
        $('li a[href="#' + first + '"]').tab('show');
    }
    $('.product_num:not(.initialized)')
        .addClass('initialized')
        .bootstrapNumber({
            upClass: 'success',
            downClass: 'primary',
            center: true
        });

    $('.prime_cost').inputmask({"alias": "decimal", "rightAlign": true});
    $('.present_price').inputmask({"alias": "decimal", "rightAlign": true});
    $('.product_freght').inputmask({"alias": "decimal", "rightAlign": true});
    $(".type_id").select2({"allowClear": true, "placeholder": {"id": "", "text": "\u5546\u54c1\u7c7b\u578b"}});
    $('.after-submit').iCheck({checkboxClass: 'icheckbox_minimal-blue'}).on('ifChecked', function () {
        $('.after-submit').not(this).iCheck('uncheck');
    });

});

// //自定义复选框的点击事件实现
// $(".mutli input:checkbox").click(function () {//自定义复选框的点击事件
//     var _this = $(this),
//         label = _this.siblings("label");
//     label.hasClass('mutliArrow') ? label.removeClass('mutliArrow') : label.addClass('mutliArrow');//三目结构写判断
//     if (_this.hasClass("checkAll")) {//全选事件
//         var siblingsLis= _this.parent("li").siblings("li");
//         label.hasClass('mutliArrow') ? siblingsLis.find('input:not(":checked")').prop("checked", true).siblings('label').addClass('mutliArrow') : siblingsLis.find('input:checked').prop("checked", false).siblings('label').removeClass('mutliArrow');
//     } else {
//         $(".checkAll").removeAttr("checked").siblings("label").removeClass("mutliArrow");
//     }
// })

