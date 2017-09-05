@foreach(\App\Item::byTag(\App\Settings::playerTag()) as $item)
    @if(in_array($item->_id, (array)$user->chars))
        <option selected value="{{ $item->_id }}">{{ $item->name }}</option>
        @continue
    @endif

    <option value="{{ $item->_id }}">{{ $item->name }}</option>
@endforeach