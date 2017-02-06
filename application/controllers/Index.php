<?php

use Illuminate\Database\Capsule\Manager as DB;

class IndexController extends BaseController
{

    // 默认Action
    public function indexAction()
    {
//        $this->xdisplay('index/index.phtml', ['content'=>'hello xuef']);
//        $user = DB::table('staff_log')->where('sid', '37')->get();
//        dj($user);

//        $data = DB::table('resource')->where('parent', '910')->get();
//        dj($data);

        //$data = DB::table('role')->where('role_id', '40')->get();
        //dj($data);

//        $data = DB::table('staff')->where('username', 'admin')->get();
//        dj($data);


//        $data = DB::table('role_staff')->where('role_id', '40')->get();
//        dj($data);

//        $data = DB::table('role_resource')->where('role_id', '40')->get();
//        dj($data);



//        DB::table('staff_log')->chunk(3, function($logs)
//        {
//
//            foreach ($logs as $log)
//            {
//                    $data = unserialize($log['request_data']);
//                    print_r($data);
////                echo $user['username'];
//            }
//            return false;
//        });

//        $name = DB::table('users')->lists('username', 'email');
//        print_r($name);

//        $users = DB::table('users')->select('username as name', 'email')->get();
//        print_r($users);

//        $admin = DB::table('users')
//                ->whereIdAndEmail(2, 'john@doe.com')
//                ->first();
//        print_r($admin);

//        try {
//            DB::beginTransaction();
//            $users = DB::table('users')
//                        ->select('username as name', 'email')
//                        ->where('username', 'molaifeng')
//                        ->orwhere('username', 'overtrue')
//                        ->get();
//            DB::commit();
//            //echo print_r(DB::getQueryLog(), 1);
//        } catch (Exception $e) {
//            echo $e->getMessage();
//        }
//
//
//        exit;


//        DB::table('users')->insert([
//            array('username' => 'molaifeng1',  'email' => 'molaifeng1@foxmail.com')
//        ]);

//        $test = new UserModel();
//        $data = $test->getInfo();
//        print_r($data);
//exit;
//        $this->getView()->assign("content", "Hello World");
        //$this->getView()->display('layout/index.html');
        return false;
    }

}
