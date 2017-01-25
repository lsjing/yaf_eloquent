<?php

use Illuminate\Database\Capsule\Manager as DB;

class AdminController extends AbstractController
{
    public function indexAction(){
        echo time();
    }
}
