@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Informaci&oacute;n General</h1>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
    </div>
</div>
<div class="row">
    <div class="col-lg-3 col-md-6">
        @include('dashboard.partials.panel-info', ['values' => ['color'=> 'primary' , 'icon' => 'fa-user', 'count' => $data['total_online_users'] , 'message' => 'Online Users']
        ])
    </div>
    <div class="col-lg-3 col-md-6">
        @include('dashboard.partials.panel-info', ['values' => ['color'=> 'green' , 'icon' => 'fa-connectdevelop', 'count' => $data['live_connections'] , 'message' => 'Open Connections']
        ])
    </div>
    <div class="col-lg-3 col-md-6">
        @include('dashboard.partials.panel-info', ['values' => ['color'=> 'yellow' , 'icon' => 'fa-upload', 'count' => round($data['total_output']).'Mb' , 'message' => 'Average Output']
        ])
    </div>
    <div class="col-lg-3 col-md-6">
        @include('dashboard.partials.panel-info', ['values' => ['color'=> 'red' , 'icon' => 'fa-users', 'count' => $data['total_active'] , 'message' => 'Active Subscriptions']
        ])
    </div>
</div>
@endsection
