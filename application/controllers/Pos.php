<?php

use Illuminate\Database\Capsule\Manager as DB;

class PosController extends BaseController
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
//                ->limit(15)
                ->get();

            $redis->set($key, json_encode($sites), 6);
        }

        $req = $this->getRequest()->getPost();
        if(!empty($req)){
            //


        }




        $this->getView()->assign('sites', $sites);
    }

    public function exportlistAction(){

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


    public function ListAction(){

        $get = $this->getRequest()->getQuery();
        $page = isset($get['page']) ? intval($get['page']) : 1;
        $pagesize = isset($get['pagesize']) ? intval($get['pagesize']) : PAGESIZE;
        $k = isset($get['k']) ? trim($get['k']) : '';
        $v = isset($get['v']) ? trim($get['v']) : '';


        $poses = DB::table('res_pos');

        if($v != '')
            $poses = $poses->where($k, 'like', '%'.strtoupper($v).'%');

        $poses = $poses
            ->where('archived', 1)
            ->orderBy('create_time', 'desc')
            ->limit($pagesize)
            ->offset(($page-1)*$pagesize)
            ->get();

        $total = DB::table('res_pos');

        if($v != '')
            $total = $total->where($k, 'like', '%'.$v.'%');

        $total = $total->where('archived',1)
            ->count();

        $this->getView()->assign([
            'poses'     =>  $poses,
            'page'      =>  $page,
            'pagesize'  =>  $pagesize,
            'total'     =>  $total,
            'k'         =>  $k,
            'v'         =>  $v
        ]);
    }

    public function AddAction(){
        $req = $this->getRequest()->getPost();
        if(!empty($req)){
            $pos = new PosEloquentModel();
            $pos->code_device_info = strtoupper($req['code_device_info']);
            $pos->cashier_device_info = $req['cashier_device_info'];
            $pos->fg_card_no = $req['fg_card_no'];
            $pos->function = $req['function'];
            $pos->version = $req['version'];
            try {
                if ($pos->save())
                    $this->success('新增POS机成功', '/pos/list');
//                    $this->xredirect('/pos/list');
                else
                    $this->error('新增POS机失败');

            }catch(Exception $e){
                $this->error('新增POS机失败,'.$e->getMessage(),'',5);
                return false;
            }


        }
    }

    public function AjaxGetPosSiteAction(){
        $req = $this->getRequest()->getPost();
        $xhr = $this->getRequest()->isXmlHttpRequest();

        $sites = [];

        if(!empty($req) && $xhr){
            $sites = DB::connection('wis')
                ->table('site')
                ->select('ID','SITE_NAME','CREATE_DATE')
                ->where('SITE_NAME', 'like', '%'.$req['q'].'%')
                ->orderBy('CREATE_DATE', 'desc')
                ->limit(10)
                ->get();
        }

        echo json_encode($sites);

//        echo json_encode(array_merge([
//            'name'=>'xuef',
//            'age'=>28
//        ],$req));

        return false;

        if(!empty($req)){

        }
    }
}