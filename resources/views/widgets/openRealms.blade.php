<table class="user-table">
    <tr>
        <th>{{ trans('general.name') }}</th>
        <th>{{ trans('general.description') }}</th>
        <th>{{ trans('realm.dungeon_master') }}</th>
    </tr>
    @foreach($realms as $realm)
        <tr>
            <td><a href="{{ url('realm/' . $realm->id) }}">{{ $realm->name }}</a></td>
            <td>{{ $realm->shortDescription }}</td>
            <td><a href="{{ url('user/' . $realm->dungeonMaster->id) }}">{{ $realm->dungeonMaster->name }}</a></td>
        </tr>
    @endforeach
</table>