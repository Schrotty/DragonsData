<form action="{{ '/account/' . $user->_id }}" method="POST">
    {{ method_field('PUT') }}
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="type" value="notification">

    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="panel-title">Notifications</span>
        </div>

        <div class="panel-body">
            @if(!config('app.notifications'))
                <div class="alert alert-warning" role="alert">
                    The notification system is currently <strong>disabled</strong> system wide!
                </div>
            @endif

            <strong>Access Notifications</strong>
            <p>When you’re granted/ lost access to an item, receive notifications about it.</p>
            <div class="form-check form-check-inline">
                <label class="form-check-label block">
                    <input name="read-access" @if($user->receiveNotifications(\App\Notifications\Notifications::READ_ACCESS)) checked @endif class="form-check-input" type="checkbox" id="inlineCheckbox1" value="read-access"> Receive Notifications for Read Access
                </label>
            </div>

            <div class="form-check form-check-inline">
                <label class="form-check-label block">
                    <input name="write-access" @if($user->receiveNotifications(\App\Notifications\Notifications::WRITE_ACCESS)) checked @endif class="form-check-input" type="checkbox" id="inlineCheckbox1" value="write-access"> Receive Notifications for Write Access
                </label>
            </div>

            <div class="spacer"></div>

            <strong>News Notification</strong>
            <p>When news is published, receive a notification about it.</p>
            <label class="form-check-label block">
                <input name="news" @if($user->receiveNotifications([\App\Notifications\NewsPublish::class])) checked @endif class="form-check-input" type="checkbox" id="inlineCheckbox1" value="news"> Receive Notifications
            </label>
        </div>

        <div class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>