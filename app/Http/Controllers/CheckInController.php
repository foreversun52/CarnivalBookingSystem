<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


// 登记页面的控制器类 用于实现登记界面的功能处理
class CheckInController extends Controller
{
    // 定义一个方法用于向登记页面传递值并渲染界面
    public function index(Request $request)
    {
        //引入自定义的方法类配置文件
        //Importing a custom method class configuration file
        require_once("config/function.php");
        // 获取自定义的方法中返回配置的狂欢节信息 并赋值给系统全局变量
        // Get the configured Carnival information returned in the customized method And assign it to the system global variable
        $configInfo = configInfo();
        // 获取当前的登录用户信息
        // Get current login user information
        $user = Auth::user();

        $assign = array();
        $assign['name'] = $user['name'];
        $assign['current_day'] = $configInfo['CURRENT_DAY'];
        $assign['carnival_days'] = $configInfo['CARNIVAL_DAYS'];
        // 将处理完的数据传递到resources/views/checkin.blade.php中进行页面渲染
        // Transfer the processed data to resources/views/checkin.blade.php
        return view('checkin',$assign);
    }
}
