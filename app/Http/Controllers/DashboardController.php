<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// 定义仪表板控制器用户定义实现显示仪表板和添加预定页面
class DashboardController extends Controller
{
    // 实现显示仪表板界面的方法
    public function index(Request $request){
        //引入自定义的方法类配置文件
        //Importing a custom method class configuration file
        require_once("config/function.php");
        // 获取自定义的方法中返回配置的狂欢节信息 并赋值给系统全局变量
        // Get the configured Carnival information returned in the customized method And assign it to the system global variable
        $configInfo = configInfo();
        // 获取当前的登录用户信息
        // Get current login user information
        $user = Auth::user();
        // 通过用户的email向预定表中查出当前登录用户的所有预约记录
        // Find out all the reservation records of the currently logged in user in the reservation table through the user's email
        $dataList = Reservation::where('email',$user['email'])->orderBy('reserve_date_at','desc')->get();
        // 将用户的信息和狂欢节配置信息以及用户的预约信息放到数组中传递给前端页面进行页面渲染
        // Put the user's information, Carnival configuration information and user's appointment information into the array and transfer them to the front page for page rendering
        $assign = array();
        $assign['name'] = $user['name'];
        $assign['email'] = $user['email'];
        $assign['current_day'] = $configInfo['CURRENT_DAY'];
        $assign['carnival_days'] = $configInfo['CARNIVAL_DAYS'];
        $assign['data_list'] = $dataList;
        // 将处理完的数据传递到resources/views/dashboard.blade.php中进行页面渲染
        // Transfer the processed data to resources/views/dashboard.blade.php
        return view('dashboard',$assign);
    }

    // 退出登录方法
    // Exit login method
    public function logout(Request $request){
        // 直接调用auth组件的退出登录方法
        // Directly call the exit login method of auth component
        Auth::logout();
        // 返回到系统首页 提示用户登录
        // Return to the system home page to prompt the user to log in
        return view('index');
    }

    // 添加预约页面方法 此方法用于渲染添加预约的页面
    public function addReservation(Request $request)
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
        // 获取当前登录用户的已经预约的数量
        // Get the reserved quantity of the currently logged in user
        $count = Reservation::where('email',$user['email'])->count();

        $assign = array();
        $assign['name'] = $user['name'];
        $assign['count'] = $count;
        $assign['current_day'] = $configInfo['CURRENT_DAY'];
        $assign['carnival_days'] = $configInfo['CARNIVAL_DAYS'];
        // 将处理完的数据传递到resources/views/addReservation.blade.php中进行页面渲染
        // Transfer the processed data to resources/views/addReservation.blade.php
        return view('addReservation',$assign);
    }
}
