@foreach($objects as $object)
    <option value="{{ $object->id }}">{{ $object->getValue($key) }}</option>
@endforeach