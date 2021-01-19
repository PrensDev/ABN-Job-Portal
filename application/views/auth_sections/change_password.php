<div class="container-fluid h-100 user-select-none">
<div class="row h-100 justify-content-center align-items-center">
<div class="col-sm-8 col-md-6 col-lg-4 my-4">
    
    <!-- HEADER -->
    <div class="text-center mb-4">
        <?php if ($profilePic != NULL) { ?>
            <img 
                class       = "rounded-circle mb-3"
                src         = "<?php echo base_url() . 'public/img/jobseekers/' . $profilePic ?>" 
                alt         = "<?php echo $username ?>" 
                height      = "150" 
                draggable   = "false"
            >
        <?php } else { ?>
            <img 
                class       = "rounded-circle mb-3"
                src         = "<?php echo base_url() ?>public/img/jobseekers/blank_dp.png" 
                alt         = "<?php echo $username ?>" 
                height      = "150" 
                draggable   = "false"
            >
        <?php } ?>
        
        <h5 class="font-weight-light">Change your password here. <?php echo $username ?></h5>
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
                <small class="invalid-feedback">This is a required field.</small>                
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
                <small class="invalid-feedback">This is a required field.</small>                
            </div>
            
            <button type="submit" class="btn btn-primary btn-block">Update my password</button>

        </form>
    </div>
    
</div>
</div>
</div>