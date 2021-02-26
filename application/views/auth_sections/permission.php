<div class="container-fluid h-100 user-select-none">
<div class="row h-100 justify-content-center align-items-center">
<div class="col-sm-8 col-md-6 col-lg-4 my-4">
    
    <!-- HEADER -->
    <div class="text-center mb-4">
        <?php 
            if ($this->session->userType === 'Jobseeker') {
                if ($profilePic != NULL) { 
        ?>
                    <img 
                        class       = "rounded-circle mb-3"
                        src         = "<?php echo base_url() . 'public/img/jobseekers/' . $profilePic ?>" 
                        alt         = "<?php echo $userName ?>" 
                        height      = "150" 
                        draggable   = "false"
                    >
        <?php   } else { ?>
                    <img 
                        class       = "rounded-circle mb-3"
                        src         = "<?php echo base_url() ?>public/img/jobseekers/blank_dp.png" 
                        alt         = "<?php echo $userName ?>" 
                        height      = "150" 
                        draggable   = "false"
                    >
        <?php   
                } 
            } else if ($this->session->userType === 'Employer') {
                if ($profilePic != NULL) { 
        ?>
                    <img 
                        class       = "rounded-circle mb-3"
                        src         = "<?php echo base_url() . 'public/img/employers/' . $profilePic ?>" 
                        alt         = "<?php echo $userName ?>" 
                        height      = "150" 
                        draggable   = "false"
                    >
        <?php   } else { ?>
                    <img 
                        class       = "rounded-circle mb-3"
                        src         = "<?php echo base_url() ?>public/img/employers/blank_dp.png" 
                        alt         = "<?php echo $userName ?>" 
                        height      = "150" 
                        draggable   = "false"
                    >
        <?php 
                } 
            }
        ?>
        
        <p>You sign in as <strong><?php echo $userName ?></strong>.</p>
        <h5 class="font-weight-light">Type your password to continue.</h5>
    </div>

    <?php $this->load->view('auth_sections/components/alert') ?>

    <!-- FORM SECTION -->
    <div class="bg-white border p-3 my-2 border">
        <form method="POST" id="submitPasswordForm">

            <div class="form-group">
                <label for="password">Password:</label>
                <input 
                    type        = "password" 
                    class       = "form-control<?php echo form_error('password') ? ' is-invalid' : '' ?>" 
                    id          = "password" 
                    name        = "password"
                    placeholder = "Type your password here"
                    autofocus
                >
                <small class="invalid-feedback">This is a required field.</small>                
            </div>
            
            <button 
                type  = "submit" 
                class = "btn btn-primary btn-block"
                id    = "submitBtn"
            >Submit</button>

            <hr>

            <a 
                href  = "<?php echo base_url() ?>user/forgot_password" 
                class = "btn btn-link btn-block btn-sm"
            >Forgotten your password?</a>

        </form>
    </div>
    
    <!-- FOOTER LINK SECTION -->
    <div class="d-flex justify-content-between">
        <div>
            <small>
                <a 
                    href            = "<?php echo base_url() ?>auth/settings" 
                    data-toggle     = "tooltip"
                    data-placement  = "top"
                    title           = "Go to Settings"
                >Settings</a>
            </small>
        </div>
        <div>
            <small>
                <a 
                    href            = "<?php echo base_url() ?>" 
                    data-toggle     = "tooltip"
                    data-placement  = "top"
                    title           = "Go to Home page."
                >Home</a>
                <span> | </span>
                <a 
                    href            = "<?php echo base_url() ?>home/terms_and_conditions"
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
$(document).ready(function () {
    $("#submitPasswordForm").submit(function () {
        var submitBtn = $("#submitBtn");
        submitBtn.attr("disabled", true);
        submitBtn.prepend('<span class="spinner-border spinner-border-sm mr-1" role="status" aria-hidden="true"></span>');
        return true;
    });
});
</script>