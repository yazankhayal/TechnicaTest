<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QueryType extends Model
{
    public $table = "query_type";

    public $fillable = ['id','title',
        'created_at','updated_at'];

    public $dates = ['created_at','updated_at'];
    public $primaryKey = 'id';

}
