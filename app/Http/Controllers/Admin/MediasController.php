<?php

namespace App\Http\Controllers\Admin;

use App\Models\Media;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Util\Filesystem;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

class MediasController extends Controller
{
    use HasMediaTrait;

    private $disk;
    private $publicPath;

    public function __construct()
    {
        $this->disk = Storage::disk('web');
        $this->publicPath = public_path('/');

    }
    /**
     * 目录列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $folder =  $request->input('folder','');

        $dirs = $this->getDirectories($folder);
        $directories = $this->getFiles($folder,$dirs);

        return view('admin.medias.index',compact(['directories','folder']));
    }

    /**
     * 创建目录
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $folder =  $request->input('folder','');
    }

    /**
     * 创建目录
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Filesystem $filesystem)
    {
        $folder =  $request->input('folder','');
        // 取到磁盘实例
        $disk = $this->disk;
        // 创建目录
        $disk->makeDirectory($folder);
        session()->flash('success','目录创建成功');
        return redirect()->route('medias.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $folder =  $request->input('folder','');
        $file =  $request->input('file','');
    }

    /**
     * 在文件开头/结尾添加内容
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $folder =  $request->input('folder','');
        $file =  $request->input('file','');
        $prepend =  $request->input('prepend','');
        $append =  $request->input('append','');
        // 取到磁盘实例
        $disk = $this->disk;
        // 在文件开头添加
        $disk->prepend($file, $prepend);
        // 在文件末尾添加
        $disk->append($file, $append);
        session()->flash('success','文件编辑成功');
        return redirect()->route('medias.index');
    }

    /**
     * 删除目录
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $folder =  $request->input('folder','');
        // 取到磁盘实例
        $disk = $this->disk;
        // 删除目录
        $disk->deleteDirectory($folder);
        session()->flash('success','目录删除成功');
        return redirect()->route('medias.index');
    }

    /**
     * 返回目录下所有文件夹
     */
    public function getDirectories($folder)
    {

        $disk = $this->disk;
        $dirs = $disk->directories($folder);
        $directories = [];
        if($dirs){
            foreach ($dirs as $diry){
                $size = $disk->getSize($diry);
                $lastModified = $disk->lastModified($diry);

                $directories[] = [
                    'name'=>str_replace($folder.'/','',$diry),
                    'size'=>human_filesize($size),
                    'lastModified'=>date('Y-m-d H:i:s',$lastModified),
                    'realFolder'=>$diry,
                    'filetype'=>'dir',
                ];
            }
        }
        return $directories;
    }
    /**
     * 返回目录下所有文件
     */
    public function getFiles($folder,$directories)
    {
        // 取到磁盘实例
        $disk = $this->disk;
        $files = $disk->files($folder);
        if($files){
            foreach ($files as $file){
                $size = $disk->getSize($file);
                $lastModified = $disk->lastModified($file);

                $directories[] = [
                    'name'=>str_replace($folder.'/','',$file),
                    'size'=>human_filesize($size),
                    'lastModified'=>date('Y-m-d H:i:s',$lastModified),
                    'realFolder'=>$file,
                    'filetype'=>'file',
                ];
            }
        }

        return $directories;

    }

}
