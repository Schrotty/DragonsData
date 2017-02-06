<select name="continent" class="selectpicker">
    <option value="{{ $continent->id }}">{{ $continent->name }}</option>
    @foreach(App\Models\Continent::all() as $oContinent)
        @if($continent->id != $oContinent->id)
            <option value="{{ $oContinent->id }}">{{ $oContinent->name }}</option>
        @endif
    @endforeach
</select>