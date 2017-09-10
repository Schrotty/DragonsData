<form action="{{ '/account/' . $user->_id }}" method="POST">
    {{ method_field('PUT') }}
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="type" value="security">

    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="panel-title">Security</span>
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="cpass">Current Password</label>
                        <input value="{{ old('current-password') }}" name="current-password" type="password" id="cpass" class="form-control" placeholder="Enter current password">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="npass">New Password</label>
                        <input value="{{ old('password') }}" name="password" type="password" id="npass" class="form-control" placeholder="Enter new password">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="copass">Confirm Password</label>
                        <input name="password_confirmation" type="password" id="copass" class="form-control" placeholder="Confirm new password">
                    </div>
                </div>
            </div>
        </div>

        <div class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                    <button class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>