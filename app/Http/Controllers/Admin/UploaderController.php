<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UploaderController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function ckEditor(Request $request){

        $ck = $request->get('CKEditorFuncNum','1');
        $file = $request->file('upload');
        if($file && $file->isValid()) {
            //获取原文件名
            $originalName = $file->getClientOriginalName();
            //扩展名
            $ext = $file->getClientOriginalExtension();
            //文件类型
            $type = $file->getClientMimeType();
            //文件类型
            $size = $file->getClientSize();
            //生成文件名
            $newName = md5($type.$size.$originalName.$ext).".".$ext;
            //保存文件,覆盖同名文件
            $path = $file->storeAs('/media/editor/'. date('Ymd'), $newName,'web' );
            //获取文件url
            $url = Storage::disk('web')->url($path);
            echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($ck,'".$url."','上传成功');</script>";
        }else{
            echo "<script>alert('请选择图片！')</script>";
        }


    }
}
