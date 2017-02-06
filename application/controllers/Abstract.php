<?php

/**
 * Class AbstractController
 */
abstract class AbstractController extends Yaf_Controller_Abstract
{

    /**
     * 登录、权限判断、初始化
     */
    public function init()
    {

        header("Content-Type:text/html;charset=utf-8");
        session_start();

        $controllerName = strtolower($this->getRequest()->getControllerName());
        $actionName = strtolower($this->getRequest()->getActionName());

        if(!($controllerName == 'admin' && $actionName == 'login')){

            $sid = isset($_SESSION['id']) ? $_SESSION['id'] : '';

            if(empty($sid))
                $this->xredirect('/admin/login');
        }

    }

}
