<div class="container-fluid h-100 user-select-none">
<div class="row h-100 justify-content-center align-items-center">
<div class="col-sm-8 col-md-6 col-lg-4 my-4">
    
    <!-- HEADER -->
    <div class="text-center mb-4">
        <?php 
            if ($this->session->userType === 'Jobseeker') {
                if ($profilePic == NULL) { 
        ?>
                    <img 
                        class       = "rounded-circle mb-3"
                        src         = "<?php echo base_url() ?>public/img/jobseekers/blank_dp.png" 
                        alt         = "<?php echo $userName ?>" 
                        height      = "150" 
                        draggable   = "false"
                    >                    
        <?php   } else { ?>
                    <img 
                        class       = "rounded-circle mb-3"
                        src         = "<?php echo base_url() . 'public/img/jobseekers/' . $profilePic ?>" 
                        alt         = "<?php echo $userName ?>" 
                        height      = "150" 
                        draggable   = "false"
                    >
        <?php   
                } 
            } else if ($this->session->userType === 'Employer') {
                if ($profilePic == NULL) { 
        ?>
                    <img 
                        class       = "rounded-circle mb-3"
                        src         = "<?php echo base_url() ?>public/img/employers/blank_dp.png" 
                        alt         = "<?php echo $userName ?>" 
                        height      = "150" 
                        draggable   = "false"
                    >
        <?php   } else { ?>
                    <img 
                        class       = "rounded-circle mb-3"
                        src         = "<?php echo base_url() . 'public/img/employers/' . $profilePic ?>" 
                        alt         = "<?php echo $userName ?>" 
                        height      = "150" 
                        draggable   = "false"
                    >
        <?php 
                } 
            }
        ?>
        
        <h5 class="font-weight-light">Change your password here. <?php echo $userName ?></h5>
    </div>

    <!-- FORM SECTION -->
    <div class="bg-white border p-3 my-2 border">
        <form method="POST">

            <!-- NEW PASSWORD -->
            <div class="form-group">
                <label for="password">Type New Password:</label>
                <input 
                    type        = "password" 
                    class       = "form-control <?php echo form_error('newPassword') ? 'is-invalid' : '' ?>" 
                    id          = "newPassword" 
                    name        = "newPassword"
                    placeholder = "Type your new password"
                >
                <small class="invalid-feedback"><?php echo form_error('newPassword') ?></small>                
            </div>

            <!-- RETYPE PASSWORD -->
            <div class="form-group">
                <label for="password">Retype New Password to Confirm:</label>
                <input
                    type        = "password" 
                    class       = "form-control <?php echo form_error('retypeNewPassword') ? 'is-invalid' : '' ?>" 
                    id          = "retypeNewPassword" 
                    name        = "retypeNewPassword"
                    placeholder = "Retype your new password"
                >
                <small class="invalid-feedback">
                    <?php echo form_error('retypeNewPassword') ?>
                </small>                
            </div>
            
            <button type="submit" class="btn btn-primary btn-block">Update my password</button>

        </form>
    </div>
    
</div>
</div>
</div>
