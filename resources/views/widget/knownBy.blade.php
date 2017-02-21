@if(!$oObject->isUnknown())
    @foreach($oObject->knownBy as $oPlayer)
        @if(!$loop->last)
            <span><a href="{{ url('user/' . $oPlayer->url) }}">{{ $oPlayer->name }},</a></span>
        @else
            <span><a href="{{ url('user/' . $oPlayer->url) }}">{{ $oPlayer->name }}</a></span>
        @endif
    @endforeach
@else
    <span>-</span>
@endif