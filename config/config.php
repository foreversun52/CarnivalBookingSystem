<?php
// 该文件是存放的嘉年华狂欢节的配置信息
$config = array();
// 变量CARNIVAL_DAYS 表示狂欢节需要多长时间
$config['CARNIVAL_DAYS'] = 5;
// 变量CURRENT_DAY 表示狂欢节第一天的前一天（比如明天是狂欢节的第1天 那么今天就是第0天）
$config['CURRENT_DAY'] = 0;
// 将这个配置数值直接return掉 这样当我们引入这个文件时就是直接引入这个数组
return $config;

