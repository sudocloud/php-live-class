<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\Route;

Route::rule('/'                    ,'index/Index/index'                 ,'GET');
Route::rule('/index'               ,'index/Index/index'                 ,'GET');

// 注册分类相关
Route::rule('/cate/:id'            ,'index/Index/cateItem'              ,'GET');
Route::rule('/cate'                ,'index/Index/liveAll'               ,'GET');

// 注册登录忘记密码
Route::rule('/login'               ,'index/Login/index'                 ,'GET');
Route::rule('/login/work'          ,'index/Login/loginWork'             ,'POST');
Route::rule('/regist'              ,'index/Login/regist'                ,'GET');
Route::rule('/regist/sendcode'     ,'index/Login/registSendCode'        ,'POST');
Route::rule('/regist/checkcode'    ,'index/Login/registCheckCode'       ,'POST');
Route::rule('/regist/work'         ,'index/Login/registWork'            ,'POST');
Route::rule('/login/passwprd'      ,'index/Login/forgetPassword'        ,'GET');
Route::rule('/login/passwprd/work' ,'index/Login/forgetPasswordWork'    ,'POST');
Route::rule('/login/logout'        ,'index/Login/logout'                ,'GET');

// 房间部分
Route::rule('/room/list'        ,'index/Index/roomList'                ,'GET');
