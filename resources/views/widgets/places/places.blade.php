<table class="user-table">
    <tr>
        <th>{{ trans('general.name') }}</th>
        <th>{{ trans('general.description') }}</th>
    </tr>

    @if(count($oLandscape->places()) > 0)
        @foreach($aPlaces as $oPlace)

            <tr>
                <td>
                    <a href="{{ url('place/' . $oPlace->id) }}">{{ $oPlace->name }}</a>
                </td>
                <td>
                    {{ $oPlace->shortDescription }}
                </td>
            </tr>

        @endforeach
    @else
        <tr>
            <td>-</td>
            <td>-</td>
        </tr>
    @endif
</table>