<?php

namespace App\Http\Controllers;

use App\SystemSend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $system_send = new SystemSend();

        if(Auth::user()->role == 2){

        }
        else if(Auth::user()->role == 3){
            $system_send = $system_send->whereHas("Campaign",function ($q){
                $q->where("name","not like","%"."Campaign B"."%");
            });
        }
        else if(Auth::user()->role == 4){

        }
        else if(Auth::user()->role == 5){
            $system_send = $system_send->whereHas("QueryType",function ($q){
                $q->where("title","like","%"."SALE MADE"."%");
            });
        }

        $system_send = $system_send->get();

        return view('home',compact('system_send'));
    }

    public function json($id){
        $item = SystemSend::where("id",$id)
            ->with("Campaign")
            ->with("CallState")
            ->with("QueryType")
            ->first();
        if($item == null){
            return response()->json(['error']);
        }
        return response()->json([$item]);
    }

}
