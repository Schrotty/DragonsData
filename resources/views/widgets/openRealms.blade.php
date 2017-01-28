<table class="user-table">
    <tr>
        <th>{{ trans('general.name') }}</th>
        <th>{{ trans('general.description') }}</th>
        <th>{{ trans('realm.enter') }}</th>
    </tr>

    @foreach($realms as $realm)
        @if(!$realm->isPrivate)
            <tr>
                <td><a href="{{ url('realm/' . $realm->id) }}">{{ $realm->name }}</a></td>
                <td>{{ $realm->shortDescription }}</td>
                <td><a href="{{ url('realm/' . $realm->id . '/enter/') }}">{{ trans('realm.enter') }}</a></td>
            </tr>
        @endif
    @endforeach
</table>