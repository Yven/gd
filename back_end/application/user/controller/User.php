<?php
/**
 * 用户模块
 * Feature: 对用户信息增删查改
 * Time:    2018-01-05 14:28:56
 *
 * @author Yven <yvenchang@163.com>
 * @access public
 * @todo
**/

namespace app\user\controller;

use think\Request;
use app\user\model\User as UserModel;

class User extends Base
{
    //是否开启授权认证
    public $apiAuth = true;
    //附加方法
    // protected $extraActionList = ['sendCode'];
    //跳过鉴权的方法
    protected $skipAuthActionList = ['sendCode', 'save'];

    /**
     * 获取用户信息
     *
     * @param Request $request
     * @return Json
     */
    public function index(Request $request)
    {
        $user = new UserModel;

        if (($data = $user->where('uid', parent::$app['auth']->token['uid'])->find())) {
            unset($data['password']);
            return $this->sendSuccess($data);
        }

        return $this->sendError(400, 'User dont exsit!', 400);
    }

    /**
     * 注册新用户
     *
     * @param Request $request
     * @return Json
     */
    public function save(Request $request)
    {
        $data = $request->post();
        $user = new UserModel;
        $validate = validate('User');

        //  验证
        if (!$validate->scene('signup')->check($data)) {
            return $this->sendError(400, $validate->getError(), 400);
        }

        //  插入
        if (!$user->allowField(true)->save($data)) {
            return $this->sendError(500, 'Create user fielded, try it again later.', 500);
        }

        return $this->sendSuccess(['uid'=>$user->uid], 'Registration success!');
    }

    /**
     * 修改用户信息
     *
     * @param Request $request
     * @return Json
     */
    public function update(Request $request)
    {
    }

    /**
     * 删除用户
     *
     * @param Request $request
     * @return Json
     */
    public function delete($request)
    {
    }
}
