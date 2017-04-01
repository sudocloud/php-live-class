<?php
/**
 * Author: root
 * Date  : 17-4-1
 * time  : 下午8:43
 * Site  : www.ptbird.cn
 * There I am , in the world more exciting!
 */
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;
use think\Session;
use think\Config;

class User extends Controller{
    /**
     *  初始化操作，确认用户登录
     *   - 请求session用户数据
     *   - 存在执行操作，不存在引导登录
     */
    public function _initialize(){
        // 获取登录状态信息
        $guid = Session::get('loginuser');
        $logincheck = Session::get('logincheck');
        $checkCode = md5($guid . Config::get('login.flag'));
        if($checkCode !=$logincheck){
            //如果是ajax请求，不应该跳转，应当返回错误值
            if (Request::instance()->isAjax()){
                $data=[
                    'code'=>400,
                    'status'=>0,
                    'msg'=>'请先登录'
                ];
                return json()->data($data);
            }else{
                $this->redirect(url('/login'));
            }
        }
    }
    public function index(){

    }

    /**
     * 添加或者删除用户收藏的函数
     *  - post请求 参数为 room = guid
     *  - 失败的条件：用户未登录/room不存在或者被封禁/用户是主播/
     */
    public function toggleCollect(Request $request){
        $room=trim($request->param('room','post'));
        $dbPrefix = Config::get('database.prefix');
        // 查询房间信息,顺便将主播查询出来
        $sql="SELECT userzhubo.user as uid,room.* FROM ".$dbPrefix."userzhubo as userzhubo , ".$dbPrefix."room as room WHERE room.guid=? AND room.guid=userzhubo.room";
        $roomInfo=Db::query($sql,[$room]);
        $roomInfo=$roomInfo[0];
        if(count($roomInfo)==0){
            return json()->data(['code'=>400,'status'=>0,'msg'=>'房间信息错误']);
        }
        // 查出用户的guid
        $guid=Session::get('loginuser');
        if(strlen($guid)==0){
            return json()->data(['code'=>400,'status'=>0,'msg'=>'用户信息错误']);
        }
        if($guid==$roomInfo['uid']){
            return json()->data(['code'=>400,'status'=>0,'msg'=>'不能收藏自己']);
        }
        // 查看是否已经收藏过了 如果收藏过了，则直接取消收藏
        $userCollectonInfo=Db::name('usercollection')->where(['user'=>$guid,'room'=>$room])->find();

        if(count($userCollectonInfo)!=0){
            // 用户已经收藏过了 取消收藏操作
            if(Db::name('usercollection')->where(['user'=>$guid,'room'=>$room])->delete()){
                // 查看房间的收藏人数
                $count=Db::name('usercollection')->where(['room'=>$room])->count();
                return json()->data(['code'=>200,'status'=>1,'msg'=>'成功取消收藏','data'=>['number'=>$count]]);
            }else{
                return json()->data(['code'=>400,'status'=>0,'msg'=>'取消收藏失败',]);
            }
        }else{
            // 信息没有问题 写入数据库中 添加收藏信息
            $time=time();
            $data=['user'=>$guid,'room'=>$room,'create_time'=>$time,'update_time'=>$time];
            if(Db::name('usercollection')->insert($data)){
                // 插入成功 返回收藏成功
                $count=Db::name('usercollection')->where(['room'=>$room])->count();
                return json()->data(['code'=>200,'status'=>1,'msg'=>'成功收藏','data'=>['number'=>$count]]);
            }else{
                // 插入失败
                return json()->data(['code'=>400,'status'=>0,'msg'=>'收藏失败']);
            }
        }
    }
}
