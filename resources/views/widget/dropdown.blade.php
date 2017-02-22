<select name="{{ $sName }}" class="selectpicker" required>
    @foreach($aObjects as $aObject)
        @foreach($aObject as $oSingleObject)
            @if(isset($oParent))
                @if($oParent->id == $oSingleObject->id)
                    <option selected value="{{ $oSingleObject->getModel() . '-' . $oSingleObject->id }}">{{ $oSingleObject->name }}</option>
                    @continue
                @endif
            @endif

            <option value="{{ $oSingleObject->getModel() . '-' . $oSingleObject->id }}">{{ $oSingleObject->name }}</option>
        @endforeach

        @if(!$loop->last)
            <option data-divider="true"></option>
        @endif
    @endforeach
</select>