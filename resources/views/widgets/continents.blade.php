<table class="user-table">
    <tr>
        <th>{{ trans('general.name') }}</th>
        <th>{{ trans('general.description') }}</th>
    </tr>

    @foreach($realm->continents as $oContinent)
        <tr>
            <td><a href="{{ url('continent/' . $oContinent->id) }}">{{ $oContinent->name }}</a></td>
            <td>{{ $oContinent->description }}</td>
        </tr>
    @endforeach
</table>