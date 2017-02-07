<?php

use Illuminate\Database\Capsule\Manager as DB;

class AdminController extends BaseController
{

    const SESSION_SALT = '1q2w3e-pos-bestdo';

    public function indexAction(){

        $session = $_SESSION;

        $sid = isset($session['id']) ? $session['id'] : '';

        if(empty($sid))
            $this->xredirect('/admin/login');

    }

    public function loginAction(){

        $req = $this->getRequest()->getPost();
        if(!empty($req)){
            $user = isset($req['set']) ? $req['set'] : [];
            if(empty($user))
                return $this->xdisplay('admin/login.phtml');

            $username = isset($user['username']) ? $user['username'] : '';
            $password = isset($user['password']) ? $user['password'] : '';
            $remember = isset($user['remember']) ? $user['remember'] : 0;

            $staff = new StaffEloquentModel();
            $staff->username = $username;
            $staff->password = $password;

            $res = $staff->login();
            if($res){
                setSession('id', $res['sid']);
                setSession('name', $res['username']);

                $this->xredirect("/admin/index");
            }

        }




    }

    public function mainAction(){
//        $sites = DB::connection('wis')
//            ->table('site')
//            ->select('ID','SITE_NAME','CREATE_DATE')
//            ->orderBy('CREATE_DATE', 'desc')
//            ->limit(15)
//            ->get();
//        dj($sites);
    }

    public function commonAction(){

//        echo VIEW_PATH . 'common/success.phtml';
//
//        return false;
        $this->error('hello-world', '/pos/list', 5);
        return false;
    }
}
