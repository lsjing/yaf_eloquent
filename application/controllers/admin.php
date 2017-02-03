<?php

use Illuminate\Database\Capsule\Manager as DB;

class AdminController extends BaseController
{
    public function indexAction(){
        echo time();
    }

    public function loginAction(){
        $ext = getConfig('application', 'view');

//exit;
        $req = $this->getRequest()->getPost();
        if(!empty($req)){
            $user = isset($req['set']) ? $req['set'] : [];
            if(empty($user))
                return $this->xdisplay('admin/login.phtml');

            $username = isset($user['username']) ? $user['username'] : '';
            $password = isset($user['password']) ? $user['password'] : '';
            $remember = isset($user['remember']) ? $user['remember'] : 0;
            if($username == '')
                $msg['username'] = '用户名不能为空';

            if($password == '')
                $msg['password'] = '密码不能为空';

            $params['user'] = $user;
            if(!empty($msg)) {
                $params['msg'] = $msg;
                $this->assign($params);
                return;
            }


            $staff = new StaffEloquentModel();
            $staff->username = $username;
            $staff->password = $password;

            $res = $staff->login();
            if(!$res)
                $this->getView()->display('admin/login.phtml');


//            $result = Webapi_Staff::instance()->login($username, $password, $remember);
//            $url = !empty($_GET['url']) ? urldecode($_GET['url']) : '/admin/index';
//            $url = rtrim(HOME_URL, '/').$url;
//
//            if($result) {
//                Log::instance()->addUri('admin/login');
//                Log::instance()->addResName('系统登录');
//                $params = array();
//                $params['msg'] = '登录成功';
//                $params['delay'] = 1000;
//                $params['url'] = $url;
//                return $this->display('layouts/mgr/success', $params);
//            } else {
//                return $this->error('登录失败');
//            }
        }







        //$this->getView()->display('admin/login.phtml');
    }
}
