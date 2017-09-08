@php $items = \App\Item::getPlayer(\App\Settings::playerIdent()) @endphp
@foreach($items as $item)
    @if(in_array($item->_id, (array)$user->chars))
        <option selected value="{{ $item->_id }}">{{ $item->name }}</option>
        @continue
    @endif

    <option value="{{ $item->_id }}">{{ $item->name }}</option>
@endforeach