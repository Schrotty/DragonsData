<select name="dungeon-master" class="selectpicker">
    <option value="{{ $user->id }}">{{ $user->name }}</option>
    @foreach(App\User::all() as $oUser)
        @if($oUser->id != $user->id)
            <option value="{{ $oUser->id }}">{{ $oUser->name }}</option>
        @endif
    @endforeach
</select>