<!-- COMPANY PROFILE DETAILS SECTION -->
<div class="container-fluid">
<div class="container-md py-5">

    <!-- HEADER OF CONTENT -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="font-weight-light">Information</h1>
        </div>
        <div>
            <a href="<?php echo base_url() ?>auth/edit_information" class="btn btn-primary" data-toggle="tooltip" data-placement="left" title="Edit information">
                <i class="fas fa-pen mr-1"></i>
                <span class="d-none d-sm-inline">Edit information</span>
            </a>
        </div>
    </div>

    <!-- INFORMAION DETAILS -->
    <div class="row">
        <div class="col-lg-8 mb-3 lg-0">

            <!-- USER DESCRIPTION -->
            <div class="mb-5">
                <h5 class="text-primary mb-3">
                    <i class="fas fa-users mr-2"></i>  
                    <span>About this company</span> 
                </h5>
                <p class="text-justify"><?php echo $description ?></p>
            </div>

        </div>
        
        <div class="col-lg-4">
            
            <!-- COMPANY DETAILS CARD -->
            <div class="card mb-3">
                <div class="card-header bg-white">
                    <strong>
                        <i class="fas fa-briefcase mr-2"></i>
                        <span>Company Details</span>    
                    </strong>
                </div>
                <div class="card-body p-0">
                    
                    <div class="list-group list-group-flush">

                        <div class="list-group-item d-flex border-0">
                            <div class="list-group-item-icon h5 text-danger">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <p class="m-0 font-weight-bold">Location</p>
                                <p class="m-0"><?php echo $location ?></p>
                            </div>
                        </div>

                        <div class="list-group-item d-flex border-0">
                            <div class="list-group-item-icon h5 text-danger">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div>
                                <p class="m-0 font-weight-bold">Contact Number</p>
                                <p class="m-0"><?php echo $contactNumber ?></p>
                            </div>
                        </div>

                        <div class="list-group-item d-flex border-0">
                            <div class="list-group-item-icon h5 text-danger">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div>
                                <p class="m-0 font-weight-bold">Email</p>
                                <p class="m-0"><?php echo $email ?></p>
                            </div>
                        </div>
                
                        <div class="list-group-item d-flex border-0">
                            <div class="list-group-item-icon h5 text-danger">
                                <i class="fas fa-globe-asia"></i>
                            </div>
                            <div>
                                <p class="m-0 font-weight-bold">Website</p>
                                <p class="m-0">
                                    <?php 

                                    if ($website != '' ) {
                                        echo '
                                            <a href="' . $website . '" class="btn btn-primary btn-sm mt-1" target="_blank" data-toggle="tooltip" data-placement="left" title="' . $website . '">
                                                <i class="fas fa-external-link-alt"></i>
                                                <span>Go to this website</span>
                                            </a> 
                                        ';
                                    }
                                    else {
                                        echo "You don't have a website yet.";
                                    }
                                    ?>
                                </p>
                            </div>
                        </div>
                        
                    </div>
                
                </div>
            </div>
            <!-- END OF COMPANY DETAILS CARD -->

        </div>

    </div>
    <!-- END OF INFORMATION DETAILS -->

</div>
</div>