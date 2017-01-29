@foreach($object->knownBy as $oPlayer)
    @if(!$loop->last)
        <span><a href="{{ url('user/' . $oPlayer->id) }}">{{ $oPlayer->name }},</a></span>
    @else
        <span><a href="{{ url('user/' . $oPlayer->id) }}">{{ $oPlayer->name }}</a></span>
    @endif
@endforeach