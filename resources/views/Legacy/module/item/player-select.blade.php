@php $items = \App\Item::getPlayer(\App\Settings::playerIdent()) @endphp
@if($items != null)
    @foreach($items as $item)
        <option value="{{ $item->_id }}">{{ $item->name }}</option>
    @endforeach
@endif