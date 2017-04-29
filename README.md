# NeuCMS

NeuCMS为微光网络工作室基于Yesno开发的一套CMS系统

## 环境需求

1. PHP 7+

2. Redis 3+

3. MySQL

4. Yaf扩展（[下载](http://pecl.php.net/package/yaf)）、Redis扩展（[下载](http://pecl.php.net/package/redis)）

## 安装

1. 修改conf/application.ini，将数据库信息进行修改

2. 导入`docs`目录下的SQL文件

3. 配置nginx或Apache，例如：（请根据自己实际需要修改）

```
server {
	listen 80;
	server_name backend.neucms;
	root	 /www/cms/sites/backend;
	location / {
		index		index.php index.html index.htm;
	}
	if (!-f $request_filename) {
		rewrite ^/(.*)$ /index.php last;
	}
	location ~ \.php$ {
		include	php-cgi.conf;
	}
}
```

## 关于多域名的配置

NeuCMS将各个功能设计为单独的模块。假设你有一个域名为example.com

1. API接口：api.example.com 对应`sites/api`

2. 前台：www.example.com 对应`sites/frontend`

3. 管理后台：backend.example.com 对应`sites/backend`

4. 静态资源：statics.example.com 对应`statics`

5. 图片资源：files.example.com 对应`upload`

配置好后，打开数据库中的 ms_config 表，把里面涉及到域名的地方都改成上面你自己定义的域名。
