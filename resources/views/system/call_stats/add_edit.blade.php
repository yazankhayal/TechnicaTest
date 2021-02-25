@extends('layouts.app')

@section('title')
    Call
@endsection

@section('content')

    <form class="ajaxForm users" enctype="multipart/form-data" data-name="users"
          action="{{route('call_stats.post_data')}}" method="post">
        {{csrf_field()}}
        <div class="modal-header">
            <h5 class="modal-title title_info"></h5>
        </div>
        <div class="modal-body row">
            <input id="id" name="id" class="cls" type="hidden">
            <div class="form-group col-12">
                <label for="length">length</label>
                <input type="text" class="cls form-control" name="length" id="length" placeholder="length">
            </div>
            <div class="form-group col-12">
                <label for="recording_url">recording_url</label>
                <input type="text" class="cls form-control" name="recording_url" id="recording_url" placeholder="recording_url">
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-load">
                Submit
            </button>
        </div>
    </form>

@endsection


@section('js')
    <script type="text/javascript">
        $(document).ready(function () {

            "use strict";
            //Code here.

            var url = $(location).attr('href'),
                parts = url.split("/"),
                last_part = parts[parts.length - 1];

            var name_form = $('.ajaxForm').data('name');

            if (isNaN(last_part) == false) {
                if (last_part != null) {
                    Render_Data(last_part);
                }
            }

        });

        var Render_Data = function (id) {
            $.ajax({
                url: "{{route('call_stats.get_data_by_id')}}",
                method: "get",
                data: {
                    "id": id,
                },
                dataType: "json",
                success: function (result) {
                    if (result.success != null) {
                        $('#id').val(result.success.id);
                        $('#recording_url').val(result.success.recording_url);
                        $('#length').val(result.success.length);
                    } else {
                        toastr.error('Error');
                        window.location.href = "{{route('call_stats.index')}}";
                    }
                }
            });
        };

    </script>
@endsection
