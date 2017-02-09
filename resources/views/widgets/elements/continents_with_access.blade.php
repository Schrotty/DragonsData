<select name="continent" class="selectpicker">

    @if(isset($iContinentID))
        <option value="{{ $iContinentID }}">{{ \App\Models\Continent::find($iContinentID)->name }}</option>
    @else
        <option value="{{ $continent->id }}">{{ $continent->name }}</option>
    @endif
    @foreach(App\Models\Continent::all() as $oContinent)
        @if($continent->id != $oContinent->id)
            <option value="{{ $oContinent->id }}">{{ $oContinent->name }}</option>
        @endif
    @endforeach
</select>