<a id="{{ $object->id }}" class="btn btn-sm {{ $style }}" href="{{ url('/' . $route . '/' . $object->id . '/' . $action) }}" @if($delete)data-toggle="modal" data-target=".bd-example-modal-sm"@endif>
    <span>{{ $name }}</span>
</a>