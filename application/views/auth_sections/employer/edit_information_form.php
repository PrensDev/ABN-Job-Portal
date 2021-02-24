<?php

$companyName   = set_value( 'companyName'   ) == '' ? $companyName   : set_value( 'companyName'   );
$street        = set_value( 'street'        ) == '' ? $street        : set_value( 'street'        );
$brgyDistrict  = set_value( 'brgyDistrict'  ) == '' ? $brgyDistrict  : set_value( 'brgyDistrict'  );
$cityProvince  = set_value( 'cityProvince'  ) == '' ? $cityProvince  : set_value( 'cityProvince'  );
$description   = set_value( 'description'   ) == '' ? $description   : set_value( 'description'   );
$website       = set_value( 'website'       ) == '' ? $website       : set_value( 'website'       );
$contactNumber = set_value( 'contactNumber' ) == '' ? $contactNumber : set_value( 'contactNumber' );

?>

<form method="POST" id="editInffoForm">
<div class="container-fluid py-3 user-select-none">
<div class="container py-5">

    <!-- HEADER OF CONTENT -->
    <h1 class="font-weight-light">Edit <span class="text-primary">information</span></h1>
    <p class="text-secondary">Modify your information here and save your changes.</p>

    <p class="text-danger"><small>* Required</small></p>

    <!-- COMPANY INFORMATION FORM -->
    <div class="card border-0">

        <div class="card-header h6 bg-white border-primary">
            <i class="fas fa-briefcase text-primary mr-2"></i>
            <span>Basic information</span>
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
                    value       = "<?php echo $companyName ?>"
                    placeholder = "Company Name"
                >
                <small class="invalid-feedback" id="retypePasswordFeedback"><?php echo form_error('companyName')?></small>
            </div>

            <!-- ADDRESS FIELD -->
            <div class="form-row">

                <!-- STREET NAME -->
                <div class="form-group col-md">
                    <label for="street">Street Name</label>
                    <span class="text-danger">*</span>
                    <input 
                        type        = "text" 
                        class       = "form-control <?php echo form_error('street') ? 'is-invalid' : '' ;?>" 
                        id          = "street"
                        name        = "street" 
                        value       = "<?php echo $street ?>"
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
                        value       = "<?php echo $brgyDistrict ?>"
                        placeholder = "Baranggay/District Name" 
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
                        value       = "<?php echo $cityProvince ?>"
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
                ><?php echo $description ?></textarea>
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
                            value       = "<?php echo $website ?>"
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
                        value       = "<?php echo $contactNumber ?>"
                        placeholder = "Phone/Telephone"
                    >
                    <small class="invalid-feedback" id="retypePasswordFeedback"><?php echo form_error('contactNumber')?></small>
                </div>

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
        <button type="sumbit" class="btn btn-primary" id="submitBtn">
            <i class="fas fa-check"></i>
            <span>Submit</span>
        </button>
    </div>

</div>
</div>
</div>
</form>

<script>
$(document).ready(function () {
    $("#editInffoForm").submit(function () {
        var submitBtn = $("#submitBtn");
        submitBtn.attr("disabled", true);
        submitBtn.prepend('<span class="spinner-border spinner-border-sm mr-1" role="status" aria-hidden="true"></span>');
        return true;
    });
});
</script>