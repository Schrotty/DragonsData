@php $items = \App\Item::byTag(\App\Settings::playerTag()) @endphp
@if($items != null)
    @foreach($items as $item)
        <option value="{{ $item->_id }}">{{ $item->name }}</option>
    @endforeach
@endif