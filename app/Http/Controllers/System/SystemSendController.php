<?php

namespace App\Http\Controllers\System;

use App\CallState;
use App\Campaign;
use App\QueryType;
use App\SystemSend;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class SystemSendController extends Controller
{
    public function index()
    {
        $call_stats = CallState::get();
        $campaign = Campaign::get();
        $query_type = QueryType::get();
        return view('system/system_send.index',compact('call_stats','campaign','query_type'));
    }


    public function post_data(Request $request)
    {
        $validation = Validator::make($request->all(), $this->rules());
        if ($validation->fails()) {
            return response()->json(['errors' => $validation->errors()]);
        } else {
            $Post = new SystemSend();
            $Post->campaign_id = Input::get('campaign_id');
            $Post->query_type_id = Input::get('query_type_id');
            $Post->call_stats_id = Input::get('call_stats_id');
            $Post->save();
            return response()->json(['success' => 'Create', 'dashboard' => '1']);
        }
    }

    private function rules()
    {
        $x = [
            'call_stats_id' => 'required|numeric|min:1',
            'query_type_id' => 'required|numeric|min:1',
            'campaign_id' => 'required|numeric|min:1',
        ];
        return $x;
    }

}
