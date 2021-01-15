<!-- COMPANY PROFILE DETAILS SECTION -->
<div class="container-fluid">
<div class="container py-5">

<?php $this->load->view('sections/company_header', $employerDetails) ?>

<div class="row">

    <!-- COMPANY DESCRIPTION AND AVAILABLE JOBS -->
    <div class="col-lg-8 mb-3">
        <div class="mb-5">
            <h5 class="text-primary mb-3">
                <i class="fas fa-users mr-2"></i>  
                <span>About Our Company</span> 
            </h5>
            <p class="text-justify"><?php echo $description ?></p>
        </div>

        <div class="text-center">
            <a href="<?php echo base_url() . 'companies/available_jobs/' . $employerID ?>" class="btn btn-primary">View all available jobs</a>
        </div>
    </div>
    
    <!-- COMPANY SUMMARY -->
    <div class="col-lg-4">

        <?php
            if ($this->session->userType == 'Employer') {
                if ($this->session->id == $employerID) {
        ?>
            <div class="d-flex justify-content-between alert alert-primary p-3 mb-3">
                <div class="mr-3">
                    <span>Do you want to edit your info?</span>
                </div>
                <div class="text-nowrap">
                    <i class="fas fa-pen text-primary"></i>
                    <a href="<?php echo base_url() ?>auth/edit_information">
                        <span>Edit</span>
                    </a>
                </div>
            </div>
        <?php
                }
            }
        ?>
        
        <!-- COMPANY DETAILS CARD -->
        <div class="card">
            <div class="card-header bg-white">
                <strong>Company Details</strong>
            </div>
            <div class="card-body p-0">
                
                <div class="list-group list-group-flush">

                    <!-- LOCATION -->
                    <div class="list-group-item d-flex border-0">
                        <div class="list-group-item-icon h5 text-danger">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <p class="m-0 font-weight-bold">Location</p>
                            <p class="m-0"><?php echo $location ?></p>
                        </div>
                    </div>

                    <!-- CONTACT NUMBER -->
                    <div class="list-group-item d-flex border-0">
                        <div class="list-group-item-icon h5 text-danger">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div>
                            <p class="m-0 font-weight-bold">Contact Number</p>
                            <p class="m-0"><?php echo $contactNumber ?></p>
                        </div>
                    </div>

                    <!-- EMAIL -->
                    <div class="list-group-item d-flex border-0">
                        <div class="list-group-item-icon h5 text-danger">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <p class="m-0 font-weight-bold">Email</p>
                            <p class="m-0"><?php echo $email ?></p>
                        </div>
                    </div>

                    <?php if ($website != '') { ?>
                        <!-- COMPANY WEBSITE -->
                        <div class="list-group-item d-flex">
                            <div class="list-group-item-icon h3 text-danger">
                                <i class="fas fa-globe-asia"></i>
                            </div>
                            <div>
                                <p class="m-0 font-weight-bold">Website</p>
                                <p class="m-0">
                                    <a 
                                        href            = "<?php echo $website ?>" 
                                        class           = "btn btn-primary btn-sm mt-1" 
                                        target          = "_blank" 
                                        data-toggle     = "tooltip" 
                                        data-placement  = "left" 
                                        title           = "<?php echo $website ?>"
                                    >
                                        <i class="fas fa-external-link-alt"></i>
                                        <span>Go to this website</span>
                                    </a> 
                                </p>
                            </div>
                        </div>
                    <?php } ?>

                </div>
            
            </div>
        </div>

    </div>
    
</div>
</div>
</div>