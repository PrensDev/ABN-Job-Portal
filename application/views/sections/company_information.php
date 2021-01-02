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
    <!-- COMPANY DESCRIPTION AND AVAILABLE JOBS -->
    
    <!-- COMPANY SUMMARY -->
    <div class="col-lg-4">

        <?php

        if ($this->session->userType == 'Employer') {
            if ($this->session->id == $employerID) {
                echo '
                    <div class="d-flex justify-content-between alert alert-primary p-3 mb-3">
                        <div class="mr-3">
                            <span>Do you want to edit your info?</span>
                        </div>
                        <div class="text-nowrap">
                            <i class="fas fa-pen text-primary"></i>
                            <a href="' . base_url() . 'auth/edit_information">
                                <span>Edit</span>
                            </a>
                        </div>
                    </div>
                ';
            }
        }

        ?>
        
        <!-- COMPANY DETAILS CARD -->
        <div class="card">
            <div class="card-header">
                <strong>
                    <i class="fas fa-briefcase mr-2"></i>
                    <span>Company Details</span>    
                </strong>
            </div>
            <div class="card-body p-0">
                
                <div class="list-group list-group-flush">

                    <!-- LOCATION -->
                    <div class="list-group-item d-flex">
                        <div class="list-group-item-icon h4 text-danger">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <p class="m-0 font-weight-bold">Location</p>
                            <p class="m-0"><?php echo $location ?></p>
                        </div>
                    </div>

                    <!-- CONTACT NUMBER -->
                    <div class="list-group-item d-flex">
                        <div class="list-group-item-icon h4 text-danger">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div>
                            <p class="m-0 font-weight-bold">Contact Number</p>
                            <p class="m-0"><?php echo $contactNumber ?></p>
                        </div>
                    </div>

                    <!-- EMAIL -->
                    <div class="list-group-item d-flex">
                        <div class="list-group-item-icon h4 text-danger">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <p class="m-0 font-weight-bold">Email</p>
                            <p class="m-0"><?php echo $email ?></p>
                        </div>
                    </div>

                    <?php
                    
                    if ($website != '') {
                        echo '
                            <div class="list-group-item d-flex">
                                <div class="list-group-item-icon h3 text-danger">
                                    <i class="fas fa-globe-asia"></i>
                                </div>
                                <div>
                                    <p class="m-0 font-weight-bold">Website</p>
                                    <p class="m-0">
                                        <a href="' . $website . '" class="btn btn-primary btn-sm mt-1" target="_blank" data-toggle="tooltip" data-placement="left" title="' . $website . '">
                                            <i class="fas fa-external-link-alt"></i>
                                            <span>Go to this website</span>
                                        </a> 
                                    </p>
                                </div>
                            </div>
                        ';
                    }
                    
                    ?>
                </div>
            
            </div>
        </div>
        <!-- END OF COMPANY DETAILS CARD -->

    </div>
    <!-- END OF COMPANY SUMMARY -->
    
</div>
</div>
</div>
<!-- END COMPANY PROFILE DETAILS SECTION -->