<select name="realm" class="selectpicker">
    <option value="{{ $realm->id }}">{{ $realm->name }}</option>
    @foreach(App\Models\Realm::all() as $oRealm)
        @if($realm->id != $oRealm->id)
            <option value="{{ $oRealm->id }}">{{ $oRealm->name }}</option>
        @endif
    @endforeach
</select>