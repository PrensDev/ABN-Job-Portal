<!-- FORM SECTION -->
<div class="container-fluid py-3">
<div class="container">

    <!-- <div class="alert alert-danger alert-dismissible fade show my-4" role="alert">
        <span>You entered some <strong>invalid</strong> input.</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div> -->

    <!-- JOBSEEKER REGISTRATION FORM -->
    <form method="POST" novalidate>

        <!-- PERSONAL INFORMATION FORM -->
        <div class="card border-secondary my-4">

            <div class="card-header h6 bg-secondary text-white">
                <i class="fas fa-user mr-2"></i>
                <span>Personal Information</span>
            </div>
            
            <div class="card-body">
                
                <!-- NAME FIELD -->
                <div class="form-row">

                    <!-- FIRST NAME -->
                    <div class="form-group col-md">
                        <label for="firstName">First Name</label>
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
                <!-- END OF NAME FIELD -->

                <!-- BIRTHDATE AND GENDER FIELD -->
                <div class="form-row">

                    <!-- DATE OF BIRTH -->
                    <div class="form-group col-md">
                        <label for="birthDate">Date of Birth</label>
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
                        <select 
                            class       = "selectpicker show-tick form-control border <?php echo form_error('gender') ? 'is-invalid' : '' ?>" 
                            data-style  = "bg-white text-dark" 
                            title       = "Please select your gender ..." 
                            id          = "gender"
                            name        = "gender"
                            value       = "<?php echo set_value('gender'); ?>"
                        >
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="LGBTQA++">LGBTQA++</option>
                            <option value="Prefer not to say">Prefer not to say</option>
                        </select>
                        <small class="invalid-feedback"><?php echo form_error('gender')?></small>
                    </div>

                </div>
                <!-- END OF BIRTHDATE AND GENDER FIELD -->

                <!-- ADDRESS FIELD -->
                <div class="form-row">

                    <!-- STREET NAME -->
                    <div class="form-group col-md">
                        <label for="street">Street Name</label>
                        <input 
                            type        = "text" 
                            class       = "form-control <?php echo form_error('street') ? 'is-invalid' : '' ?>" 
                            id          = "street"
                            name        = "street"
                            value       = "<?php echo set_value('street'); ?>"
                            placeholder = "Street Name"
                        >
                        <small class="invalid-feedback"><?php echo form_error('street')?></small>
                    </div>

                    <!-- BARANGGAY/DISTRICT NAME -->
                    <div class="form-group col-md">
                        <label for="brgyDistrict">Baranggay/District Name</label>
                        <input 
                            type        = "text" 
                            class       = "form-control <?php echo form_error('brgyDistrict') ? 'is-invalid' : '' ?>" 
                            id          = brgyDistrict 
                            name        = "brgyDistrict" 
                            value       = "<?php echo set_value('brgyDistrict'); ?>"
                            placeholder = "Baranggay/District Name"
                        >
                        <small class="invalid-feedback"><?php echo form_error('brgyDistrict')?></small>
                    </div>

                    <!-- CITY/MUNICIPALITY NAME -->
                    <div class="form-group col-md">
                        <label for="cityMunicipality">City/Municipality Name</label>
                        <input 
                            type        = "text" 
                            class       = "form-control <?php echo form_error('cityMunicipality') ? 'is-invalid' : '' ?>" 
                            id          = "cityMunicipality"
                            name        = "cityMunicipality"
                            value       = "<?php echo set_value('cityMunicipality'); ?>"
                            placeholder = "City/Municipality Name"
                        >
                        <small class="invalid-feedback"><?php echo form_error('cityMunicipality')?></small>
                    </div>

                </div>
                <!-- ADDRESS FIELD -->
                
            </div>

        </div>
        <!-- END OF PERSONAL INFORMATION FORM -->

        <!-- CONTACT INFORMATION FORM -->
        <div class="card border-secondary my-4">

            <div class="card-header h6 bg-secondary text-white">
                <i class="fas fa-phone-alt mr-2"></i>
                <span>Contact Information</span>
            </div>

            <div class="card-body">

                <!-- CONTACT FIELD -->
                <div class="form-row">

                    <!-- CONTACT NUMBER -->
                    <div class="form-group col-md">
                        <label for="contactNumber">Contact Number</label>
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
        <!-- END OF CONTACT INFORMATION FORM -->

        <!-- CURRICULUM VITAE CONTENT -->
        <div class="card border-secondary my-4">

            <div class="card-header h6 bg-secondary text-white">
                <i class="fas fa-file-contract mr-2"></i>
                <span>Curriculum Vitae</span>
            </div>

            <div class="card-body">

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea 
                        type        = "text" 
                        class       = "form-control <?php echo form_error('description') ? 'is-invalid' : '' ?>" 
                        id          = "description"
                        name        = "description"
                        placeholder = "Description about yourself ..."
                        rows        = 5
                    ><?php echo set_value('description'); ?></textarea>
                    <small class="invalid-feedback"><?php echo form_error('description')?></small>
                </div>

                <div class="form-group">
                    <label for="skills">Skills</label>
                    <textarea 
                        type        = "text" 
                        class       = "form-control <?php echo form_error('skills') ? 'is-invalid' : '' ?>" 
                        id          = "skills"
                        name        = "skills"
                        placeholder = "List your skills here ..."
                        rows        = 5
                    ><?php echo set_value('skills'); ?></textarea>
                    <small class="invalid-feedback"><?php echo form_error('skills')?></small>
                </div>

                <div class="form-group">
                    <label for="experiences">Experiences</label>
                    <textarea 
                        type        = "text" 
                        class       = "form-control <?php echo form_error('experiences') ? 'is-invalid' : '' ?>" 
                        id          = "experiences"
                        name        = "experiences"
                        placeholder = "Mention your experiences here ..."
                        rows        = 5
                    ><?php echo set_value('experiences'); ?></textarea>
                    <small class="invalid-feedback"><?php echo form_error('experiences')?></small>
                </div>

                <div class="form-group">
                    <label for="education">Education</label>
                    <textarea 
                        type        = "text" 
                        class       = "form-control <?php echo form_error('education') ? 'is-invalid' : '' ?>" 
                        id          = "education"
                        name        = "education"
                        placeholder = "Description about yourself ..."
                        rows        = 5
                    ><?php echo set_value('education'); ?></textarea>
                    <small class="invalid-feedback"><?php echo form_error('education')?></small>
                </div>
            
            </div>

        </div>

        <!-- END OF CURRICULUM VITAE CONTENT -->

        <!-- ACCOUNT INFORMATION FORM -->
        <div class="card border-secondary my-4">

            <div class="card-header h6 bg-secondary text-white">
                <i class="fas fa-user-tie mr-2"></i>
                <span>Account Information</span>
            </div>

            <div class="card-body">

                <!-- PASSWORD FIELD -->
                <div class="form-row">

                    <!-- PASSWORD -->
                    <div class="form-group col-md">
                        <label for="password">Password</label>
                        <div class="input-group">
                            <input 
                                type        = "password" 
                                class       = "form-control <?php echo form_error('password') ? 'is-invalid' : '' ?>" 
                                id          = "password" 
                                name        = "password"
                                placeholder = "Password"
                            >
                            <div class="input-group-append">
                                <span class="input-group-text bg-white" id="togglePassword">
                                    <i class="fas fa-eye" id="passwordIcon"></i>
                                </span>
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
                        <div class="input-group">
                            <input
                                type        = "password" 
                                class       = "form-control <?php echo form_error('retypePassword') ? 'is-invalid' : '' ?>" 
                                id          = "retypePassword" 
                                name        = "retypePassword"
                                placeholder = "Password"
                            >
                            <div class="input-group-append">
                                <span class="input-group-text bg-white" id="toggleRetypePassword">
                                    <i class="fas fa-eye" id="retypePasswordIcon"></i>
                                </span>
                            </div>
                            <small class="invalid-feedback"><?php echo form_error('retypePassword')?></small>
                        </div>
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
                            I agree to the <a href="terms_and_conditions.html" data-toggle="tooltip" data-placement="top" title="Read our Terms and Conditions">Terms and Conditions</a> of this website.
                        </label>
                        <small class="invalid-feedback"><?php echo form_error('agreement')?></small>
                    </div>
                </div>
                <!-- END OF CHECKBOX FOR USER AGREEMENT IN TERMS AND CONDITIONS -->

            </div>

        </div>
        <!-- END OF ACCOUNT INFORMATION FORM -->

        <!-- USER CONTROLS -->
        <div class="d-flex justify-content-center my-4">
            <button type="submit" class="btn btn-primary btn-lg">Register as Job Seeker</button>
        </div>
        <!-- END OF USER CONTROLS -->

    </form>
    <!-- END OF JOBSEEKER REGISTRATION FORM -->

</div>
</div>
<!-- END OF FORM SECTION -->