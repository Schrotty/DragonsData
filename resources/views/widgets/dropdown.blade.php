<select name="parent" class="selectpicker" required>
    {{ App('debugbar')->info($oParent) }}
    @if(isset($oParent))
        <option value="{{ $oParent->getModel() }}-{{ $oParent->id }}">{{ $oParent->name }}</option>
    @endif

    @foreach($aObjects as $oObject)
        @if(isset($oParent)) @if($oParent->id == $oObject->id) @continue @endif @endif
        <option value="{{ $oObject->getModel() }}-{{ $oObject->id }}">{{ $oObject->name }}</option>
    @endforeach
</select>