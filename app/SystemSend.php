<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SystemSend extends Model
{
    public $table = "system_send";

    public $fillable = ['id','call_stats_id',
        'user_id',
        'query_type_id','campaign_id',
        'created_at','updated_at'];

    public $dates = ['created_at','updated_at'];
    public $primaryKey = 'id';

    public function Campaign(){
        return $this->belongsTo(Campaign::class,"campaign_id","id");
    }

    public function CallState(){
        return $this->belongsTo(CallState::class,"call_stats_id","id");
    }

    public function QueryType(){
        return $this->belongsTo(QueryType::class,"query_type_id","id");
    }

}
