<table class="index-table">
    <tr>
        <th>{{ trans('general.name') }}</th>
        <th>{{ trans('realm.dungeon_master') }}</th>
        <th>{{ trans('general.edit') }}</th>
    </tr>

    @if( count($aObjects) != 0 )
        @foreach($aObjects as $oObject)
            <tr>
                <td><a href="{{ url($oObject->getModel() . '/' . $oObject->url) }}">{{ $oObject->name }}</a></td>
                <td>{{ $oObject->dungeonMaster->name }}</td>
                <td>
                    <a href="{{ action(ucfirst($oObject->getModel()) . 'Controller@edit', $oObject->url) }}">{{ trans( $oObject->getModel() . '.edit') }}</a>
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