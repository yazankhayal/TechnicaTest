@extends('layouts.app')

@section('title')
    Campaign
@endsection

@section('content')

    <a class="btn btn-primary" href="{{route('campaign.add_edit')}}">
        Create new
    </a>
    <hr>
    <table class="table data_Table table-bordered" id="data_Table">
        <thead>
        <th>#</th>
        <th>name</th>
        <th>description</th>
        <th>Option</th>
        </thead>
    </table>

@endsection


@section('js')
    <script type="text/javascript">
        $(document).ready(function() {

            var datatabe ;

            "use strict";
            //Code here.
            Render_Data();

            var name_form = $('.ajaxForm').data('name');

            $(document).on('click', '.btn_delete_current', function () {
                var id = $(this).data("id");
                $('#ModDelete').modal('show');
                $('#iddel').val(id);
                if(id){
                    $('#data_Table tbody tr').css('background','transparent');
                    $('#data_Table tbody #' + id).css('background','hsla(64, 100%, 50%, 0.36)');
                }
            });

            $('.btn_deleted').on("click",function () {
                var id = $('#iddel').val();
                $.ajax({
                    url:"{{ route('campaign.deleted') }}",
                    method:"get",
                    data : {
                        "id" : id,
                    },
                    dataType:"json",
                    success:function(result)
                    {
                        toastr.error(result.error);
                        $('.modal').modal('hide');
                        $('#data_Table').DataTable().ajax.reload();
                    }
                });
            });

        });

        var Render_Data = function () {
            datatabe = $('#data_Table').DataTable({
                "processing": true,
                "serverSide": true,
                "bStateSave": true,
                "fnCreatedRow": function( nRow, aData, iDataIndex ) {
                    $(nRow).attr('id', aData['id']);
                },
                "ajax":{
                    "url": "{{ route('campaign.get_data') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data":{
                        _token: "{{csrf_token()}}",
                        'filter_role' : $('#filter_role').val(),
                    }
                },
                "columns": [
                    { "data": "id" },
                    { "data": "name" },
                    { "data": "description" },
                    { "data": "options" }
                ]
            });
        };

    </script>


@endsection
