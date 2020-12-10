<?php

$firstName        = set_value( 'firstName'        ) == '' ? $firstName        : set_value( 'firstName'        );
$middleName       = set_value( 'middleName'       ) == '' ? $middleName       : set_value( 'middleName'       );
$lastName         = set_value( 'lastName'         ) == '' ? $lastName         : set_value( 'lastName'         );
$birthDate        = set_value( 'birthDate'        ) == '' ? $birthDate        : set_value( 'birthDate'        );
$gender           = set_value( 'gender'           ) == '' ? $gender           : set_value( 'gender'           );
$street           = set_value( 'street'           ) == '' ? $street           : set_value( 'street'           );
$brgyDistrict     = set_value( 'brgyDistrict'     ) == '' ? $brgyDistrict     : set_value( 'brgyDistrict'     );
$cityMunicipality = set_value( 'cityMunicipality' ) == '' ? $cityMunicipality : set_value( 'cityMunicipality' );
$description      = set_value( 'description'      ) == '' ? $description      : set_value( 'description'      );
$skills           = set_value( 'skills'           ) == '' ? $skills           : set_value( 'skills'           );
$experiences      = set_value( 'experiences'      ) == '' ? $experiences      : set_value( 'experiences'      );
$education        = set_value( 'education'        ) == '' ? $education        : set_value( 'education'        );

?>

<form method="POST">

<div class="container-fluid py-3 user-select-none">
<div class="container">

    <!-- HEADER OF CONTENT -->
    <div class="mb-4">
        <h1 class="font-weight-normal">Edit Information</h1>
    </div>

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
                        value       = "<?php echo $firstName ?>"
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
                            value       = "<?php echo $middleName ?>"
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
                        value       = "<?php echo $lastName ?>"
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
                        value   = "<?php echo $birthDate ?>"
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
                    >
                        <option value="Male" <?php echo $gender == 'Male' ? 'selected' : '' ?>>Male</option>
                        <option value="Female" <?php echo $gender == 'Female' ? 'selected' : '' ?>>Female</option>
                        <option value="LGBTQA++" <?php echo $gender == 'LGBTQA++' ? 'selected' : '' ?>>LGBTQA++</option>
                        <option value="Prefer not to say" <?php echo $gender == 'Prefer not to say' ? 'selected' : '' ?>>Prefer not to say</option>
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
                        value       = "<?php echo $street ?>"
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
                        value       = "<?php echo $brgyDistrict ?>"
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
                        value       = "<?php echo $cityMunicipality ?>"
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
                        value       = "<?php echo $contactNumber ?>"
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
                        value       = "<?php echo $email ?>"
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
                ><?php echo $description ?></textarea>
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
                ><?php echo $skills ?></textarea>
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
                ><?php echo $experiences ?></textarea>
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
                ><?php echo $education ?></textarea>
                <small class="invalid-feedback"><?php echo form_error('education')?></small>
            </div>
        
        </div>

    </div>
    <!-- END OF CURRICULUM VITAE CONTENT -->

    <!-- USER CONTROLS -->
    <div class="d-flex justify-content-center my-4">
        <button type="button" class="mx-1 btn btn-primary" data-toggle="modal" data-target="#saveChangesModal">Save Changes</button>
        <button onclick="history.back()" type="button" class="mx-1 btn btn-secondary">Cancel</button>
    </div>


</div>
</div>

<!-- SAVE CHANGES MODAL -->
<div class="modal fade user-select-none" id="saveChangesModal" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content">

    <div class="modal-header">
        <h5 class="modal-title text-primary">
            <i class="fas fa-pen mr-2"></i>
            <span>Save changes</span>
        </h5>
        <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <div class="modal-body">
    <div class="d-flex">
            <div class="mr-2">
                <i class="fas fa-exclamation-triangle text-warning mr-2"></i>
            </div>
            <div>
                <span>Are you sure you want to save this changes?</span>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="sumbit" class="btn btn-primary">
            <i class="fas fa-check"></i>
            <span>Submit</span>
        </button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
            <i class="fas fa-times"></i>
            <span>Cancel</span>
        </button>
    </div>

</div>
</div>
</div>

</form>
