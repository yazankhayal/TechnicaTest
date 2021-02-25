@extends('layouts.app')

@section('title')
    Query type
@endsection

@section('content')

    <form class="ajaxForm users" enctype="multipart/form-data" data-name="users"
          action="{{route('system_send.post_data')}}" method="post">
        {{csrf_field()}}
        <div class="modal-header">
            <h5 class="modal-title title_info"></h5>
        </div>
        <div class="modal-body row">
            <input id="id" name="id" class="cls" type="hidden">
            <div class="form-group col-6">
                <label for="call_stats_id">CallState</label>
                <select type="text" class="cls form-control" name="call_stats_id" id="call_stats_id">
                    @foreach($call_stats as $r)
                        <option value="{{$r->id}}">{{$r->length}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-6">
                <label for="campaign_id">Campaign</label>
                <select type="text" class="cls form-control" name="campaign_id" id="campaign_id">
                    @foreach($campaign as $r)
                        <option value="{{$r->id}}">{{$r->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-6">
                <label for="query_type_id">Query Type</label>
                <select type="text" class="cls form-control" name="query_type_id" id="query_type_id">
                    @foreach($query_type as $r)
                        <option value="{{$r->id}}">{{$r->title}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-load">
                Submit
            </button>
        </div>
    </form>

@endsection

