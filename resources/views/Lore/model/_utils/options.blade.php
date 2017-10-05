@foreach($objects as $object)
    <option value="{{ $object->getValue('id') }}">{{ $object->getValue($key) }}</option>
@endforeach