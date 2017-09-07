@foreach(\App\Item::getPlayer(\App\Settings::playerIdent()) as $item)
    @if(in_array($item->_id, (array)$party->player))
        <option selected value="{{ $item->_id }}">{{ $item->name }}</option>
        @continue
    @endif

    <option value="{{ $item->_id }}">{{ $item->name }}</option>
@endforeach