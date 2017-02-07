<?php

use Illuminate\Database\Capsule\Manager as DB;

class PosSiteEloquentModel extends EloquentModel
{
    protected $table = 'res_pos_site';
    protected $primaryKey = 'id';
}
