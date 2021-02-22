<div class="container-fluid h-100 user-select-none">
<div class="row h-100 justify-content-center align-items-center">
<div class="col-sm-8 col-md-6 col-lg-4 my-4">

    <!-- HEADER -->
    <div class="text-center mb-4">
        <?php if ($profilePic != NULL) { ?>
            <img 
                class       = "rounded-circle mb-3"
                src         = "<?php echo base_url() . 'public/img/jobseekers/' . $profilePic ?>" 
                alt         = "<?php echo $userName ?>" 
                height      = "150" 
                draggable   = "false"
            >
        <?php } else { ?>
            <img 
                class       = "rounded-circle mb-3"
                src         = "<?php echo base_url() ?>public/img/jobseekers/blank_dp.png" 
                alt         = "<?php echo $userName ?>" 
                height      = "150" 
                draggable   = "false"
            >
        <?php } ?>

        <h5 class="font-weight-light">Type your new email. <strong><?php echo $userName ?></strong></h5>
    </div>

    <?php $this->load->view('auth_sections/components/alert') ?>

    <!-- FORM SECTION -->
    <div class="bg-white border p-3 my-2 border">
        <form method="POST">

            <!-- EMAIL -->
            <div class="form-group">
                <label for="password">Email:</label>
                <input 
                    type        = "email" 
                    class       = "form-control<?php echo form_error('email') ? ' is-invalid' : '' ?>" 
                    id          = "email" 
                    name        = "email"
                    placeholder = "Type your new email"
                >
                <small class="invalid-feedback"><?php echo form_error('email') ?></small>                
            </div>
            
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </form>
    </div>

    <!-- FOOTER LINK SECTION -->
    <div class="d-flex justify-content-between">
        <div>
            <small><a href="<?php echo base_url() ?>" title="Settings">Settings</a></small>
        </div>
        <div>
            <small>
                <a href="<?php echo base_url() ?>" title="Go to Home page.">Home</a>
                <span> | </span>
                <a href="<?php echo base_url() ?>home/terms_and_conditions" title="Read the terms and conditions.">Terms and Conditions</a>
            </small>
        </div>
    </div>

</div>
</div>
</div>