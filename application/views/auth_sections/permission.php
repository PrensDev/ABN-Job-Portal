<div class="container-fluid h-100 user-select-none">
<div class="row h-100 justify-content-center align-items-center">
<div class="col-sm-8 col-md-6 col-lg-4 my-4">
    
    <!-- HEADER -->
    <div class="text-center mb-4">
        <?php 
            if ($profilePic != NULL) {
                echo '
                    <img 
                        class       = "rounded-circle mb-3"
                        src         = "' . base_url() . 'public/img/jobseekers/' . $profilePic . '" 
                        alt         = "' . $username . '" 
                        height      = "150" 
                        draggable   = "false"
                    >
                ';
            } else {
                echo '
                    <img 
                        class       = "rounded-circle mb-3"
                        src         = "' . base_url() . 'public/img/jobseekers/blank_dp.png" 
                        alt         = "' . $username . '" 
                        height      = "150" 
                        draggable   = "false"
                    >
                ';
            }
        ?>
        <p>You sign in as <strong><?php echo $username ?></strong>.</p>
        <h5 class="font-weight-light">Type your password to continue.</h5>
    </div>

    <?php $this->load->view('auth_sections/components/alert') ?>

    <!-- FORM SECTION -->
    <div class="bg-white border p-3 my-2 border">
        <form method="POST">

            <!-- OLD PASSWORD -->
            <div class="form-group">
                <label for="password">Password:</label>
                <input 
                    type        = "password" 
                    class       = "form-control<?php echo form_error('password') ? ' is-invalid' : '' ?>" 
                    id          = "password" 
                    name        = "password"
                    placeholder = "Type your password here"
                >
                <small class="invalid-feedback">This is a required field.</small>                
            </div>
            
            <button type="submit" class="btn btn-primary btn-block">Submit</button>

            <a href="<?php echo base_url() ?>auth/forgot_password" class="btn btn-link btn-block">Forgot Password?</a>

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