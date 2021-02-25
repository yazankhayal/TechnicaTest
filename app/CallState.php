<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CallState extends Model
{
    public $table = "call_stats";

    public $fillable = ['id','recording_url',
        'length',
        'created_at','updated_at'];

    public $dates = ['created_at','updated_at'];
    public $primaryKey = 'id';

}
