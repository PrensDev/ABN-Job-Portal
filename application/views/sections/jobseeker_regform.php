
<div class="container-fluid py-5">
<div class="container">

    <h1 class="display-4">Register as <span class="text-primary">Job Seeker</span></h1>
    <p class="text-secondary">Create your account and find the job you want to apply.</p>

    <p class="text-danger"><small>* Required</small></p>

    <!-- JOBSEEKER REGISTRATION FORM -->
    <form method="POST" novalidate>

        <!-- PERSONAL INFORMATION FORM -->
        <div class="card border-0">

            <div class="card-header h6 bg-white border-primary">
                <i class="fas fa-user-tie text-primary mr-2"></i>
                <span>Personal Information</span>
            </div>
            
            <div class="card-body">
                
                <!-- NAME FIELD -->
                <div class="form-row">

                    <!-- FIRST NAME -->
                    <div class="form-group col-md">
                        <label for="firstName">First Name</label>
                        <span class="text-danger">*</span>
                        <input 
                            type        = "text" 
                            class       = "form-control <?php echo form_error('firstName') ? 'is-invalid' : '' ?>" 
                            id          = "firstName" 
                            name        = "firstName"
                            value       = "<?php echo set_value('firstName'); ?>"
                            placeholder = "First Name"
                        >
                        <small class="invalid-feedback"><?php echo form_error('firstName')?></small>
                    </div>
                    
                    <!-- MIDDLE NAME -->
                    <div class="form-group col-md">
                        <label for="middleName">Middle Name</label>
                        <div class="input-group">
                            <input 
                                type        = "text" 
                                class       = "form-control" 
                                id          = "middleName" 
                                name        = "middleName"
                                value       = "<?php echo set_value('middleName'); ?>"
                                placeholder = "Middle Name"
                            >
                            <div class="input-group-append">
                                <span class="input-group-text text-info bg-white">
                                    <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="top" title="Middle name is not required"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- LAST NAME -->
                    <div class="form-group col-md">
                        <label for="lastName">Last Name</label>
                        <span class="text-danger">*</span>
                        <input
                            type        = "text" 
                            class       = "form-control <?php echo form_error('lastName') ? 'is-invalid' : '' ?>" 
                            id          = "lastName" 
                            name        = "lastName"
                            value       = "<?php echo set_value('lastName'); ?>"
                            placeholder = "Last Name"
                        >
                        <small class="invalid-feedback"><?php echo form_error('lastName')?></small>
                    </div>

                </div>

                <!-- BIRTHDATE AND GENDER FIELD -->
                <div class="form-row">

                    <!-- DATE OF BIRTH -->
                    <div class="form-group col-md">
                        <label for="birthDate">Date of Birth</label>
                        <span class="text-danger">*</span>
                        <input 
                            type    = "date" 
                            class   = "form-control <?php echo form_error('birthDate') ? 'is-invalid' : '' ?>" 
                            id      = "birthDate" 
                            value   = "<?php echo set_value('birthDate'); ?>"
                            name    = "birthDate" 
                        >
                        <small class="invalid-feedback"><?php echo form_error('birthDate')?></small>
                    </div>

                    <!-- GENDER -->
                    <div class="form-group col-md">
                        <label for="gender">Gender</label>
                        <span class="text-danger">*</span>
                        <select 
                            class       = "selectpicker show-tick form-control border <?php echo form_error('gender') ? 'is-invalid' : '' ?>" 
                            data-style  = "bg-white text-dark" 
                            title       = "Please select your gender ..." 
                            id          = "gender"
                            name        = "gender"
                        >
                            <option value="Male" <?php echo set_value('gender') == 'Male' ? 'selected' : '' ?>>Male</option>
                            <option value="Female" <?php echo set_value('gender') == 'Female' ? 'selected' : '' ?>>Female</option>
                            <option value="LGBTQA++" <?php echo set_value('gender') == 'LGBTQA++' ? 'selected' : '' ?>>LGBTQA++</option>
                            <option value="Prefer not to say" <?php echo set_value('gender') == 'Prefer not to say' ? 'selected' : '' ?>>Prefer not to say</option>
                        </select>
                        <small class="invalid-feedback"><?php echo form_error('gender')?></small>
                    </div>

                </div>

                <!-- LOCATION FIELD -->
                <div class="form-row">

                    <!-- CITY/MUNICIPALITY NAME -->
                    <div class="form-group col-md">
                        <label for="cityProvince">City and State / Province</label>
                        <span class="text-danger">*</span>
                        <input 
                            type        = "text" 
                            class       = "form-control <?php echo form_error('cityProvince') ? 'is-invalid' : '' ?>" 
                            id          = "cityProvince"
                            name        = "cityProvince"
                            value       = "<?php echo set_value('cityProvince'); ?>"
                            placeholder = "City and state / Province"
                        >
                        <small class="invalid-feedback"><?php echo form_error('cityProvince')?></small>
                    </div>

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
                            class       = "form-control <?php echo form_error('contactNumber') ? 'is-invalid' : '' ?>" 
                            id          = "contactNumber"
                            name        = "contactNumber"
                            value       = "<?php echo set_value('contactNumber'); ?>"
                            placeholder = "Contact Number"
                        >
                        <small class="invalid-feedback"><?php echo form_error('contactNumber')?></small>
                    </div>

                    <!-- EMAIL ADDRESS -->
                    <div class="form-group col-md">
                        <label for="email">Email Address</label>
                        <span class="text-danger">*</span>
                        <input 
                            type        = "email" 
                            class       = "form-control <?php echo form_error('email') ? 'is-invalid' : '' ?>" 
                            id          = "email"
                            name        = "email"
                            value       = "<?php echo set_value('email'); ?>"
                            placeholder = "Email" 
                        >
                        <small class="invalid-feedback"><?php echo form_error('email')?></small>
                    </div>
                </div>
                <!-- CONTACT FIELD -->

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
                        <div class="input-group">
                            <input 
                                type        = "password" 
                                class       = "form-control <?php echo form_error('password') ? 'is-invalid' : '' ?>" 
                                id          = "password" 
                                name        = "password"
                                placeholder = "Password"
                            >
                            <div class="input-group-append">
                                <span class="input-group-text text-info bg-white">
                                    <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="top" title="Password must be 8 characters and above containing an uppercase letter, lowecase letter, number, and special character."></i>
                                </span>
                            </div>
                            <small class="invalid-feedback"><?php echo form_error('password')?></small>
                        </div>
                    </div>

                    <!-- REPEAT PASSWORD -->
                    <div class="form-group col-md">
                        <label for="retypePassword">Retype Password to confirm</label>
                        <span class="text-danger">*</span>
                        <input
                            type        = "password" 
                            class       = "form-control <?php echo form_error('retypePassword') ? 'is-invalid' : '' ?>" 
                            id          = "retypePassword" 
                            name        = "retypePassword"
                            placeholder = "Password"
                        >
                        <small class="invalid-feedback"><?php echo form_error('retypePassword')?></small>
                    </div>

                </div>
                <!-- END OF PASSWORD FIELD -->

                <!-- CHECKBOX FOR USER AGREEMENT IN TERMS AND CONDITIONS -->
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input 
                            type    = "checkbox" 
                            class   = "custom-control-input <?php echo form_error('retypePassword') ? 'is-invalid' : '' ?>" 
                            id      = "agreement"
                            name    = "agreement"
                        >
                        <label class="custom-control-label" for="agreement">
                            I already read and agree to the <a href="<?php echo base_url() ?>home/terms_and_conditions" data-toggle="tooltip" data-placement="top" title="Read our Terms and Conditions">Terms and Conditions</a> of this website.
                        </label>
                        <span class="text-danger">*</span>
                        <small class="invalid-feedback"><?php echo form_error('agreement')?></small>
                    </div>
                </div>
                <!-- END OF CHECKBOX FOR USER AGREEMENT IN TERMS AND CONDITIONS -->

            </div>

        </div>

        <!-- USER CONTROLS -->
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Register as Job Seeker</button>
        </div>

    </form>
    
</div>
</div>