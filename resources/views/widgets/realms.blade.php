<table class="user-table">
    <tr>
        <th>{{ trans('general.name') }}</th>
        <th>{{ trans('general.description') }}</th>
    </tr>
    @if( count($realms) != 0 )
        @foreach($realms as $realm)
            @if(!$openRealmMode && $realm->isOpen)
                @continue
            @endif

            <tr>
                <td><a href="{{ url('realm/' . $realm->id) }}">{{ $realm->name }}</a></td>
                <td>{{ $realm->shortDescription }}</td>
            </tr>
        @endforeach
    @else
        <tr>
            <td>-</td>
            <td>-</td>
        </tr>
    @endif
</table>