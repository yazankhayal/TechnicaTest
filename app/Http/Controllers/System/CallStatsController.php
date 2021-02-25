<?php

namespace App\Http\Controllers\System;

use App\CallState;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class CallStatsController extends Controller
{
    public function index()
    {
        return view('system/call_stats.index');
    }

    public function add_edit()
    {
        return view('system/call_stats.add_edit');
    }

    function get_data(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'length',
            2 => 'recording_url',
            3 => 'id',
        );

        $totalData = CallState::count();
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $search = $request->input('search.value');

        $posts = CallState::
        Where('length', 'LIKE', "%{$search}%")
            ->offset($start)
            ->limit($limit)
            ->orderBy('id', 'desc')
            ->orderBy($order, $dir)
            ->get();

        if ($search != null) {
            $totalFiltered = CallState::
            Where('length', 'LIKE', "%{$search}%")
                ->count();
        }


        $data = array();
        if (!empty($posts)) {
            foreach ($posts as $post) {

                $edit = route('call_stats.add_edit', ['id' => $post->id]);
                $nestedData['id'] = $post->id;
                $nestedData['length'] = $post->length;
                $nestedData['recording_url'] = $post->recording_url;
                $nestedData['options'] = "&emsp;<a class='btn btn-success btn-sm' href='{$edit}' title='Edit' >Edit</a>";
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );
        echo json_encode($json_data);
    }

    function get_data_by_id(Request $request)
    {
        $id = $request->id;
        if ($id == null) {
            return response()->json(['error' => 'Error']);
        }
        $Post = CallState::where('id', '=', $id)->first();
        if ($Post == null) {
            return response()->json(['error' => 'Error']);
        }
        return response()->json(['success' => $Post]);
    }

    function deleted(Request $request)
    {
        $id = $request->id;
        if ($id == null) {
            return response()->json(['error' => 'Error']);
        }
        $Post = CallState::where('id', '=', $id)->first();
        if ($Post == null) {
            return response()->json(['error' => 'Error']);
        }
        $Post->delete();
        return response()->json(['error' => 'Delete']);
    }

    public function post_data(Request $request)
    {
        $edit = $request->id;
        $validation = Validator::make($request->all(), $this->rules());
        if ($validation->fails()) {
            return response()->json(['errors' => $validation->errors()]);
        } else {
            if ($edit != null) {
                $Post = CallState::where('id', '=', Input::get('id'))->first();
                $Post->length = Input::get('length');
                $Post->recording_url = Input::get('recording_url');
                $Post->update();
                return response()->json(['success' => 'Create', 'dashboard' => '1', 'redirect' => route('call_stats.index')]);
            } else {
                $Post = new CallState();
                $Post->length = Input::get('length');
                $Post->recording_url = Input::get('recording_url');
                $Post->save();
                return response()->json(['success' => 'Update', 'dashboard' => '1', 'redirect' => route('call_stats.index')]);
            }
        }
    }

    private function rules()
    {
        $x = [
            'length' => 'required|string|min:1|max:191',
            'recording_url' => 'required|string|min:1|max:191',
        ];
        return $x;
    }

}
