<?php

namespace App\Http\Controllers\System;

use App\Campaign;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class CampaignController extends Controller
{
    public function index()
    {
        return view('system/campaign.index');
    }

    public function add_edit($id = null)
    {
        return view('system/campaign.add_edit',compact('id'));
    }

    function get_data(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'description',
            3 => 'id',
        );

        $totalData = Campaign::count();
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        $search = $request->input('search.value');

        $posts = Campaign::
        Where('name', 'LIKE', "%{$search}%")
            ->offset($start)
            ->limit($limit)
            ->orderBy('id', 'desc')
            ->orderBy($order, $dir)
            ->get();

        if ($search != null) {
            $totalFiltered = Campaign::
            Where('name', 'LIKE', "%{$search}%")
                ->count();
        }


        $data = array();
        if (!empty($posts)) {
            foreach ($posts as $post) {

                $edit = route('campaign.add_edit', ['id' => $post->id]);
                $nestedData['id'] = $post->id;
                $nestedData['name'] = $post->name;
                $nestedData['description'] = $post->description;
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
        $Post = Campaign::where('id', '=', $id)->first();
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
        $Post = Campaign::where('id', '=', $id)->first();
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
                $Post = Campaign::where('id', '=', Input::get('id'))->first();
                $Post->name = Input::get('name');
                $Post->description = Input::get('description');
                $Post->update();
                return response()->json(['success' => 'Create', 'dashboard' => '1', 'redirect' => route('campaign.index')]);
            } else {
                $Post = new Campaign();
                $Post->name = Input::get('name');
                $Post->description = Input::get('description');
                $Post->save();
                return response()->json(['success' => 'Update', 'dashboard' => '1', 'redirect' => route('campaign.index')]);
            }
        }
    }

    private function rules()
    {
        $x = [
            'name' => 'required|string|min:1|max:191',
            'description' => 'required|string|min:1|max:191',
        ];
        return $x;
    }

}
