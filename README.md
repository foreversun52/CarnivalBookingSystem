### Part 1: Declare the job done by each of your group member

### 第1部分：声明每个小组成员所做的工作

* 成员1：实现了XXXX
* 成员2：实现了XXXX
* 成员3：实现了XXXX

### Part 2: Instruction for installing your system on a new machine

### 第2部分：在新机器上安装系统的说明

Your machine must first install PHP, composer, mysql, and Git.

*  Run git clone https://github.com/foreversun52/CarnivalBookingSystem.git or download .zip file to download the project

*  运行git克隆https://github.com/foreversun52/CarnivalBookingSystem.git 或下载。用于下载项目的zip文件(这个地方现在是在我的github上，等交付了源码之后你可以将源码上传到你自己github上，然后将这个地址更换一下)

*  Run `composer install` to create needed directory(vendor).

*  运行命令:'`composer install` 创建laravel框架所需要的配置文件(如果需要更换版本，请修改项目根目录下的composer.json文件中的配置)

*  Configure your own database information in the .env file(just rename '.env.example' to '.env'),and then focus on following content.

*  在项目根路径下配置你的数据库连接信息，这个文件名为.env(请重命名.env.example为.env即可)，之后将文件中的连接数据库的内容更改为你本地的数据库信息，你需要更改的内容如下:

   | DB_CONNECTION=mysql                |
   | ---------------------------------- |
   | DB_HOST=your database host         |
   | DB_PORT=your database port         |
   | DB_DATABASE=your database name     |
   | DB_USERNAME=your database username |
   | DB_PASSWORD=your database password |

* Run `php artisan migrate` to create tables in your database.

*  运行命令 `php artisan migrate`将项目中的数据库表迁移到你 的数据库中

* Run `php artisan serve` to start this app.

*  完成之前的操作，并没有报错的前提下，可以通过执行命令`php artisan serve`运行程序，之后在浏览器中输入:http://127.0.0.1:8000/ 即可访问页面

