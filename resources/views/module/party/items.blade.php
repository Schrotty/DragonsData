<div class="panel panel-default">
    <div class="panel-heading">
        <span class="panel-title">Party Items</span>
    </div>

    <div class="panel-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @php $items = \App\Item::byParty($party->_id) @endphp
                @if(count($party->items) != 0)
                    @foreach($party->items as $item)
                        <tr>
                            <td><a href="{{ '/item/'.$item->_id }}">{{ $item->name }}</a></td>
                            <td>{{ $item->teaser }}</td>
                            <td class="text-right non-link">
                                <a href="{{ '/item/' . $item->_id . '/edit' }}">
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
    </div>
</div>