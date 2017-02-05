<table class="user-table">
    <tr>
        <th>{{ trans('general.name') }}</th>
        <th>{{ trans('general.description') }}</th>
    </tr>

    @if(count($oContinents) > 0)
        @foreach($oContinents as $oContinent)
            <tr>
                <td><a href="{{ url('continent/' . $oContinent->id) }}">{{ $oContinent->name }}</a></td>
                <td>{{ $oContinent->short_description }}</td>
            </tr>
        @endforeach
    @else
        <tr>
            <td>-</td>
            <td>-</td>
        </tr>
    @endif
</table>