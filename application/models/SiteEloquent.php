<?php

use Illuminate\Database\Capsule\Manager as DB;

class SiteEloquentModel extends EloquentModel
{
    protected $connection = 'dt';
    protected $table = 'site';
}
