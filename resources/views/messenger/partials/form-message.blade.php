<form action="{{ route('messages.update', $thread->id) }}" method="post">
    {{ method_field('put') }}
    {{ csrf_field() }}
        
    @if($users->count() > 0)
        <div class="input-group">
            <div class="checkbox">
                @foreach($users as $user)
                    <label title="{{ $user->name }}">
                        <input type="checkbox" name="recipients[]" value="{{ $user->id }}">{{ $user->name }}
                    </label>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Message Form Input -->
    <div class="input-group">
        <input id="btn-input" name="message" class="form-control input-sm" placeholder="Escribe tu mensaje aqui..." value="{{ old('message') }}">
        <span class="input-group-btn">
            <button id="btn-chat" type="submit" class="btn btn-warning btn-sm">Enviar</button>
        </span>
    </div>
</form>