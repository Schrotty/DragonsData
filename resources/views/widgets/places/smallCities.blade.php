<table class="user-table">
    <tr>
        <th>{{ trans('general.name') }}</th>
        <th>{{ trans('general.description') }}</th>
    </tr>

    @if(count($oLandscape->smallCities()) > 0)
        @foreach($aSmallCities as $oSmallCity)

            <tr>
                <td>
                    <a href="{{ url('small-city/' . $oSmallCity->id) }}">{{ $oSmallCity->name }}</a>
                </td>
                <td>
                    {{ $oSmallCity->shortDescription }}
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