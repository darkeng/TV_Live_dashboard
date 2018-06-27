
@if (Auth::user()->name === $message->user->name)
    <li class="right clearfix">
        <span class="chat-img pull-right">
            <img src="http://placehold.it/50/FA6F57/fff" alt="User Avatar" class="img-circle">
        </span>
        <div class="chat-body clearfix pull-right">
            <div class="header">
                <strong class="primary-font">Tu </strong>
                <small class="text-muted">
                    <i class="fa fa-clock-o fa-fw"></i>{{ $message->created_at->diffForHumans() }}
                </small>
            </div>
            <p>
                {{ $message->body }}
            </p>
        </div>
    </li>
@else
    <li class="left clearfix">
        <span class="chat-img pull-left">
            <img src="http://placehold.it/50/55C1E7/fff" alt="User Avatar" class="img-circle">
        </span>
        <div class="chat-body clearfix pull-left">
            <div class="header">
                <strong class="primary-font">{{ $message->user->name }} </strong>
                <small class="text-muted">
                    <i class="fa fa-clock-o fa-fw"></i>{{ $message->created_at->diffForHumans() }}
                </small>
            </div>
            <p>
                {{ $message->body }}
            </p>
        </div>
    </li>
@endif