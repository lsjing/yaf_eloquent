<?php

use Illuminate\Database\Capsule\Manager as DB;

class ExportEloquentModel extends EloquentModel
{
    protected $table = 'res_export';
    protected $primaryKey = 'id';
}
