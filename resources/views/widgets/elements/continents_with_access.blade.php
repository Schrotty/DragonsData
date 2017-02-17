<select name="continent" class="selectpicker" required>
        @if(isset($oObject))
                <option value="{{ $oObject->continent->id }}">{{ $oObject->continent->name }}</option>
    @endif

    @foreach(App\Models\Continent::all() as $oContinent)
                @if(isset($oObject)) @if($oObject->continent->id == $oContinent->id) @continue @endif @endif
                <option value="{{ $oContinent->id }}">{{ $oContinent->name }}</option>
    @endforeach
</select>