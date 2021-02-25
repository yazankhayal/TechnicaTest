@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        You are logged in!
                    </div>
                </div>
            </div>
        </div>

        <div class="row" style="margin-top: 30px;">
            @if(\Illuminate\Support\Facades\Auth::user()->role != "1")
                @foreach($system_send as $r)
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">{{$r->Campaign->name}}</div>

                            <div class="card-body">
                                <a target="_blank" href="{{route('json',['id'=>$r->id])}}">
                                    Json
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

    </div>
@endsection
