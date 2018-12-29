<?php
namespace app\Helpers\Util;
use mysqli;

class Sysinfo
{
    protected $info;

    //构造函数
    public function __construct()
    {
    }

    //获取数据库版本
    public function mysql()
    {
        $host           =  env('DB_HOST');
        $username       =  env('DB_USERNAME');
        $password       =  env('DB_PASSWORD');
        $mysqli 	= new mysqli($host, $username, $password);
        return "Mysql/".$mysqli->server_info;
    }
    //获取服务器系统信息
    public function server()
    {
        return $this->info->getModel().' '.$this->info->getOS();
    }
    //获取cpu信息
    public function cpu()
    {
        $cpu   = $this->info->getCPU();
        return $cpu[0]['Model']
            .' '
            .$cpu[0]['MHz']
            .' '
            .$cpu[0]['Vendor'];
    }
    //获取内存信息
    public function memory()
    {
        $ram 	= $this->info->getRam();
        return $ram['type']
            .' '
            .ceil(intval($ram['total'])/(1024*1024*1024))
            .'GB';
    }
    //Laravel版本
    public function laraver()
    {
        return app()->version();
    }
    //时区设置
    public function timezone()
    {
        return config('app.timezone');
    }
    // 安装模式
    public function safeMode()
    {
        return (boolean) ini_get('safe_mode') ?  '是':'否';
    }
    //获取操作系统
    public function client_os()
    {
        return get_os();
    }
    //获取服务环境
    public function server_software()
    {
        return request()->server('SERVER_SOFTWARE');
    }
    //获取PHP版本
    public function php_version()
    {
        return phpversion();
    }

    //获取服务器剩余空间
    public function disk_free_space()
    {
        $freeSpace = round((@disk_free_space(".") / (1024 * 1024)), 2);
        if($freeSpace >= 1024){
            $diskFreeSpace = round($freeSpace/1024 , 2).'G';
        }else{
            $diskFreeSpace = round((@disk_free_space(".") / (1024 * 1024)), 2) . 'M';
        }
        return $diskFreeSpace;
    }
    //是否支持gd库
    public function gd()
    {
        return extension_loaded('gd')?"是":"否";
    }
    //获取gd版本
    public function gd_version()
    {
        return extension_loaded('gd')? gd_info()['GD Version'] :"";
    }
    //是否支持curl
    public function curl()
    {
        return extension_loaded('curl')?"是":"否";
    }
    //是否支持魔术方法
    public function magic_quotes_gpc()
    {
        return get_magic_quotes_gpc()?"是":"否";
    }
    //上传文件最大大小
    public function upload_max_filesize()
    {
        return ini_get('upload_max_filesize');
    }
    //获取表单最大提交限制
    public function post_max_size()
    {
        return ini_get('post_max_size');
    }
    //获取最大执行时间
    public function max_execution_time()
    {
        return ini_get('max_execution_time').'秒';
    }
    //获取服务器时间
    public function server_time()
    {
        return date("Y年m月d日 G:i:s");
    }
    //获取北京时间
    public function beijing_time()
    {
        return gmdate("Y年n月j日 H:i:s",time()+8*3600);
    }
    //获取客户端IP
    public function ip()
    {
        return request()->server('SERVER_ADDR');
    }

    public function info()
    {

        $configure = [
            'client_os'=>['type' => 'system','name' => '操作系统','value' => $this->client_os()],
            'server_software'=>['type' => 'system','name' => '运行环境','value' =>$this->server_software()],
            'server_mysql'=>['type' => 'system','name' => '数据库环境','value' =>$this->mysql()],
            'php_version'=> ['type' => 'system','name' => 'PHP版本','value' => $this->php_version()],
            'php_disk_free_space'=>['type' => 'system','name' => '剩余空间','value' => $this->disk_free_space()],
            'client_ip'=>['type' => 'system','name' => '客户端IP','value' =>  $this->ip()],
            'server_time'=>['type' => 'system','name' => '服务器时间','value' => $this->server_time()],

            'gd'=>['type' => 'dependencies','name' => '是否支持GD','value' =>$this->gd()],
            'gd_version'=>['type' => 'dependencies','name' => 'GD版本','value' => $this->gd_version()],
            'curl'=>['type' => 'dependencies','name' => '是否支持CURL','value' => $this->curl()],
            'magic_quotes_gpc'=>['type' => 'dependencies','name' => 'magic_quotes_gpc','value' => $this->magic_quotes_gpc()],
            'upload_max_filesize'=>['type' => 'dependencies','name' => '上传附件限制','value' => $this->upload_max_filesize()],
            'post_max_size'=>['type' => 'dependencies','name' => '表单提交的最大数据','value' => $this->post_max_size()],
            'max_execution_time'=>['type' => 'dependencies','name' => '执行时间限制','value' => $this->max_execution_time()],
//            'beijing_time'=>['type' => 'dependencies','name' => '北京时间','value' => $this->beijing_time()],
        ];


        return $configure;
    }

}
