<?php

use Illuminate\Database\Capsule\Manager as DB;

class CycleEloquentModel extends EloquentModel
{
    protected $table = 'res_cycle';
    protected $primaryKey = 'id';
}
