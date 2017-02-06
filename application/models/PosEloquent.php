<?php

use Illuminate\Database\Capsule\Manager as DB;

class PosEloquentModel extends EloquentModel
{
    protected $table = 'res_pos';
    protected $primaryKey = 'pos_id';
}
