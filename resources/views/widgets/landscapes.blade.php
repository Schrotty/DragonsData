<table class="user-table">
    <tr>
        <th>{{ trans('general.name') }}</th>
        <th>{{ trans('general.description') }}</th>
    </tr>

    @if(count($oContinent->landscapes) > 0)
        @foreach($oContinent->landscapes as $oLandscape)
            <tr>
                <td><a href="{{ url('landscape/' . $oLandscape->id) }}">{{ $oLandscape->name }}</a></td>
                <td>{{ $oLandscape->description }}</td>
            </tr>
        @endforeach
    @else
        <tr>
            <td>-</td>
            <td>-</td>
        </tr>
    @endif
</table>