<table class="user-table">
    <tr>
        <th>{{ trans('general.name') }}</th>
        <th>{{ trans('general.description') }}</th>
        <th>{{ trans('general.open_realm') }}</th>
    </tr>

    @if(count($realms) >= 1)
        @foreach($realms as $realm)
            <tr>
                <td><a href="{{ url('realm/' . $realm->url) }}">{{ $realm->name }}</a></td>
                <td>{{ $realm->shortDescription }}</td>
                <td>
                    @if($realm->isOpen)
                        Open realm
                    @else
                        Closed realm
                    @endif
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