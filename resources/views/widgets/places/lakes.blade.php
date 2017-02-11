<table class="user-table">
    <tr>
        <th>{{ trans('general.name') }}</th>
        <th>{{ trans('general.description') }}</th>
    </tr>

    @if(count($aLakes) > 0)
        @foreach($aLakes as $oLake)
            <tr>
                <td>
                    <a href="{{ url('lake/' . $oLake->id) }}">{{ $oLake->name }}</a>
                </td>
                <td>
                    {{ $oLake->shortDescription }}
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