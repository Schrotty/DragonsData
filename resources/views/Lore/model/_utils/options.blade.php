@foreach($objects as $object)
    <option value="{{ $object->getValue('_id') }}">{{ $object->getValue($key) }}</option>
@endforeach