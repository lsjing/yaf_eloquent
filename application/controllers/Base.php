<?php

use Illuminate\Database\Capsule\Manager as DB;

class BaseController extends AbstractController
{
    /**
     * 成功提示
     *
     * @param string $msg 提示信息
     * @param string $url 跳转URL
     * @param integer $delay 跳转URL延时
     *
     */
    public function success($msg, $url = '', $delay = 3){
        //var_dump($url);
        if($url == '') {
            $url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
        } else{
            $url = url::make($url);
        }
        //var_dump($url);exit;
        $params = array();
        $params['msg'] = $msg;
        $params['delay'] = $delay*1000;
        $params['url'] = $url;
        return $this->display('layouts/mgr/success', $params);
    }

    /**
     * 错误提示
     *
     * @param string $msg 提示信息
     * @param string $url 跳转URL
     * @param integer $delay 跳转URL延时
     *
     */
    public function error($msg, $url = '', $delay = 3){
        if($url != '') {
            $url = '/';
        }
        $params = array();
        $params['msg'] = $msg;
        $params['delay'] = $delay*1000;
        $params['url'] = $url;

        return $this->display('layouts/mgr/error', $params);
    }

    public function xdisplay($tpl, $params=[]){
//        $ext = getConfig('application', 'view');
//        if(empty($ext))
//            $ext = 'phtml';
//        else
//            $ext = $ext['ext'];
//
//        if(strpos($tpl, $ext) == -1){
//
//        }

        if(!empty($params)){
            foreach ($params as $k=>$v)
                $this->getView()->assign($k, $v);

        }

        $this->getView()->display($tpl);
        return;
    }
}