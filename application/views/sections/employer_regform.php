
<!-- FORM SECTION -->
<div class="container-fluid py-3">
<div class="container">

    <!-- EMPLOYER REGISTRATION FORM -->
    <form method="POST">

        <!-- COMPANY INFORMATION FORM -->
        <div class="card my-4 border-0 shadow">

            <div class="card-header h6 bg-light border-0">
                <i class="fas fa-briefcase text-primary mr-2"></i>
                <span>Company Information</span>
            </div>
            
            <div class="card-body">
                
                <!-- COMPANY NAME -->
                <div class="form-group">
                    <label for="companyName">Company Name</label>
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
                        <label for="street">Street Name</label>
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
                        <label for="brgyDistrict">Baranggay/District Name</label>
                        <input 
                            type        = "text" 
                            class       = "form-control <?php echo form_error('brgyDistrict') ? 'is-invalid' : '' ;?>" 
                            id          = "brgyDistrict"
                            name        = "brgyDistrict" 
                            value       = "<?php echo set_value('brgyDistrict'); ?>"
                            placeholder = "Baranggay/District Name" 
                        >
                        <small class="invalid-feedback" id="retypePasswordFeedback"><?php echo form_error('brgyDistrict')?></small>
                    </div>

                    <!-- CITY/MUNICIPALITY -->
                    <div class="form-group col-md">
                        <label for="cityMunicipality">City/Municipality Name</label>
                        <input  
                            type        = "text" 
                            class       = "form-control <?php echo form_error('cityMunicipality') ? 'is-invalid' : '' ;?>" 
                            id          = "cityMunicipality" 
                            name        = "cityMunicipality"
                            value       = "<?php echo set_value('cityMunicipality'); ?>"
                            placeholder = "City/Municipality"
                        >
                        <small class="invalid-feedback" id="retypePasswordFeedback"><?php echo form_error('cityMunicipality')?></small>
                    </div>
                    
                </div>

                <!-- DESCRIPTION FIELD -->
                <div class="form-group">
                    <label for="description">Description</label>
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
        <div class="card my-4 border-0 shadow">

            <div class="card-header h6 bg-light border-0">
                <i class="fas fa-phone-alt text-primary mr-2"></i>
                <span>Contact Information</span>
            </div>

            <div class="card-body">

                <!-- CONTACT FIELD -->
                <div class="form-row">

                    <!-- PHONE/TELEPHONE NUMBER -->
                    <div class="form-group col-md">
                        <label for="contactNumber">Phone/Telephone Number</label>
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
        <div class="card my-4 border-0 shadow">

            <div class="card-header h6 bg-light border-0">
                <i class="fas fa-user-tie text-primary mr-2"></i>
                <span>Account Information</span>
            </div>

            <div class="card-body">

                <!-- PASSWORD FIELD -->
                <div class="form-row">

                    <!-- PASSWORD -->
                    <div class="form-group col-md">
                        <label for="password">Password</label>
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
                            I agree to the <a href="<?php echo base_url() ?>home/terms_and_conditions" data-toggle="tooltip" data-placement="top" title="Read our Terms and Conditions">Terms and Conditions</a> of this website.
                        </label>
                        <small class="invalid-feedback" id="retypePasswordFeedback"><?php echo form_error('agreement')?></small>
                    </div>
                </div>

            </div>

        </div>

        <!-- USER CONTROLS -->
        <div class="d-flex justify-content-center my-4">
            <button type="submit" class="btn btn-primary btn-lg">Register as an Employer</button>
        </div>

    </form>

</div>
</div>