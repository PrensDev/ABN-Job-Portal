<div class="container-fluid h-100 user-select-none">
<div class="row h-100 justify-content-center align-items-center">
<div class="col-sm-8 col-md-6 col-lg-4 my-4">
    
    <!-- HEADER -->
    <div class="text-center mb-4">
        <img class="rounded-pill mb-2" src="assets\97.jpg" alt="" height="100">
        <p>You sign in as <strong><?php echo $username ?></strong>.</p>
        <h5 class="font-weight-light">Change your password here.</h5>
    </div>

    <!-- FORM SECTION -->
    <div class="bg-white border p-3 my-2 border">
        <form method="POST">

            <div class="form-group">
                <div class="d-flex justify-content-between">
                    <div>
                        <label for="password">Type Old Password:</label>
                    </div>
                    <div>
                        <label><a href="forgot_password.html" data-toggle="tooltip" data-placement="top" title="Did you forget your password? Click Here">Forgot Password?</a></label>
                    </div>
                </div>
                <input 
                    type        = "password" 
                    class       = "form-control <?php echo form_error('oldPassword') ? 'is-invalid' : '' ?>" 
                    id          = "oldPassword" 
                    name        = "oldPassword"
                    placeholder = "Type your old password"
                    value       = "<?php set_value('oldPassword') ?>"
                >
                <small class="invalid-feedback">This is a required field.</small>
                
            </div>

            <div class="form-group">
                <label for="password">Type New Password:</label>
                <input 
                    type        = "password" 
                    class       = "form-control <?php echo form_error('newPassword') ? 'is-invalid' : '' ?>" 
                    id          = "newPassword" 
                    name        = "newPassword"
                    placeholder = "Type your new password"
                >
                <small class="invalid-feedback">This is a required field.</small>                
            </div>

            <div class="form-group">
                <label for="password">Retype New Password to Confirm:</label>
                <input
                    type        = "password" 
                    class       = "form-control <?php echo form_error('retypeNewPassword') ? 'is-invalid' : '' ?>" 
                    id          = "retypeNewPassword" 
                    name        = "retypeNewPassword"
                    placeholder = "Retype your new password"
                >
                <small class="invalid-feedback">This is a required field.</small>                
            </div>
            
            <button type="submit" class="btn btn-warning btn-block">Change Password</button>

        </form>
    </div>
    
    <!-- FOOTER LINK SECTION -->
    <div class="d-flex justify-content-between">
        <div>
            <small><a href="<?php echo base_url() ?>" title="Back to Home page.">Home</a></small>
        </div>
        <div>
            <small><a href="<?php echo base_url() ?>home/terms_and_conditions" title="Read the terms and conditions.">Terms and Conditions</a></small>
        </div>
    </div>

</div>
</div>
</div>