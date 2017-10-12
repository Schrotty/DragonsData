<div class="card">
    <div id="item-table" class="card-body">
        <table class="table table-hover table-responsive table-sm">
            <thead>
                <tr>
                    @foreach($header as $key => $value)
                        <th>{{ $key }}</th>
                    @endforeach
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @if(count($objects) > 0)
                    @foreach($objects as $item)
                        <tr id="{{ $item->id }}">
                            @foreach($header as $key => $value)
                                @if(is_array($value))
                                    @foreach($value as $k => $v)
                                        <td>{{ $item->$k->$v }}</td>
                                    @endforeach
                                    @continue
                                @endif

                                <td>{{ $item->$value }}</td>
                            @endforeach

                            <td class="text-right">
                                @include('admin._util.editLink', [
                                    'route' => $route, 'object' => $item, 'action' => '', 'name' => 'Show', 'style' => 'btn-outline-primary', 'delete' => false
                                ])

                                @include('admin._util.editLink', [
                                    'route' => $route, 'object' => $item, 'action' => 'edit', 'name' => 'Edit', 'style' => 'btn-outline-warning', 'delete' => false
                                ])

                                <a id="{{ $item->id }}" class="btn btn-sm btn-outline-danger" href="#" data-toggle="modal" data-target=".bd-example-modal-sm">
                                    <span>Delete</span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        @foreach($header as $key => $value)
                            <th>-</th>
                        @endforeach

                        <td></td>
                    </tr>
                @endif
            </tbody>
        </table>

        {{ $objects->links('vendor.pagination.pagination', ['q' => $q ?? ""]) }}
    </div>
</div>

