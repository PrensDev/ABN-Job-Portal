<?php

$companyName      = set_value( 'companyName'      ) == '' ? $companyName      : set_value( 'companyName'      );
$street           = set_value( 'street'           ) == '' ? $street           : set_value( 'street'           );
$brgyDistrict     = set_value( 'brgyDistrict'     ) == '' ? $brgyDistrict     : set_value( 'brgyDistrict'     );
$cityMunicipality = set_value( 'cityMunicipality' ) == '' ? $cityMunicipality : set_value( 'cityMunicipality' );
$description      = set_value( 'description'      ) == '' ? $description      : set_value( 'description'      );
$website          = set_value( 'website'          ) == '' ? $website          : set_value( 'website'          );
$contactNumber    = set_value( 'contactNumber'    ) == '' ? $contactNumber    : set_value( 'contactNumber'    );

?>


<form method="POST">
<div class="container-fluid py-3 user-select-none">
<div class="container py-5">

    <!-- HEADER OF CONTENT -->
    <div class="mb-4">
        <h1 class="font-weight-normal">Edit Information</h1>
        <p class="text-secondary">Modify your information here and save your changes.</p>
    </div>

    <!-- COMPANY INFORMATION FORM -->
    <div class="card border-secondary my-4">

        <div class="card-header h6 bg-secondary text-white">
            <i class="fas fa-briefcase mr-2"></i>
            <span>Edit information</span>
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
                    <label for="brgyDistrict">Baranggay/District Name</label>
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

                <!-- CITY/MUNICIPALITY -->
                <div class="form-group col-md">
                    <label for="cityMunicipality">City/Municipality Name</label>
                    <input  
                        type        = "text" 
                        class       = "form-control <?php echo form_error('cityMunicipality') ? 'is-invalid' : '' ;?>" 
                        id          = "cityMunicipality" 
                        name        = "cityMunicipality"
                        value       = "<?php echo $cityMunicipality ?>"
                        placeholder = "City/Municipality"
                    >
                    <small class="invalid-feedback" id="retypePasswordFeedback"><?php echo form_error('cityMunicipality')?></small>
                </div>
                
            </div>
            <!-- END OF ADDRESS FIELD -->

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
                ><?php echo $description ?></textarea>
                <small class="invalid-feedback"><?php echo form_error('website')?></small>
            </div>
            <!-- END OF DESCRIPTION FIELD -->

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
            <!-- END OF WEBSITE FIELD -->
            
        </div>

    </div>
    <!-- END OF COMPANY INFORMATION FORM -->
    
    <!-- CONTACT INFORMATION FORM -->
    <div class="card border-secondary my-4">

        <div class="card-header h6 bg-secondary text-white">
            <i class="fas fa-phone-alt mr-2"></i>
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
                        value       = "<?php echo $contactNumber ?>"
                        placeholder = "Phone/Telephone"
                    >
                    <small class="invalid-feedback" id="retypePasswordFeedback"><?php echo form_error('contactNumber')?></small>
                </div>

            </div>
            <!-- END OF CONTACT FIELD -->

        </div>

    </div>
    <!-- END OF CONTACT INFORMATION FORM -->

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