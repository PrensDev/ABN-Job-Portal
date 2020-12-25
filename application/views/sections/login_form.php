<div class="container-fluid h-100">
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

    <?php
        if ($error != '') {
            echo '
            <div class="alert alert-danger my-2 alert-dismissible fade show" role="alert">
                ' . $error . '
                <button type="button" class="btn close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
            </div>
            ';
        }
    ?>

    <!-- FORM SECTION -->
    <div class="bg-white p-3 rounded my-2 shadow">
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
            <input 
                type    =   "password" 
                class   =   "form-control <?php echo form_error('password') ? 'is-invalid' : '' ;?>" 
                id      =   "password"
                name    =   "password"
            >
            <small class="invalid-feedback">This is a required field.</small>
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