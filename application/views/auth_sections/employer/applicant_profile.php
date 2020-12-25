<?php

if ($middleName == NULL) {
    $fullName = $firstName . ' ' . $lastName;
} else {
    $fullName = $firstName . ' ' . $middleName . ' ' . $lastName;
}

$location = $street . ', ' . $brgyDistrict . ', ' . $cityMunicipality;

?>

<div class="container-fluid py-5">
<div class="container-md">
    
    <div class="row mb-4">
        <div class="col-md-auto d-flex justify-content-center">
            <img src="<?php echo base_url() ?>public/img/97.jpg" height="125" width="125" class="rounded-pill" draggable="false">
        </div>
        
        <div class="col-md text-center text-md-left px-0 mt-3 mt-md-0">
            <h1 class="font-weight-normal"><?php echo $fullName ?></h1>
            
            <div class="d-block d-md-flex flex-wrap">
                
                <!-- LOCATION -->
                <div class="mr-3">
                    <i class="fas fa-map-marker-alt mr-1 text-danger"></i>
                    <span class=" text-secondary"><?php echo $location ?></span>
                </div>

                <!-- PHONE NUMBER -->
                <div class="mr-3">
                    <i class="fas fa-phone-alt mr-1 text-danger"></i>
                    <span class=" text-secondary"><?php echo $contactNumber ?></span>
                </div>

                <!-- EMAIL ADDRESS -->
                <div class="mr-3">
                    <i class="fas fa-envelope mr-1 text-danger"></i>
                    <span class=" text-secondary"><?php echo $email ?></span>
                </div>

            </div>
        </div>
    </div>

    <div class="mb-4"><hr></div>

    <div id="applicationStatus">
        <?php
            if ($status == 'Pending') {
                echo '
                    <div class="container-fluid alert alert-success mb-4 p-2" id="pendingStatus">
                        <div class="row align-items-center">
                            <div class="col-md-8 text-md-left text-center">
                                <div class="m-1">
                                    <strong>' . $fullName . '</strong> is applying for <strong><a href="' . base_url() . 'auth/job_details/' . $jobPostID . '">' . $jobTitle . '</strong></a>. 
                                </div>
                            </div>
                            <div class="col-md-4 text-md-right text-center mt-2 mt-md-0">
                                <button type="submit" class="btn btn-success m-1 text-nowrap" data-toggle="modal" data-target="#hireModal">Hire Now!</button>
                                <button type="submit" class="btn btn-danger m-1 text-nowrap" data-toggle="modal" data-target="#rejectModal">Reject</button>
                            </div> 
                        </div> 
                    </div>
                ';
            } else if ($status == 'Hired') {
                echo '
                    <div class="container-fluid alert alert-primary mb-4 p-2" id="hiredStatus">
                        <div class="row align-items-center">
                            <div class="col-md-8 text-md-left text-center">
                                <div class="m-1">
                                    You hired <strong>' . $fullName . '</strong> for <strong><a href="' . base_url() . 'auth/job_details/' . $jobPostID . '">' . $jobTitle . '</strong></a>. 
                                </div>
                            </div>
                            <div class="col-md-4 text-md-right text-center mt-2 mt-md-0">
                                <button type="submit" class="btn btn-warning m-1 text-nowrap" data-toggle="modal" data-target="#cancelHiringModal">Cancel</button>
                            </div> 
                        </div> 
                    </div>
                ';
            } else if ($status == 'Rejected') {
                echo '
                    <div class="container-fluid alert alert-danger mb-4 p-2" id="rejectedStatus">
                        <div class="row align-items-center">
                            <div class="col-md-8 text-md-left text-center">
                                <div class="m-1">
                                    You rejected <strong>' . $fullName . '</strong> for <strong><a href="' . base_url() . 'auth/job_details/' . $jobPostID . '">' . $jobTitle . '</strong></a>. 
                                </div>
                            </div>
                            <div class="col-md-4 text-md-right text-center mt-2 mt-md-0">
                                <button type="submit" class="btn btn-warning m-1 text-nowrap" data-toggle="modal" data-target="#cancelRejectingModal">Cancel</button>
                            </div> 
                        </div> 
                    </div>
                ';
            }
        ?>
    </div>


    <div class="row">
        
        <!-- APPLICANT INFORMATION -->
        <div class="col-lg-8">
            <div class="mb-3 mb-lg-0">

                <div class="mb-5">
                    <h5 class="text-primary mb-3">
                        <i class="fas fa-book-reader mr-2"></i>  
                        <span>About Me</span> 
                    </h5>
                    <p class="text-justify"><?php echo $description ?></p>
                </div>
                
                <div class="mb-5">
                    <h5 class="text-primary mb-3">
                        <i class="fas fa-chart-line mr-2"></i>  
                        <span>My Experiences</span> 
                    </h5>
                    <p class="text-justify"><?php echo $experiences ?></p>
                </div>

                <div class="mb-5">
                    <h5 class="text-primary mb-3">
                        <i class="fas fa-cogs mr-2"></i>  
                        <span>My Skills</span> 
                    </h5>
                    <p class="text-justify"><?php echo $skills ?></p>
                </div>
                
                <div class="mb-5">
                    <h5 class="text-primary mb-3">
                        <i class="fas fa-book-reader mr-2"></i>  
                        <span>My Education</span> 
                    </h5>
                    <p class="text-justify"><?php echo $education ?></p>
                </div>

            </div>
        </div>
        <!-- END OF APPLICANT INFORMATION -->


        <!-- APPLICANT INFORMATION SUMMARY -->
        <div class="col-lg-4">
            
            <!-- GENERAL INFORMATION CARD -->
            <div class="card mb-3">
                <div class="card-header">
                    <strong>
                        <i class="fas fa-user-circle mr-2"></i>
                        <span>Personal Information</span>    
                    </strong>
                </div>
                <div class="card-body p-0">
                    
                    <div class="list-group list-group-flush">

                        <!-- GENDER -->
                        <div class="list-group-item d-flex">
                            <div class="list-group-item-icon h4 text-info">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <div>
                                <p class="m-0 font-weight-bold">Gender</p>
                                <p class="m-0 text-secondary"><?php echo $gender ?></p>
                            </div>
                        </div>

                        <!-- AGE -->
                        <div class="list-group-item d-flex">
                            <div class="list-group-item-icon h4 text-info">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div>
                                <p class="m-0 font-weight-bold">Age</p>
                                <p class="m-0 text-secondary"><?php echo $age ?></p>
                            </div>
                        </div>

                        <!-- LOCATION -->
                        <div class="list-group-item d-flex">
                            <div class="list-group-item-icon h4 text-info">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <p class="m-0 font-weight-bold">Location</p>
                                <p class="m-0 text-secondary"><?php echo $location ?></p>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
            </div>

            <!-- CONTACT INFORMATION CARD -->
            <div class="card mb-3">
                <div class="card-header">
                    <strong>
                        <i class="fas fa-phone-square-alt mr-2"></i>
                        <span>Contact Information</span>    
                    </strong>
                </div>
                <div class="card-body p-0">
                    
                    <div class="list-group list-group-flush">

                        <!-- CONTACT NUMBER -->
                        <div class="list-group-item d-flex">
                            <div class="list-group-item-icon h4 text-danger">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div>
                                <p class="m-0 font-weight-bold">Contact Number</p>
                                <p class="m-0 text-secondary"><?php echo $contactNumber ?></p>
                            </div>
                        </div>

                        <!-- EMAIL -->
                        <div class="list-group-item d-flex">
                            <div class="list-group-item-icon h4 text-danger">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div>
                                <p class="m-0 font-weight-bold">Email</p>
                                <p class="m-0 text-secondary"><?php echo $email ?></p>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
            
            <div>
                <button class="btn btn-warning btn-block" data-toggle="modal" data-target="#messageForm">
                    <i class="fas fa-file-contract mr-1"></i>
                    <span>View Resume/CV</span>
                </button>
            </div>
            
        </div>

    </div>

