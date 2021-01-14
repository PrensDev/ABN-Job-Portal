
<!-- FORM SECTION -->
<div class="container-fluid py-5">
<div class="container">

    <h1 class="display-4">Register as <span class="text-primary">Employer</span></h1>
    <p class="text-secondary">Create your account and post an available job.</p>

    <p class="text-danger"><small>* Required</small></p>

    <!-- EMPLOYER REGISTRATION FORM -->
    <form method="POST">

        <!-- COMPANY INFORMATION FORM -->
        <div class="card border-0">

            <div class="card-header h6 bg-white border-primary">
                <i class="fas fa-briefcase text-primary mr-2"></i>
                <span>Company Information</span>
            </div>
            
            <div class="card-body">
                
                <!-- COMPANY NAME -->
                <div class="form-group">
                    <label for="companyName">Company Name</label>
                    <span class="text-danger">*</span>
                    <input 
                        type        = "text" 
                        class       = "form-control <?php echo form_error('companyName') ? 'is-invalid' : '' ;?>" 
                        id          = "companyName" 
                        name        = "companyName"
                        value       = "<?php echo set_value('companyName'); ?>"
                        placeholder = "Company Name"
                    >
                    <small class="invalid-feedback" id="retypePasswordFeedback"><?php echo form_error('companyName')?></small>
                </div>

                <!-- ADDRESS FIELD -->
                <div class="form-row">

                    <!-- STREET NAME -->
                    <div class="form-group col-md">
                        <label for="street">Street</label>
                        <span class="text-danger">*</span>
                        <input 
                            type        = "text" 
                            class       = "form-control <?php echo form_error('street') ? 'is-invalid' : '' ;?>" 
                            id          = "street"
                            name        = "street" 
                            value       = "<?php echo set_value('street'); ?>"
                            placeholder = "Street Name" 
                        >
                        <small class="invalid-feedback" id="retypePasswordFeedback"><?php echo form_error('street')?></small>
                    </div>

                    <!-- BARANGGAY/DISTRICT NAME -->
                    <div class="form-group col-md">
                        <label for="brgyDistrict">Baranggay / District</label>
                        <span class="text-danger">*</span>
                        <input 
                            type        = "text" 
                            class       = "form-control <?php echo form_error('brgyDistrict') ? 'is-invalid' : '' ;?>" 
                            id          = "brgyDistrict"
                            name        = "brgyDistrict" 
                            value       = "<?php echo set_value('brgyDistrict'); ?>"
                            placeholder = "Baranggay / District" 
                        >
                        <small class="invalid-feedback" id="retypePasswordFeedback"><?php echo form_error('brgyDistrict')?></small>
                    </div>

                    <!-- CITY AND STATE / PROVINCE -->
                    <div class="form-group col-md">
                        <label for="cityProvince">City and state / Province</label>
                        <span class="text-danger">*</span>
                        <input  
                            type        = "text" 
                            class       = "form-control <?php echo form_error('cityProvince') ? 'is-invalid' : '' ;?>" 
                            id          = "cityProvince" 
                            name        = "cityProvince"
                            value       = "<?php echo set_value('cityProvince'); ?>"
                            placeholder = "City and state / Province"
                        >
                        <small class="invalid-feedback" id="retypePasswordFeedback"><?php echo form_error('cityProvince')?></small>
                    </div>
                    
                </div>

                <!-- DESCRIPTION FIELD -->
                <div class="form-group">
                    <label for="description">Description</label>
                    <span class="text-danger">*</span>
                    <textarea 
                        type        = "text" 
                        class       = "form-control <?php echo form_error('description') ? 'is-invalid' : '' ;?>" 
                        id          = "description" 
                        name        = "description" 
                        placeholder = "Tell about your company ... "
                        rows        = 5
                    ><?php echo set_value('description'); ?></textarea>
                    <small class="invalid-feedback"><?php echo form_error('website')?></small>
                </div>

                <!-- WEBSITE FIELD -->
                <div class="form-group">
                    <label for="website">Website</label>
                    <div class="input-group">
                        <div class="input-group">
                            <input 
                                type        = "text" 
                                class       = "form-control <?php echo form_error('website') ? 'is-invalid' : '' ;?>" 
                                id          = "website" 
                                name        = "website" 
                                value       = "<?php echo set_value('website'); ?>"
                                placeholder = "Website"
                            >
                            <div class="input-group-append">
                                <span class="input-group-text text-info bg-white">
                                    <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="top" title="This field is not required"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <small class="invalid-feedback"><?php echo form_error('website')?></small>
                </div>
                
            </div>

        </div>

        <!-- CONTACT INFORMATION FORM -->
        <div class="card border-0">

            <div class="card-header h6 bg-white border-primary">
                <i class="fas fa-phone-alt text-primary mr-2"></i>
                <span>Contact Information</span>
            </div>

            <div class="card-body">

                <!-- CONTACT FIELD -->
                <div class="form-row">

                    <!-- CONTACT NUMBER -->
                    <div class="form-group col-md">
                        <label for="contactNumber">Contact Number</label>
                        <span class="text-danger">*</span>
                        <input 
                            type        = "text" 
                            class       = "form-control <?php echo form_error('contactNumber') ? 'is-invalid' : '' ;?>" 
                            id          = "contactNumber" 
                            name        = "contactNumber" 
                            value       = "<?php echo set_value('contactNumber'); ?>"
                            placeholder = "Phone/Telephone"
                        >
                        <small class="invalid-feedback" id="retypePasswordFeedback"><?php echo form_error('contactNumber')?></small>
                    </div>

                    <!-- COMPANY EMAIL -->
                    <div class="form-group col-md">
                        <label for="email">Email</label>
                        <span class="text-danger">*</span>
                        <input 
                            type        = "email" 
                            class       = "form-control <?php echo form_error('email') ? 'is-invalid' : '' ;?>" 
                            id          = "email" 
                            name        = "email" 
                            value       = "<?php echo set_value('email'); ?>"
                            placeholder = "Email" 
                        >
                        <small class="invalid-feedback"><?php echo form_error('email')?></small>
                    </div>

                </div>

            </div>

        </div>

        <!-- ACCOUNT INFORMATION FORM -->
        <div class="card border-0">

            <div class="card-header h6 bg-white border-primary">
                <i class="fas fa-user-tie text-primary mr-2"></i>
                <span>Account Information</span>
            </div>

            <div class="card-body">

                <!-- PASSWORD FIELD -->
                <div class="form-row">

                    <!-- PASSWORD -->
                    <div class="form-group col-md">
                        <label for="password">Password</label>
                        <span class="text-danger">*</span>
                        <input 
                            type        = "password" 
                            class       = "form-control  <?php echo form_error('password') ? 'is-invalid' : '' ;?>" 
                            id          = "password" 
                            name        = "password" 
                            placeholder = "Password" 
                        >
                        <small class="invalid-feedback"><?php echo form_error('password')?></small>
                    </div>

                    <!-- REPEAT PASSWORD -->
                    <div class="form-group col-md">
                        <label for="retypePassword">Retype Password to confirm</label>
                        <span class="text-danger">*</span>
                        <input 
                            type        = "password" 
                            class       = "form-control <?php echo form_error('retypePassword') ? 'is-invalid' : '' ;?>" 
                            id          = "retypePassword" 
                            name        = "retypePassword" 
                            placeholder = "Retype password to confirm" 
                        >
                        <small class="invalid-feedback" id="retypePasswordFeedback"><?php echo form_error('retypePassword')?></small>
                    </div>

                </div>

                <!-- CHECKBOX FOR USER AGREEMENT IN TERMS AND CONDITIONS -->
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input 
                            type    = "checkbox" 
                            class   = "custom-control-input <?php echo form_error('agreement') ? 'is-invalid' : '' ;?>" 
                            id      = "agreement" 
                            name    = "agreement"
                        >
                        <label class="custom-control-label" for="agreement">
                            I already read and agree to the <a href="<?php echo base_url() ?>home/terms_and_conditions" data-toggle="tooltip" data-placement="top" title="Read our Terms and Conditions">Terms and Conditions</a> of this website.
                        </label>
                        <span class="text-danger">*</span>
                        <small class="invalid-feedback" id="retypePasswordFeedback"><?php echo form_error('agreement')?></small>
                    </div>
                </div>

            </div>

        </div>

        <!-- USER CONTROLS -->
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Register as an Employer</button>
        </div>

    </form>

</div>
</div>

<script>
    
</script>