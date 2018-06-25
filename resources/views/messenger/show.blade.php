@extends('layouts.app')

@section('content')
    
<div class="row">
    <div class="col-md-12">
        <div class="chat-panel panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-comments fa-fw"></i>
                    {{ $thread->subject }}
            </div>
            <div class="panel-body">
                <ul class="chat">
                    @each('messenger.partials.messages', $thread->messages, 'message')
                </ul>
            </div>
            <div class="panel-footer">
                @include('messenger.partials.form-message')
            </div>
        </div>
    </div>
</div>
    
@stop
