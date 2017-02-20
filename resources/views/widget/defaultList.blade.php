<table class="user-table">
    <tr>
        <th>{{ trans('general.name') }}</th>
        <th>{{ trans('general.description') }}</th>
    </tr>
    @if( count($aObjects) != 0 )
        @foreach($aObjects as $oObject)
            <tr>
                <td><a href="{{ url($sTarget . '/' . $oObject->url) }}">{{ $oObject->name }}</a></td>
                <td>{{ $oObject->shortDescription }}</td>
            </tr>
        @endforeach
    @else
        <tr>
            <td>-</td>
            <td>-</td>
        </tr>
    @endif
</table>