</div>
</div>



<?php

if ($status == 'Pending') {
    $this->load->view('sections/components/modal', [
        'id'            => 'hireModal',
        'theme'         => 'success',
        'title'         => 'Hire an applicant',
        'modalIcon'     => 'INFO',
        'message'       => '<p class="m-1">Are you sure you want to hire <strong>' . $fullName . '</strong> for <strong>' . $jobTitle . '</strong>?</p>',
        'actionPath'    => NULL,
        'actionID'      => 'hireApplicantBtn',
        'actionValue'   => $applicationID,
        'actionIcon'    => NULL,
        'actionLabel'   => 'Hire now!',
    ]);

    $this->load->view('sections/components/modal', [
        'id'            => 'rejectModal',
        'theme'         => 'danger',
        'title'         => 'Reject an applicant',
        'modalIcon'     => 'WARNING',
        'message'       => '<p class="m-1">Are you sure you want to reject this applicant?</p>',
        'actionPath'    => NULL,
        'actionID'      => 'rejectApplicantBtn',
        'actionValue'   => $applicationID,
        'actionIcon'    => 'user-times',
        'actionLabel'   => 'Reject',
    ]);
} else if ($status == 'Hired') {
    $this->load->view('sections/components/modal', [
        'id'            => 'cancelHiringModal',
        'theme'         => 'warning',
        'title'         => 'Cancel hiring',
        'modalIcon'     => 'WARNING',
        'message'       => '<p class="m-1">Are you sure you want to <strong>cancel hiring</strong> to <strong>' . $fullName . '</strong>?</p>',
        'actionPath'    => NULL,
        'actionID'      => 'cancelHiringBtn',
        'actionValue'   => $applicationID,
        'actionIcon'    => 'user-times',
        'actionLabel'   => 'Continue',
    ]);
} else if ($status == 'Rejected') {
    $this->load->view('sections/components/modal', [
        'id'            => 'cancelRejectingModal',
        'theme'         => 'warning',
        'title'         => 'Cancel rejecting',
        'modalIcon'     => 'WARNING',
        'message'       => '<p class="m-1">Are you sure you want to <strong>cancel rejecting </strong> to <strong>' . $fullName . '</strong>?</p>',
        'actionPath'    => NULL,
        'actionID'      => 'cancelHiringBtn',
        'actionValue'   => $applicationID,
        'actionIcon'    => 'user-times',
        'actionLabel'   => 'Continue',
    ]);
}


