<div class="tab-pane fade" id="tab-account" role="tabpanel" aria-labelledby="tab-account-link">
    <form action="#">
        <div class="row">
            <div class="col-sm-6">
                <label>First Name *</label>
                <input type="text" class="form-control" value="{{ $customer->first_name }}" required>
            </div><!-- End .col-sm-6 -->

            <div class="col-sm-6">
                <label>Last Name *</label>
                <input type="text" class="form-control" value="{{ $customer->last_name }}">
            </div><!-- End .col-sm-6 -->
        </div><!-- End .row -->


        <label>Email address *</label>
        <input type="email" class="form-control" value="{{ $customer->email }}" required>

        <label>Current password (leave blank to leave unchanged)</label>
        <input type="password" class="form-control" name="current_password">

        <label>New password (leave blank to leave unchanged)</label>
        <input type="password" class="form-control" name="new_password">

        <label>Confirm new password</label>
        <input type="password" class="form-control mb-2" name="confirm_new_password">

        <button type="submit" class="btn btn-outline-primary-2">
            <span>SAVE CHANGES</span>
            <i class="icon-long-arrow-right"></i>
        </button>
    </form>
</div>
