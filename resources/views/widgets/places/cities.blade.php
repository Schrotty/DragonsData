<table class="user-table">
    <tr>
        <th>{{ trans('general.name') }}</th>
        <th>{{ trans('general.description') }}</th>
    </tr>

    @if(count($aCities) > 0)
        @foreach($aCities as $oCity)
            <tr>
                <td>
                    <a href="{{ url('city/' . $oCity->id) }}">{{ $oCity->name }}</a>
                </td>
                <td>
                    {{ $oCity->shortDescription }}
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