?>


<script>     
    $(document).on('click','#hireApplicantBtn', function(e) {
        e.preventDefault();
        var applicationID = $(this).attr('value');
        $.ajax({
            url:        "<?php echo base_url() ?>auth/hire_applicant",
            type:       "post",
            dataType:   "json",
            data: {
                applicationID: applicationID
            },
            success:    function(data) {
                location.reload();
            } 
        });
    });

    $(document).on('click','#rejectApplicantBtn', function(e) {
        e.preventDefault();
        var applicationID = $(this).attr('value');
        $.ajax({
            url:        "<?php echo base_url() ?>auth/reject_applicant",
            type:       "post",
            dataType:   "json",
            data: {
                applicationID: applicationID
            },
            success:    function(data) {
                location.reload();
            } 
        });
    });

    $(document).on('click','#cancelHiringBtn', function(e) {
        e.preventDefault();
        var applicationID = $(this).attr('value');
        $.ajax({
            url:        "<?php echo base_url() ?>auth/cancel_hiring_rejecting",
            type:       "post",
            dataType:   "json",
            data: {
                applicationID: applicationID
            },
            success:    function(data) {
                location.reload();
            } 
        });
    });

    $(document).on('click','#cancelRejectingBtn', function(e) {
        e.preventDefault();
        var applicationID = $(this).attr('value');
        $.ajax({
            url:        "<?php echo base_url() ?>auth/cancel_hiring_rejecting",
            type:       "post",
            dataType:   "json",
            data: {
                applicationID: applicationID
            },
            success:    function(data) {
                location.reload();
            } 
        });
    });
</script>