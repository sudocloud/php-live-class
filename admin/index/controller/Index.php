<?php
namespace app\index\controller;

use app\index\model\User;
use think\Config;
use think\Db;
use think\Session;
use app\index\model\Room;
use app\index\model\Usersuggest;

class Index extends Acl
{
    /**
     * 判断用户是否登录，如果已经登录，则在header显示用户的头像
     * @return mixed
     */
    public function index()
    {
        // 获取当前系统中存正在直播的房间
        $roomAllInfo=Room::all();
        $roomNowInfo=Room::all(['status'=>1]);
        $userAllInfo=User::all();
        $userSuggestInfo=Usersuggest::all();
        $this->assign('roomAllInfoCount',count($roomAllInfo));
        $this->assign('roomNowInfoCount',count($roomNowInfo));
        $this->assign('userAllInfoCount',count($userAllInfo));
        $this->assign('userSuggestInfoCount',count($userSuggestInfo));
        return $this->fetch();
    }
    /**
     *  查看房间列表
     *  分页
     */
    public function roomList(){
        $roomAllInfo=Room::all();
        $this->assign('allRoomInfo',$roomAllInfo);
        return $this->fetch();
    }

}
