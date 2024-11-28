<?php

namespace App;
use Illuminate\Database\Eloquent\Model as EloquentModel;
abstract  class Model extends EloquentModel
{
    protected DB $db;
    public function __construct()
    {
        $this->db = App::DB();
    }
}