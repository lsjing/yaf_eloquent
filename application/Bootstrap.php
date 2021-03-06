<?php

use Illuminate\Database\Capsule\Manager as Capsule;

class Bootstrap extends Yaf_Bootstrap_Abstract
{

    public function _initLoader()
    {
        set_error_handler(
            create_function(
                '$severity, $message, $file, $line',
                'throw new ErrorException($message, $severity, $severity, $file, $line);'
            )
        );

        register_shutdown_function(array($this, 'cleanup'));

        Yaf_Loader::import(APP_PATH . "/vendor/autoload.php");
        Yaf_Loader::import(APP_PATH . "/application/function.php");
        Yaf_Loader::import(APP_PATH . "/application/global.inc.php");

        // 注册本地类名前缀, 这部分类名将会在本地类库查找
        Yaf_Loader::getInstance()->registerLocalNameSpace(array('Log', 'Cache', 'Upload', 'Http', 'Util'));
    }

    public function _initConfig()
    {
        $config = Yaf_Application::app()->getConfig();
        Yaf_Registry::set('config', $config);
    }

    public function _initDefaultName(Yaf_Dispatcher $dispatcher)
    {
        $dispatcher->setDefaultModule('Index')->setDefaultController('Admin')->setDefaultAction('index');
    }

    public function _initDatabaseEloquent()
    {
        $capsule = new Capsule;

        // 创建默认链接
        $capsule->addConnection(Yaf_Application::app()->getConfig()->database->toArray());

        // biz业务链接
         $capsule->addConnection(Yaf_Application::app()->getConfig()->wis->toArray(), 'wis');

        // 设置全局静态可访问
        $capsule->setAsGlobal();

        // 启动Eloquent
        $capsule->bootEloquent();

//         define('DT', 'dt');
         $capsule::connection('wis')->enableQueryLog();

    }

    public function _initRoute(Yaf_Dispatcher $dispatcher)
    {
        $router = $dispatcher->getRouter();
        $router->addRoute('404', new Yaf_Route_Rewrite(
            '/404$',
            array(
                'controller'    => 'Public',
                'action'        => 'unknow'
            )
        ));
    }

    public function _initSession()
    {
        try {
            $redis = redisConnect();
            $redis->ping();
            $session = new Util_Session();
            session_set_save_handler($session, true);
        } catch (Exception $e) {
            Log_Log::info('[Bootstrap] session init error:' . $e->getMessage(), true, true);
        }
    }

    public function cleanup()
    {

        restore_error_handler();

        // 定义了开关，便关闭log
        if (!defined('SHUTDOWN')) {
            Log_Log::info('receive:' . var_export($_REQUEST, true), true, true);

            // DEFAULT
            $this->log(Capsule::getQueryLog(), 'DEFAULT');

            // 业务库相关SQL
            if (defined('BIZ'))
                $this->log(Capsule::connection(BIZ)->getQueryLog(), 'BIZ');
        }

    }

    /**
     * @param $info
     * @param $link
     */
    public function log($info, $link)
    {
        foreach ($info as $val) {
            Log_Log::info('[' . $link . ' query] ' . $val['query'] . ' [bindings] ' . implode(' ', $val['bindings']) . ' [time] ' . $val['time'], 1, 1);
        }
    }
}