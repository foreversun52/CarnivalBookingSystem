<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function view;

// 主页路由通过该Controller可以在浏览器的/路径下访问到/resources/views/index.blade.php
// The home page route can be accessed to /resources/views/index blade. php
class IndexController extends Controller
{
    // 定义了一个index方法 通过调在routes/下调用该方法即可实现访问index页面
    // An index method is defined. You can access the index page by calling this method in routes/
    public function index(Request $request){
        return view('index');
    }
}
