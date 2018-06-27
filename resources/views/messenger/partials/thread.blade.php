<?php $class = $thread->isUnread(Auth::id()) ? 'alert-info' : ''; ?>

<div class="media alert {{ $class }}">
    <h4 class="media-heading">
        <a href="{{ route('messages.show', $thread->id) }}">{{ $thread->subject }}</a>
        ({{ $thread->userUnreadMessagesCount(Auth::id()) }} sin leer)
    </h4>
    <p>
        {{ $thread->latestMessage->body }}
    </p>
    <p>
        <small><strong>Autor:</strong> {{ $thread->creator()->name }}</small>
    </p>
    <p>
        <small><strong>Participantes:</strong> {{ $thread->participantsString(Auth::id()) }}</small>
    </p>
</div>