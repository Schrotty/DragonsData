<table class="user-table">
    <tr>
        <th>{{ trans('general.name') }}</th>
        <th>{{ trans('general.description') }}</th>
    </tr>

    @if(count($oLandscape->mediumCities()) > 0)
        @foreach($aMediumCities as $oMediumCity)



            <tr>
                <td>
                    <a href="{{ url('mediumCity/' . $oMediumCity->id) }}">{{ $oMediumCity->name }}</a>
                </td>
                <td>
                    {{ $oMediumCity->shortDescription }}
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