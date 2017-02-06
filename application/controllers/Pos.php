<?php

use Illuminate\Database\Capsule\Manager as DB;

class PosController extends BaseController
//class PosController extends AbstractController
{

    // 默认Action
    public function ExportAction()
    {

        $key = cacheKeyMapper('site_info', 'all_sites');
        $redis = redisConnect();

        $sites = $redis->get($key, false);

        if(!$sites){
            $sites = DB::connection('wis')
                ->table('site')
                ->select('ID','SITE_NAME','CREATE_DATE')
                ->orderBy('CREATE_DATE', 'desc')
                ->limit(15)
                ->get();

            $redis->set($key, json_encode($sites), 6);
        }

        $this->getView()->assign('sites', $sites);
    }

    public function ListAction(){

        $get = $this->getRequest()->getQuery();
        $page = isset($get['page']) ? intval($get['page']) : 1;
        $pagesize = isset($get['pagesize']) ? intval($get['pagesize']) : PAGESIZE;

        $poses = DB::table('res_pos')
            ->orderBy('create_time', 'desc')
            ->limit($pagesize)
            ->offset(($page-1)*$pagesize)
            ->get();

        $total = DB::table('res_pos')
            ->where('archived',1)
            ->count();

        $this->getView()->assign([
            'poses' => $poses,
            'page' => $page,
            'pagesize' => $pagesize,
            'total' => $total
        ]);



    }
}