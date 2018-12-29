// 上传点击事件
$('.upload-btn').on('click', function() {
    $(this).closest('.upload-container').find('.upload-picker label').click();
});

function initWebUploader(pick, multiple, addServer, deleteServer, progress)
{
    var newClass = 'UC_' + Math.ceil(Math.random()*(10000 - 1));

    var $container = $(pick).closest('.upload-container').addClass(newClass);
    $container = $('.' + newClass);
    var uploader = WebUploader.create({
        auto: true,
        server: addServer,
        pick: { id: pick, multiple: multiple },
        accept: { title: "Images", extensions: 'gif,jpg,jpeg,png,bmp,xls,xlsx',mimeTypes:"image/jpg,image/jpeg,image/png,image/gif,application/xls,application/xlsx" },
        thumb: { quality:100,allowMagnify: false }
    });

    // if (multiple == true) {
    //     // deleteServer
    // }
    
    uploader.on('beforeFileQueued', function () {
        if (multiple == false) {
            var files = uploader.getFiles();
            console.log(files);
            for(var i in files) {
                uploader.removeFile(files[i], true);
            }
        }
    })

    // 文件上传过程中创建进度条实时显示。
    uploader.on('uploadProgress', function (file, percentage) {

        console.log(file,file.id,percentage);
        if(progress){

            var $li = $('#' + file.id),
                $percent = $li.find('.progress-bar');

            // 避免重复创建
            if (!$percent.length) {
                $percent = $('<div class="progress" style="width:100px">' +
                    '<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">' +
                    '<span class="sr-only"></span>' +
                    '</div>' +
                    '</div>').appendTo($li).find('.progress-bar');
            }

            $li.find('span.tip').text('上传中');

            if( $('#btn-primary').length>0 ){
                if(percentage == 1){
                    $('#btn-primary').removeAttr("disabled");
                }else{
                    $('#btn-primary').attr({ disabled: "disabled" });
                }
            }

            $percent.css('width', percentage * 100 + '%');
        }

    })

    uploader.on('fileQueued', function(file) {
        uploader.makeThumb(file, function(error, src) {
            // if (error) {
            //     alert('缩略图创建失败');
            // } else {
            //     alert('缩略图创建成功');
            // }
            var files = uploader.getFiles();
            console.log(files);

            if (multiple == false) {
                $container.find('.upload-btn').removeClass('fa-plus');
                $container.find('.upload-btn').html('<img src="'+src+'"/>');
            } else {
                // data-hash 上传未出结果之前用来做标识，上传完成后，可能会移除
                var imgItem = ''
                    + '<div class="img-item" data-hash="'+file.__hash+'">'
                    +     '<span class="tip">上传成功</span>'
                    +     '<i class="fa fa-arrow-left"></i>'
                    +     '<i class="fa fa-search-plus"></i>'
                    +     '<i class="fa fa-trash"></i>'
                    +     '<i class="fa fa-arrow-right"></i>'
                    +     '<img src="'+src+'" />'
                    + '</div>';
                $container.append(imgItem);
            }
        })
    })

    uploader.on( 'uploadSuccess', function(file, response) {
        $container.closest('.form-item').find('.tip').text('');
        var $imgItem = $container.find('.img-item[data-hash="'+file.__hash+'"]');
        var $tip = $container.find('.img-item[data-hash="'+file.__hash+'"] .tip');
        if (response.stat == 1) {
            if (multiple == false) {
                $container.closest('.form-item').find('.tip')
                    .removeClass('error')
                    .addClass('success')
                    .text(response.msg);
                $container.closest('.form-item').find('.img-id').val(response.data.id);
            } else {
                $imgItem.attr('data-id', response.data.id);
                $imgItem.removeAttr('data-hash');
                $imgItem.attr('data-imgid', file.id);
                // 图片已存在，则不重复上传，当成错误 删掉该图片
                if (imageIsExist($container, response.data.id)) {
                    $tip.addClass('error').text('图片已存在');
                    setTimeout(function() {
                        $tip.closest('.img-item').remove();
                    }, 1500);
                    return false;
                }
                updateImageIds($container);
                $tip.addClass('success').text(response.msg);
                setTimeout(function() {
                    $tip.hide();
                }, 1500);
            }
        } else {
            if (multiple == false) {
                $container.closest('.form-item').find('.tip')
                    .removeClass('success')
                    .addClass('error')
                    .text(response.msg);
            } else {
                $tip.addClass('error').text(response.msg);
                setTimeout(function() {
                    $tip.closest('.img-item').remove();
                }, 1500);
            }
        }
    });

    uploader.on('uploadError', function (file) {
        console.log(file)
    })

    // 左移动
    $container.on('click', '.fa-arrow-left', function () {
        var $cot = $(this).closest('.upload-container');
        var id = $(this).closest('.img-item').attr('data-id');
        var index = 1;
        $cot.find('.img-item').each(function () {
            if ($(this).attr('data-id') == id) {
                return false;
            }
            ++ index;
        })
        if (index <= 1) return false;

        $prev = $cot.find('.img-item').eq(index - 2);
        $curr = $cot.find('.img-item').eq(index - 1);

        swapImageItem($prev, $curr)
    })

    // 右移动
    $container.on('click', '.fa-arrow-right', function () {
        var $cot = $(this).closest('.upload-container');
        var id = $(this).closest('.img-item').attr('data-id');
        var index = 1;
        $cot.find('.img-item').each(function () {
            if ($(this).attr('data-id') == id) {
                return false;
            }
            ++ index;
        })
        if (index >= $('.img-item').length) return false;

        $curr = $cot.find('.img-item').eq(index - 1);
        $next = $cot.find('.img-item').eq(index);

        swapImageItem($curr, $next)
    });

    // 删除
    $container.on('click', '.fa-trash', function () {
        var files = uploader.getFiles();
        console.log(files);
        var $cot = $(this).closest('.upload-container');
        var $imgItem = $(this).closest('.img-item');
        var imgid = $imgItem.attr('data-imgid');
        // 上传队列中删除该文件，以便于可以重新上传
        $.each(files || [], function(i, item) {
            console.log(imgid)
            if (item.id == imgid) {
                uploader.removeFile(imgid, true);
            }
        });
        $(this).closest('.img-item').remove();
        updateImageIds($cot);
    });
    // 预览
    $container.on('click', '.fa-search-plus', function () {
        var src = $(this).closest('.img-item').find('img').attr('src');
        $('.fancybox-container').find('a').attr('href', src);
        $('.fancybox-container').find('img').attr('src', src);
        $('.fancybox-container').find('img').click();
    })
}

// 图片交换位置
function swapImageItem($a, $b)
{
    var id  = $a.attr('data-id');
    var src = $a.find('img').attr('src');

    $a.attr('data-id', $b.attr('data-id'))
    $a.find('img').attr('src', $b.find('img').attr('src'))

    $b.attr('data-id', id)
    $b.find('img').attr('src', src)

    updateImageIds($a.closest('.upload-container'));
}

// 更新图片ids
function updateImageIds($container)
{
    var ids = [];
    $container.find('.img-item').each(function(i, item) {
        id = $(this).attr('data-id');
        ids.push(id);
    })
    $container.closest('.form-item').find('.img-ids').val(ids.join(','));
}

function imageIsExist($container, id)
{
    var ids = $container.closest('.form-item').find('.img-ids').val();
    ids = ids ? ids.split(',') : [];
    if ($.inArray(''+id, ids) >= 0) {
        return true;
    }

    return false;
}