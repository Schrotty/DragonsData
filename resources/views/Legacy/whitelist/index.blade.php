<table class="table table-hover">
    <thead>
        <tr>
            <th>IP</th>
            <th>Description</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @if(count($entries) != 0)
            @foreach($entries as $white)
                <tr>
                    <td>{{ $white->ip }}</td>
                    <td>{{ $white->description }}</td>
                    <td class="text-right non-link">
                        <a href="{{ '/whitelist/' . $white->_id . '/edit' }}">
                            <button type="button" class="btn-empty">
                                <span class="oi oi-pencil"></span>
                            </button>
                        </a>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td>-</td>
                <td>-</td>
                <td></td>
            </tr>
        @endif
    </tbody>
</table>