<table class="user-table">
    <tr>
        <th>{{ trans('general.name') }}</th>
        <th>{{ trans('general.description') }}</th>
    </tr>

    @if(count($oLandscape->largeCities()) > 0)
        @foreach($aLargeCities as $oLargeCity)

            <tr>
                <td>
                    <a href="{{ url('large-city/' . $oLargeCity->id) }}">{{ $oLargeCity->name }}</a>
                </td>
                <td>
                    {{ $oLargeCity->shortDescription }}
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