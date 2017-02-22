@if(count($oObject->tags))
    @foreach($oObject->tags as $oTag)
        <span class="label label-default">{{ $oTag->name }}</span>
    @endforeach
@else
    <span>-</span>
@endif