<select name="realm" class="selectpicker" required>
    @if(isset($iRealmID))
        <option value="{{ $iRealmID }}">{{ \App\Models\Realm::find($iRealmID)->name }}</option>
    @else
        <option value="{{ $realm->id }}">{{ $realm->name }}</option>
    @endif

    @foreach(App\Models\Realm::all() as $oRealm)
        @if($realm->id != $oRealm->id)
            <option value="{{ $oRealm->id }}">{{ $oRealm->name }}</option>
        @endif
    @endforeach
</select>