<table class="user-table">
    <tr>
        <th>{{ trans('general.name') }}</th>
        <th>{{ trans('general.description') }}</th>
    </tr>

    @if(count($aRivers) > 0)
        @foreach($aRivers as $oRiver)
            <tr>
                <td>
                    <a href="{{ url('river/' . $oRiver->id) }}">{{ $oRiver->name }}</a>
                </td>
                <td>
                    {{ $oRiver->shortDescription }}
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