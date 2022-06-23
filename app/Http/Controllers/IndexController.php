<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function view;

// 主页路由通过该Controller可以在浏览器的/路径下访问到/resources/views/index/index.blade.php
class IndexController extends Controller
{
    public function index(Request $request){
        return view('index');
    }
}
