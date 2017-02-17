<select name="landscape" class="selectpicker" required>
        @if(isset($oObject))
                <option value="{{ $oObject->landscape->id }}">{{ $oObject->landscape->name }}</option>
    @endif

    @foreach(App\Models\Landscape::all() as $oLandscape)
                @if(isset($oObject)) @if($oObject->landscape->id == $oLandscape->id) @continue @endif @endif
                <option value="{{ $oLandscape->id }}">{{ $oLandscape->name }}</option>
    @endforeach
</select>