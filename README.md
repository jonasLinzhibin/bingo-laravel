#服务器要求
Laravel 5.5
PHP7.0
MySQL5.7
Nginx 

#Nginx
如果你使用的是 Nginx，在你的站点配置中加入以下内容，它将会将所有请求都引导到 index.php 前端控制器：

location / {
    try_files $uri $uri/ /index.php?$query_string;
}

#扩展包
laravel-permission
laravel-menu

#功能
权限管理
菜单生成
文件管理

