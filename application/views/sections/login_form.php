<div class="container-fluid h-100">
<div class="row h-100 justify-content-center align-items-center">
<div class="col-sm-8 col-md-6 col-lg-4 my-4">
    
    <!-- HEADER -->
    <div class="text-center mb-4"> 
        <img 
            src       = "<?php echo base_url() ?>public/img/brand/brand-02.png" 
            height    = "100" 
            alt       = "ABN Job Portal" 
            class     = "mb-3" 
            draggable = "false"
        >
        <h5 class="font-weight-light">Sign in using your account.</h5>
    </div>

    <?php $this->load->view('auth_sections/components/alert') ?>

    <!-- FORM SECTION -->
    <div class="bg-white p-3 rounded my-2 border">
        <form method="POST" id="loginForm">
            
            <!-- EMAIL FIELD -->
            <div class="form-group">
                <label for="email">Email:</label>
                <input 
                    type    = "text" 
                    class   = "form-control <?php echo form_error('email') ? 'is-invalid' : '' ;?>" 
                    id      = "email"
                    name    = "email"
                    value   = "<?php echo set_value('email') ; ?>"
                    autofocus
                >
                <small class="invalid-feedback">This is a required field</small>
            </div>

            <!-- PASSWORD FIELD -->
            <div class="form-group">
                <label for="password">Password:</label>        
                <input 
                    type    =   "password" 
                    class   =   "form-control <?php echo form_error('password') ? 'is-invalid' : '' ;?>" 
                    id      =   "password"
                    name    =   "password"
                >
                <small class="invalid-feedback">This is a required field.</small>
            </div>

            
            <!-- LOGIN USER CONTROL -->
            <button type="submit" class="btn btn-primary btn-block" id="loginBtn">
                <span>Login</span>
                <i class="fas fa-sign-in-alt mr-1"></i>
            </button>
            
        </form>
        
        <hr>

        <a href="<?php echo base_url() ?>user/forgot_password" type="submit" class="btn btn-link btn-block btn-sm">
            <span>Forgotten your password?</span>
        </a>
    </div>
    
    <!-- FOOTER LINK SECTION -->
    <div class="d-flex justify-content-between">
        <div>
            <small>
                <a 
                    href            = "<?php echo base_url()?>" 
                    data-toggle     = "tooltip"
                    data-placement  = "top"
                    title           = "Go to Home page."
                >Home</a>
            </small>
        </div>
        <div>
            <small>
                <a 
                    href            = "<?php echo base_url()?>home/terms_and_conditions" 
                    data-toggle     = "tooltip"
                    data-placement  = "top"
                    title           = "Read the terms and conditions."
                >Terms and Conditions</a>
            </small>
        </div>
    </div>

</div>
</div>
</div>

<script>
$(document).on('click', '#loginBtn', function () {
    $(this).attr("disabled", true);
    $(this).prepend('<span class="spinner-border spinner-border-sm mr-1" role="status" aria-hidden="true"></span>');
    return true;
});
</script>