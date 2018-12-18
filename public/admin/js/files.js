

//重命名
function ReName(type, fileName) {
    if (type == 1) {
        var path = $("#DirPathPlace input").val();
        var newFileName = encodeURIComponent(path + '/' + $("#newFileName").val());
        var oldFileName = encodeURIComponent(path + '/' + fileName);
        layer.msg(lan.public.the, {
            icon: 16,
            time: 10000
        });
        $.post('/files?action=MvFile', 'sfile=' + oldFileName + '&dfile=' + newFileName, function(rdata) {
            layer.closeAll();
            layer.msg(rdata.msg, {
                icon: rdata.status ? 1 : 2
            });
            GetFiles(path);
        });
        return;
    }
    layer.open({
        type: 1,
        shift: 5,
        closeBtn: 2,
        area: '320px',
        title: lan.files.file_menu_rename,
        content: '<div class="bt-form pd20 pb70">\
					<div class="line">\
					<input type="text" class="bt-input-text" name="Name" id="newFileName" value="' + fileName + '" placeholder="'+lan.files.file_name+'" style="width:100%" />\
					</div>\
					<div class="bt-form-submit-btn">\
					<button type="button" class="btn btn-danger btn-sm btn-title" onclick="layer.closeAll()">'+lan.public.close+'</button>\
					<button type="button" id="ReNameBtn" class="btn btn-success btn-sm btn-title" onclick="ReName(1,\'' + fileName.replace(/'/,"\\'") + '\')">'+lan.public.save+'</button>\
					</div>\
				</div>'
    });
    $("#newFileName").focus().keyup(function(e){
        if(e.keyCode == 13) $("#ReNameBtn").click();
    });
}