## 项目简介
#### mybbs 是一款基于 Laravel 5.5 框架开发的开类似Laravel China 社区的网站，你可以将其作为项目原型快速开始业务迭代开发。
## 代码仓库
####Github：https://github.com/wangyucai/mybbs
## 安装步骤
#### 克隆资源库：git clone https://github.com/wangyucai/mybbs.git ./
#### 安装依赖关系：composer install
#### 复制配置文件：cp .env.example .env
#### 创建新的应用程序密钥：php artisan key:generate
#### 设置数据库：编辑.env文件
##### DB_HOST=YOUR_DATABASE_HOST
##### DB_DATABASE=YOUR_DATABASE_NAME
##### DB_USERNAME=YOUR_DATABASE_USERNAME
##### DB_PASSWORD=YOUR_DATABASE_PASSWORD
#### 添加自动加载：composer dump-autoload
#### 运行数据库迁移：php artisan migrate
#### 运行数据填充：php artisan db:seed

这样，我们就可以打开浏览器，使用 自己配置的域名访问应用首页了

