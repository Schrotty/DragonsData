<a id="{{ $object->getValue('_id') }}" class="btn btn-sm {{ $style }}" href="{{ url('/' . $route . '/' . $object->getValue('_id') . '/' . $action) }}" @if($delete)data-toggle="modal" data-target=".bd-example-modal-sm"@endif>
    <span>{{ $name }}</span>
</a>