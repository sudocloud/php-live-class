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

Route::rule('/', 'index/Index/index');

// 注册视频播放
Route::rule('/live/:id', 'index/Index/liveItem');
Route::rule('/live', 'index/Index/liveAll');
Route::rule('/live/all', 'index/Index/liveAll');
Route::rule('/live/all/noplay', 'index/Index/liveAllNoPlay');

// 注册登录忘记密码
Route::rule('/login', 'index/Login/index');
Route::rule('/login/work', 'index/Login/loginWork', 'post');
Route::rule('/regist', 'index/Login/regist');
Route::rule('/regist/sendcode', 'index/Login/registSendCode', 'post');
Route::rule('/regist/checkcode', 'index/Login/registCheckCode', 'post');
Route::rule('/regist/work', 'index/Login/registWork', 'post');
Route::rule('/login/passwprd', 'index/Login/forgetPassword');
Route::rule('/login/passwprd/work', 'index/Login/forgetPasswordWork');
Route::rule('/login/logout', 'index/Login/logout');

// 注册直播相关事件回调
Route::rule('/on_publish', 'index/Rtmp/onPublish'); // 推流输出
Route::rule('/on_publish_done', 'index/Rtmp/onPublishDone'); // 推流结束
Route::rule('/on_play', 'index/Rtmp/onPlay'); // 播放
Route::rule('/on_play_done', 'index/Rtmp/onPlayDone'); // 客户端播放结束
Route::rule('/ffmpeg_photo', 'index/Rtmp/ffmpegPhoto'); // 截取视频流截图
