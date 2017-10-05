<div class="card">
    <div id="item-table" class="card-body">
        <table class="table table-hover table-responsive table-sm">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Teaser</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @if(count($items) > 0)
                    @foreach($items as $item)
                        <tr id="{{ $item->getValue('_id') }}">
                            <td>{{ $item->getValue('name') }}</td>
                            <td>{{ $item->category()->getValue('name') }}</td>
                            <td>{{ $item->getValue('teaser', 'No teaser found') }}</td>
                            <td class="text-right">
                                @include('admin._util.editLink', [
                                    'route' => 'item', 'object' => $item, 'action' => '', 'name' => 'Show', 'style' => 'btn-outline-primary', 'delete' => false
                                ])

                                @include('admin._util.editLink', [
                                    'route' => 'item', 'object' => $item, 'action' => 'edit', 'name' => 'Edit', 'style' => 'btn-outline-warning', 'delete' => false
                                ])

                                <a id="{{ $item->getValue('_id') }}" class="btn btn-sm btn-outline-danger" href="#" data-toggle="modal" data-target=".bd-example-modal-sm">
                                    <span>Delete</span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td></td>
                    </tr>
                @endif
            </tbody>
        </table>

        {{ $items->links('vendor.pagination.pagination') }}
    </div>
</div>

