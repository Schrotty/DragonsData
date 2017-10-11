<div id="results">
    @foreach($items as $item)
        <div class="col">
            <div id="{{ '/item/' . $item->id }}" class="card pointer card-clickable">
                <div class="card-body">
                    <h4 class="card-title">
                        <span>{{ $item->getValue('name') }}</span>
                        <small class="text-muted">{{ $item->category->getValue('name', 'Unknown') }}</small>
                    </h4>

                    <p>
                        <i>{{ $item->getValue('teaser', 'No teaser found') }}</i>
                    </p>
                </div>
            </div>
        </div>
        <div class="w-100"></div>
    @endforeach

    {{ $items->links('vendor.pagination.pagination', ['q' => $q ?? ""]) }}
</div>