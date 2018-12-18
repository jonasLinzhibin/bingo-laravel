
//toastr配置
toastr.options = {
    closeButton: true,
    progressBar: true,
    showMethod: 'slideDown',
    timeOut: 4000
};

jQuery(document).ready(function () {


    $('.sidebar-menu').tree();

    $('.js-select2').each(function () {
        $(this).select2();
    });

    //Icon picker
    $('.js-iconpicker').each(function () {
        $(this).iconpicker({placement:'bottomLeft'});
    });
    //Color picker
    $('.js-colorpicker').each(function () {
        $(this).colorpicker();
    });

    // 刷新页面
    $('.refresh').click(function () {
        location.reload();
    });


    // 全选框
    $('.check-all').on('click', function(){
        $('.check').prop('checked', this.checked);
    });

    // ajax自动提交form表单验证
    $('.ajax-form,.ajaxForm').on('submit', function() {
        var $self = $(this);
        var url = $self.attr('action');
        var param = $self.serialize();
        postTo(url, param);
        return false;
    });


    // a标签ajax自动提交链接
    $('.ajax-href,.ajaxHref').on('click',  function(){
        var url = $(this).data('href');
        var param = $(this).data('param');
        if(param != '')param = strToJson(param);
        postTo(url, param);
        return false;
    });

    // a标签ajax自动提交链接
    $('.ajax-confirm,.ajaxConfirm').on('click',  function(){
        var url = $(this).data('href');

        swal({
            title: "确定删除吗?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "确定",
            showLoaderOnConfirm: true,
            cancelButtonText: "取消",
            preConfirm: function() {
                return new Promise(function(resolve) {
                    postTo(url,{},resolve);
                });
            }
        }).then(function(result) {
            var data = result.value;
            if (typeof data === 'object') {
                if (data.status == 'success') {
                    swal(data.msg, '', 'success');
                } else {
                    swal(data.msg, '', 'error');
                }
            }
        });

        return false;
    });


});


// POST提交处理
function postTo(url, param={}, resolve=function () {}){

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        async: true,
        type: 'POST',
        url: url,
        data: param,
        beforeSend:function () {
        },
        success:function (res) {
            if (res.status == 'error') {
                tips('error', res.msg);
            } else if(res.status ==  'danger') {
                tips('danger', res.msg);
            } else if (res.status == 'success') {
                tips('success', res.msg, res.uri);
                resolve(res);
            }
        },
        error:function (event) {

        },
        complete:function () {

        }

    });


}

// 提示信息
function tips(type, msg, url) {
    if (type == 'success') {
        toastr.success(msg);
    } else if (type == 'warning') {
        toastr.warning(msg);
    } else if (type == 'info') {
        toastr.info(msg);
    } else if (type == 'danger' || type == 'error') {
        toastr.error(msg);
    }
    if (url == 1) {
        setTimeout(function(){
            location.reload();
        },2000);
    } else if(url) {
        setTimeout(function(){
            location = url;
        },2000);
    }

}

// 字符串转json
function strToJson(str){
    var json = (new Function("return " + str))();
    return json;
}


//jQuery判断数组是否包含了指定的元素
function isInArray(value, arr) {
    var isExist = $.inArray(value, arr);
    return (isExist == -1) ? 0 : 1;
}