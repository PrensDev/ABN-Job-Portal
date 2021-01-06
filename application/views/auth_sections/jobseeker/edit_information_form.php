<?php

$firstName    = set_value( 'firstName'    ) == '' ? $firstName    : set_value( 'firstName'    );
$middleName   = set_value( 'middleName'   ) == '' ? $middleName   : set_value( 'middleName'   );
$lastName     = set_value( 'lastName'     ) == '' ? $lastName     : set_value( 'lastName'     );
$birthDate    = set_value( 'birthDate'    ) == '' ? $birthDate    : set_value( 'birthDate'    );
$gender       = set_value( 'gender'       ) == '' ? $gender       : set_value( 'gender'       );
$cityProvince = set_value( 'cityProvince' ) == '' ? $cityProvince : set_value( 'cityProvince' );

?>

<form method="POST">

<div class="container-fluid py-5 user-select-none">
<div class="container">

    <h1 class="font-weight-light">Edit <span class="text-primary">information</span></h1>
    <p class="text-secondary">Modify your information here and save your changes.</p>

    <p class="text-danger"><small>* Required</small></p>

    <!-- PERSONAL INFORMATION FORM -->
    <div class="card border-0">

        <div class="card-header h6 bg-white border-primary">
            <i class="fas fa-user text-primary mr-2"></i>
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
                    <span class="text-danger">*</span>
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
                        value   = "<?php echo $birthDate ?>"
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
                        <option value="Male" <?php echo $gender == 'Male' ? 'selected' : '' ?>>Male</option>
                        <option value="Female" <?php echo $gender == 'Female' ? 'selected' : '' ?>>Female</option>
                        <option value="LGBTQA++" <?php echo $gender == 'LGBTQA++' ? 'selected' : '' ?>>LGBTQA++</option>
                        <option value="Prefer not to say" <?php echo $gender == 'Prefer not to say' ? 'selected' : '' ?>>Prefer not to say</option>
                    </select>
                    <small class="invalid-feedback"><?php echo form_error('gender')?></small>
                </div>

            </div>
            <!-- END OF BIRTHDATE AND GENDER FIELD -->

            <!-- CITY AND STATE / PROVINCE -->
            <div class="form-group">
                <label for="cityProvince">City and state / Province</label>
                <span class="text-danger">*</span>
                <input 
                    type        = "text" 
                    class       = "form-control <?php echo form_error('cityProvince') ? 'is-invalid' : '' ?>" 
                    id          = "cityProvince"
                    name        = "cityProvince"
                    value       = "<?php echo $cityProvince ?>"
                    placeholder = "City and state / Province"
                >
                <small class="invalid-feedback"><?php echo form_error('cityProvince')?></small>
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

            <!-- CONTACT NUMBER -->
            <div class="form-group">
                <label for="contactNumber">Contact Number</label>
                <span class="text-danger">*</span>
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

        </div>

    </div>

    <!-- USER CONTROLS -->
    <div class="d-flex justify-content-center my-4">
        <button type="button" class="mx-1 btn btn-primary" data-toggle="modal" data-target="#saveChangesModal">Save Changes</button>
        <button onclick="history.back()" type="button" class="mx-1 btn btn-secondary">Cancel</button>
    </div>


</div>
</div>

<!-- SAVE CHANGES MODAL -->
<div class="modal fade user-select-none" id="saveChangesModal" data-backdrop="static" data-keyboard="false" tabindex="-1">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">

    <div class="modal-header align-items-center">
        <h5 class="modal-title text-primary">
            <i class="fas fa-pen mr-2"></i>
            <span>Save changes</span>
        </h5>
        <button type="button" class="btn text-secondary" data-dismiss="modal" aria-label="Close">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <div class="modal-body">
    <div class="d-flex">
            <div class="display-4 mr-2">
                <i class="fas fa-exclamation-circle text-primary mr-2"></i>
            </div>
            <div>
                <span>Are you sure you want to save this changes?</span>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn text-secondary" data-dismiss="modal">
            <i class="fas fa-times"></i>
            <span>Cancel</span>
        </button>
        <button type="sumbit" class="btn btn-primary">
            <i class="fas fa-check"></i>
            <span>Submit</span>
        </button>
    </div>

</div>
</div>
</div>

</form>
