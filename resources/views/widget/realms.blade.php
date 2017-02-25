<table class="user-table">
    <tr>
        <th>{{ trans('general.name') }}</th>
        <th>{{ trans('general.description') }}</th>
    </tr>

    {{ App('debugbar')->info(count($realms)) }}
    @if(count($realms) >= 1)
        @foreach($realms as $realm)
            @if(!$openRealmMode && $realm->isOpen)
                @continue
            @endif

            <tr>
                <td><a href="{{ url('realm/' . $realm->url) }}">{{ $realm->name }}</a></td>
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