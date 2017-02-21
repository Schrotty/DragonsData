<select name="{{ $sName }}" class="selectpicker" required>
    @if(isset($oParent))
        <option value="{{ $oParent->id }}">{{ $oParent->name }}</option>
    @endif

    @foreach($aObjects as $oSingleObject)
        @if(isset($oParent)) @if($oParent->id == $oSingleObject->id) @continue @endif @endif
        <option value="{{ $oSingleObject->id }}">{{ $oSingleObject->name }}</option>
    @endforeach
</select>