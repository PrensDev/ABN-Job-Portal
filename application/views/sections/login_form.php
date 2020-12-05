<div class="container-fluid h-100 user-select-none">
<div class="row h-100 justify-content-center align-items-center">
<div class="col-sm-8 col-md-6 col-lg-4 my-4">
    
    <!-- HEADER -->
    <div class="text-center mb-4"> 
        <img 
            src="<?php echo base_url() ?>public/img/brand/brand-02.png" 
            height="100" 
            alt="AB Job Portal Website" 
            class="mb-3" 
            draggable="false"
        >
        <h5 class="font-weight-light">Sign in using your account.</h5>
    </div>

    <!-- ERROR ALERT BOX -->
    <div class="alert alert-danger my-2 alert-dismissible fade show" role="alert">
        The account you entered <strong>doesn't exist</strong>.
        <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
    </div>
    <!-- END OF ERROR ALERT BOX -->

    <!-- FORM SECTION -->
    <div class="bg-white border p-3 rounded my-2">
    <form method="POST">
        
        <!-- EMAIL FIELD -->
        <div class="form-group">
            <label for="email">Email:</label>
            <input 
                type    = "text" 
                class   = "form-control <?php echo form_error('email') ? 'is-invalid' : '' ;?>" 
                id      = "email"
                name    = "email"
                value   = "<?php echo set_value('email') ; ?>"
            >
            <small class="invalid-feedback">This is a required field</small>
        </div>

        <!-- PASSWORD FIELD -->
        <div class="form-group">
            <div class="d-flex justify-content-between">
                <div>
                    <label for="password">Password:</label>
                </div>
                <div>
                    <label><a href="forgot_password.html" data-toggle="tooltip" data-placement="top" title="Did you forgot your password? Click Here.">Forgot Password?</a></label>
                </div>
            </div>
            <div class="input-group">
                <input 
                    type    =   "password" 
                    class   =   "form-control <?php echo form_error('password') ? 'is-invalid' : '' ;?>" 
                    id      =   "password"
                    name    =   "password"
                >
                <div class="input-group-append">
                    <span class="input-group-text bg-white" id="togglePassword">
                        <i class="fas fa-eye" id="passwordIcon"></i>
                    </span>
                </div>
                <small class="invalid-feedback">This is a required field.</small>
            </div>
        </div>

        <!-- LOGIN USER CO -->
        <button type="submit" class="btn btn-primary btn-block">
            <i class="fas fa-sign-in-alt mr-1"></i>
            <span>Login</span>
        </button>

    </form>
    </div>
    <!-- END OF FORM SECTION -->
    
    <!-- FOOTER LINK SECTION -->
    <div class="d-flex justify-content-between">
        <div>
            <small><a href="<?php echo base_url()?>" title="Back to Home page.">Home</a></small>
        </div>
        <div>
            <small><a href="<?php echo base_url()?>home/terms_and_conditions" title="Read the terms and conditions.">Terms and Conditions</a></small>
        </div>
    </div>
    <!-- END PF FOOTER LINK SECTION -->

</div>
</div>
</div>