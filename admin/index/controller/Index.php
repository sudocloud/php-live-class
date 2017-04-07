<?php
namespace app\index\controller;

use think\Config;
use think\Db;
use think\Session;

class Index extends Common
{
    /**
     * 判断用户是否登录，如果已经登录，则在header显示用户的头像
     * @return mixed
     */
    public function _initialize()
    {

    }

    public function index()
    {

        return $this->fetch();
    }

}
