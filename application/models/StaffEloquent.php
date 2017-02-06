<?php

use Illuminate\Database\Capsule\Manager as DB;

class StaffEloquentModel extends EloquentModel
{
    protected $table = 'staff';

    public function login(){
        $user = DB::table('staff')->where('username', $this->username)->first();

        if($user['password'] !== md5($this->password))
            return false;

        return $user;
    }
}
