<?php

namespace app\index\controller;

use think\Controller;
use think\Config;
use think\Session;
use think\Cache;
use think\Db;

class Acl extends Controller{

    public function _initialize(){
        // 获取登录状态信息
        $guid = Session::get('loginadmin');
        $logincheck = Session::get('logincheck');
        $checkCode = md5($guid.Config::get('login.adminflag'));
        if ($checkCode == $logincheck) {
            // 用户登录成功
            // 从缓存中读取用户的信息
            $userInfo = Cache::get($guid);
            if (!$userInfo) {
                // 未设置缓存，从数据库中查询数据并写入缓存
                $resInfo = Db::name('user')->where(['guid' => $guid])->find();
                if (count($resInfo) > 0) {
                    Cache::set($guid, $resInfo);
                }
                $userInfo = $resInfo;
            }
            // 上面只要用户登录 就确定查出了用户信息
            // 然后输出到前台，并且输出一个flag
            $this->assign('userLoginInfo', $userInfo);
            // dump($userInfo);
            $this->assign('userLoginFlag', 1);
        } else {
            // 用户没有触发登录条件
            $this->redirect(url('/login'));
        }
        return false;
    }
}
