@extends('layouts.app')

@section('title')
    Campaign
@endsection

@section('content')

    <form class="ajaxForm users" enctype="multipart/form-data" data-name="users"
          action="{{route('campaign.post_data')}}" method="post">
        {{csrf_field()}}
        <div class="modal-header">
            <h5 class="modal-title title_info"></h5>
        </div>
        <div class="modal-body row">
            <input id="id" name="id" class="cls" type="hidden">
            <div class="form-group col-12">
                <label for="name">name</label>
                <input type="text" class="cls form-control" name="name" id="name" placeholder="name">
            </div>
            <div class="form-group col-12">
                <label for="description">description</label>
                <input type="text" class="cls form-control" name="description" id="description" placeholder="description">
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
                last_part = parts[parts.name - 1];

            var name_form = $('.ajaxForm').data('name');

            if (isNaN("{{$id}}") == false) {
                if ("{{$id}}" != null) {
                    Render_Data("{{$id}}");
                }
            }

        });

        var Render_Data = function (id) {
            $.ajax({
                url: "{{route('campaign.get_data_by_id')}}",
                method: "get",
                data: {
                    "id": id,
                },
                dataType: "json",
                success: function (result) {
                    if (result.success != null) {
                        $('#id').val(result.success.id);
                        $('#description').val(result.success.description);
                        $('#name').val(result.success.name);
                    }
                }
            });
        };

    </script>
@endsection
