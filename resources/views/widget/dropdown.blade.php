<select name="{{ $sName }}" class="selectpicker" required>
    @if(isset($oObject->parent))
        <option value="{{ $oObject->parent->id }}">{{ $oObject->parent->name }}</option>
    @endif

    @foreach($aObjects as $oSingleObject)
        @if(isset($oObject->parent)) @if($oObject->parent->id == $oSingleObject->id) @continue @endif @endif
        <option value="{{ $oSingleObject->id }}">{{ $oSingleObject->name }}</option>
    @endforeach
</select>