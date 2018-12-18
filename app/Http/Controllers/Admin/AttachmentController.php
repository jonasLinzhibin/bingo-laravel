<?php

namespace App\Http\Controllers\Admin;

use App\Models\Attachment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;


class AttachmentController extends Controller
{
    // 文件上传方法
    public function upload(Request $request,$folder = 'others',$name='file')
    {
        //判断文件夹是否已存在
        $folder = $folder.'/'.date('Ymd');
        if(!Storage::disk('uploads')->exists($folder)){
            Storage::makeDirectory($folder);
        }

        $file = $request->file($name);

        if(empty($file)){
            //session()->flash('danger','未选择文件');
            return [];
        }

        // 检验一下上传的文件是否有效
        if ($file->isValid()) {
            // 获取文件相关信息
            $originalName = $file->getClientOriginalName(); // 文件原名
            $ext = $file->getClientOriginalExtension();     // 扩展名
            $realPath = $file->getRealPath();   //临时文件的绝对路径
            $mime_type = $file->getClientMimeType();     // image/jpeg
            $size = $file->getClientSize();
            $tmp_name = $file->getFilename();


            $md5 = md5_file($_FILES[$name]['tmp_name']);
            $attachment = new Attachment();
            $attach = $attachment::isExist($md5);
            // 如果已经上传过则不再上传
            if (!empty($attach)) {
                return $attach;
            }else{

                // 上传文件
                $filename = md5(microtime()). uniqid() . '.' . $ext;
                // 使用我们新建的uploads本地存储空间（目录）
                //这里的uploads是配置文件的名称
                $bool = Storage::disk('uploads')->put($folder."/".$filename, file_get_contents($realPath));
                if($bool){
                    $data = [
                        'name'          =>$filename,
                        'path'          =>'uploads/'.$folder."/".$filename,
                        'disk'          =>'uploads',
                        'ext'           =>$ext,
                        'mime_type'     =>$mime_type,
                        'md5'           =>$md5,
                        'size'          =>$size,
                    ];
                    $attach = Attachment::create($data);
                    if($attach){
                        $data['id'] = $attach->id;
                        session()->flash('success','上传成功');
                        return $attach;
                    }

                    Storage::delete($attach['path']);
                    session()->flash('danger','数据写入错误');
                    return [];

                }

                session()->flash('danger','文件上传失败');
                return [];
            }

        }
        session()->flash('danger','无效文件');
        return [];
    }

}
