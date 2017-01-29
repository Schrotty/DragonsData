<select name="dungeon-master" class="selectpicker">
    <option>{{ $user->name }}</option>
    @foreach(App\User::all() as $oUser)
        @if($oUser->id != $user->id)
            <option>{{ $oUser->name }}</option>
        @endif
    @endforeach
</select>