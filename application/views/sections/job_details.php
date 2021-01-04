<?php

$resumeData = $this->Jobseeker_model->view_resume();

if ($jobType == 'Full Time') {
    $jobTypeClass = 'success';
} else if ($jobType == 'Part Time') {
    $jobTypeClass = 'info';
} else if ($jobType == 'Intern/OJT') {
    $jobTypeClass = 'warning';
} else if ($jobType == 'Temporary') {
    $jobTypeClass = 'secondary';
}

if ($minSalary < 1000) {
    $minSalary = number_format($minSalary, 1, '.', '');
} else if ($minSalary < 1000000) {
    $minSalary = number_format($minSalary / 1000, 1, '.', '') . 'K';
} else if ($minSalary < 1000000000) {
    $minSalary = number_format($minSalary / 1000000, 1, '.', '') . 'M';
} else if ($minSalary < 1000000000000) {
    $minSalary = number_format($minSalary / 1000000000, 1, '.', '') . 'B';
} else if ($minSalary < 1000000000000000) {
    $minSalary = number_format($minSalary / 1000000000000, 1, '.', '') . 'T';
} 

if ($maxSalary < 1000) {
    $maxSalary = number_format($maxSalary, 1, '.', '');
} else if ($maxSalary < 1000000) {
    $maxSalary = number_format($maxSalary / 1000, 1, '.', '') . 'K';
} else if ($maxSalary < 1000000000) {
    $maxSalary = number_format($maxSalary / 1000000, 1, '.', '') . 'M';
} else if ($maxSalary < 1000000000000) {
    $maxSalary = number_format($maxSalary / 1000000000, 1, '.', '') . 'B';
} else if ($maxSalary < 1000000000000000) {
    $maxSalary = number_format($maxSalary / 1000000000000, 1, '.', '') . 'T';
}

$offeredSalary = '&#8369;' . $minSalary . ' - &#8369;' . $maxSalary;

$datePosted = date_format(date_create($dateCreated),"F d, Y; h:i a");

?>

<!-- HEADER -->
<div class="container-fluid py-5">
<div class="container">
    
    <div class="row">

        <!-- COMPANY IMAGE/LOGO -->
        <div class="col-auto d-none d-sm-inline">
            <?php
                if (isset($profilePic)) {
                    echo '
                        <a href="' . base_url() . 'companies/details/' . $employerID . '">
                            <img 
                                src         = "' . base_url() . 'public/img/employers/' . $profilePic . '" 
                                alt         = "' . $jobTitle . '" 
                                height      = "125" 
                                width       = "125" 
                                draggable   = "false"
                                class       = "border"
                            >
                        </a>
                    ';
                } else {
                    echo '
                        <a href="' . base_url() . 'companies/details/' . $employerID . '">
                            <img 
                                src         = "' . base_url() . 'public/img/employers/blank_dp.png" 
                                alt         = "' . $jobTitle . '" 
                                height      = "125" 
                                width       = "125" 
                                draggable   = "false"
                                class       = "border"
                            >
                        </a>
                    ';
                }
            ?>
        </div>
        
        <!-- JOB DETAILS -->
        <div class="col flex-grow-1">
            <h1 class="font-weight-normal text-uppercase"><?php echo $jobTitle ?></h1>
            
            <div class="d-flex flex-wrap">
                
                <div class="mr-3">
                    <i class="fas fa-briefcase mr-1 text-info"></i>
                    <a href="<?php echo base_url() ?>companies/details/<?php echo $employerID ?>" class="text-secondary">
                        <span><?php echo $companyName ?></span>
                    </a>
                </div>

                <div class="mr-3">
                    <i class="fas fa-map-marker-alt mr-1 text-info"></i>
                    <span class="text-secondary"><?php echo $location ?></span>
                </div>

                <div class="mr-3">
                    <i class="fas fa-money-bill-wave mr-1 text-info"></i>
                    <span class="text-secondary"><?php echo $offeredSalary ?></span>
                </div>

                <div class="mr-3">
                    <i class="fas fa-cog mr-1 text-info"></i>
                    <span class="text-secondary"><?php echo $field ?></span>
                </div>

            </div>

            <div class="pt-2">
                <span class="badge text-<?php echo $jobTypeClass ?> border border-<?php echo $jobTypeClass ?> p-2 text-uppercase">
                    <i class="fas fa-user-tie mr-2"></i>
                    <?php echo $jobType ?>
                </span>
            </div>
            
        </div>

    </div>

    <hr class="my-4">

    <?php
        if ($this->session->userType == 'Job Seeker') {
            if(isset($status) && isset($dateApplied)) {
                $dateApplied = date_format(date_create($dateApplied),"F d, Y, h:i a");

                if ($status == 'Pending') {
                    echo '
                        <div class="container-fluid alert alert-success mb-5">
                            <div class="row align-items-center text-center">
                                <div class="col-md-8 text-md-left">
                                    <div class="m-1">
                                        You submitted your application for this job at <strong>' . $dateApplied . '</strong></a>. 
                                    </div>
                                </div>
                                <div class="col-md-4 text-md-right mt-2 mt-md-0">
                                    <button 
                                        class       = "btn btn-warning"
                                        data-toggle = "modal"
                                        data-target = "#viewApplicationModal"
                                    >View my application</button>
                                </div> 
                            </div> 
                        </div>
                    ';
                } else if ($status == 'Hired') {
                    echo '
                        <div class="alert alert-primary mb-5 text-md-left text-center">
                            You are <strong>hired</strong> for this job.</a>
                        </div>
                    ';
                }
            }
        }
    ?>
<div class="row">

    <!-- JOB DETAILS -->
    <div class="col-lg-8">

        <!-- JOB DESCRIPTION SECTION -->
        <div class="mb-3 mb-lg-0">
            
            <!-- DESCRIPTION -->
            <div class="mb-5">
                <h5 class="text-primary mb-3">
                    <i class="fas fa-align-left mr-2"></i>  
                    <span>Description</span> 
                </h5>
                <p><?php echo $description ?></p>
            </div>

            <!-- RESPONSIBILITIES -->
            <div class="mb-5">
                <h5 class="text-primary mb-3">
                    <i class="fas fa-bullseye mr-2"></i>  
                    <span>Responsibilities</span> 
                </h5>
                <p><?php echo $responsibilities ?></p>
            </div>
            
            <!-- SKILLS SET -->
            <div class="mb-5">
                <h5 class="text-primary mb-3">
                    <i class="fas fa-cogs mr-2"></i>  
                    <span>Skills Set</span> 
                </h5>
                <p><?php echo $skills ?></p>
            </div>

            <!-- EXPERIENCES -->
            <div class="mb-5">
                <h5 class="text-primary mb-3">
                    <i class="fas fa-chart-line mr-2"></i>  
                    <span>Experiences</span> 
                </h5>
                <p><?php echo $experiences ?></p>
            </div>
            
            <!-- EDUCATION -->
            <div class="mb-5">
                <h5 class="text-primary mb-3">
                    <i class="fas fa-book mr-2"></i>  
                    <span>Education</span> 
                </h5>
                <p><?php echo $education ?></p>
            </div>
            
        </div>

    </div>
    <!-- END OF JOB DETAILS -->
    
    <!-- JOB SUMMARY -->
    <div class="col-lg-4">
        
        <?php
            if ($this->session->userType == 'Employer') {
                if ($this->session->id == $employerID) {
                    echo '
                        <div class="d-flex justify-content-between alert alert-info p-3 mb-3">
                            <div class="mr-3">
                                <span>Do you want to edit your post?</span>
                            </div>
                            <div class="text-nowrap">
                                <i class="fas fa-pen text-info"></i>
                                <a class="text-info" href="' . base_url() . 'auth/edit_post/' . $jobPostID . '">
                                    <span>Edit</span>
                                </a>
                            </div>
                        </div>
                    ';
                }
            }
        ?>

        <!-- JOB SUMMARY CARD -->
        <div class="card mb-3">
            <div class="card-header bg-white">
                <strong>Job Summary</strong>
            </div>
            <div class="card-body p-0">
                
                <div class="list-group list-group-flush">

                    <!-- JOB TYPE -->
                    <div class="list-group-item d-flex border-0">
                        <div class="list-group-item-icon h5 text-info">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div>
                            <p class="m-0 font-weight-bold">Job Type</p>
                            <span class="badge border border-<?php echo $jobTypeClass ?> text-<?php echo $jobTypeClass ?> p-2 text-uppercase">
                                <i class="fas fa-user-tie mr-2"></i>
                                <?php echo $jobType ?>
                            </span>
                        </div>
                    </div>

                    <!-- INDUSTRY TYPE -->
                    <div class="list-group-item d-flex border-0">
                        <div class="list-group-item-icon h5 text-info">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <div>
                            <p class="m-0 font-weight-bold">Field</p>
                            <p class="m-0 text-secondary"><?php echo $field ?></p>
                        </div>
                    </div>

                    <!-- OFFERED SALARY -->
                    <div class="list-group-item d-flex border-0">
                        <div class="list-group-item-icon h5 text-info">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <div>
                            <p class="m-0 font-weight-bold">Offered Salary</p>
                            <p class="m-0 text-secondary"><?php echo $offeredSalary ?></p>
                        </div>
                    </div>

                    <!-- DATE POSTED -->
                    <div class="list-group-item d-flex border-0">
                        <div class="list-group-item-icon h5 text-info">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div>
                            <p class="m-0 font-weight-bold">Date Posted</p>
                            <p class="m-0 text-secondary"><?php echo $datePosted ?></p>
                        </div>
                    </div>

                </div>
                
            </div>
        </div>
        
        <!-- COMPANY DETAILS CARD -->
        <div class="card mb-3">
            <div class="card-header bg-white">
                <strong>Company Details</strong>
            </div>
            <div class="card-body p-0">
                
                <div class="list-group list-group-flush">
                    
                    <!-- COMPANY NAME -->
                    <div class="list-group-item d-flex border-0">
                        <div class="list-group-item-icon h5 text-danger">
                            <i class="fas fa-city"></i>
                        </div>
                        <div>
                            <p class="m-0 font-weight-bold">Company</p>
                            <p class="m-0 text-secondary"><?php echo $companyName ?></p>
                            <p class="m-0">
                                <a href="<?php echo base_url() . 'companies/details/' . $employerID ?>" class="btn btn-primary btn-sm mt-1">
                                    <i class="fas fa-ellipsis-h"></i>
                                    <span>More about this company</span>
                                </a> 
                            </p>
                        </div>
                    </div>

                    <!-- COMPANY LOCATION -->
                    <div class="list-group-item d-flex border-0">
                        <div class="list-group-item-icon h5 text-danger">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <p class="m-0 font-weight-bold">Location</p>
                            <p class="m-0 text-secondary"><?php echo $location ?></p>
                        </div>
                    </div>

                    <!-- CONTACT NUMBER -->
                    <div class="list-group-item d-flex border-0">
                        <div class="list-group-item-icon h5 text-danger">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div>
                            <p class="m-0 font-weight-bold">Contact Number</p>
                            <p class="m-0 text-secondary"><?php echo $contactNumber ?></p>
                        </div>
                    </div>

                    <!-- COMPANY EMAIL -->
                    <div class="list-group-item d-flex border-0">
                        <div class="list-group-item-icon h5 text-danger">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <p class="m-0 font-weight-bold">Email</p>
                            <p class="m-0 text-secondary"><?php echo $email ?></p>
                        </div>
                    </div>

                    <?php
                        if ($website != '') {
                            echo '
                                <div class="list-group-item d-flex">
                                    <div class="list-group-item-icon h4 text-danger">
                                        <i class="fas fa-globe-asia"></i>
                                    </div>
                                    <div>
                                        <p class="m-0 font-weight-bold">Website</p>
                                        <p class="m-0">
                                            <a href="' . $website  . '" class="btn btn-primary btn-sm mt-1" target="_blank" data-toggle="tooltip" data-placement="left" title="' . $website . '">
                                                <i class="fas fa-external-link-alt"></i>
                                                <span>Go to their website</span>
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

        <?php
            if ($this->session->userType == 'Job Seeker') {
                if (! isset($status)) {
                    $userControlConfig = [
                        'theme'         => 'primary',
                        'modalID'       => 'submitApplicationModal',
                        'statusLabel'   => 'Apply now!',
                    ];
                } else {
                    if ($status == 'Pending') {
                        $userControlConfig = [
                            'theme'         => 'secondary',
                            'modalID'       => 'cancelApplicationModal',
                            'statusLabel'   => 'Cancel my application',
                        ];
                    } else if ($status == 'Hired') {
                        $userControlConfig = [
                            'theme'         => NULL,
                            'modalID'       => NULL,
                            'statusLabel'   => NULL,
                        ];
                    }
                }
                $this->load->view('auth_sections/jobseeker/user_controls', $userControlConfig);
            }
        ?>
    </div>

</div>
</div>
</div>

<?php

if (isset($status)) {
    $this->load->view('auth_sections/jobseeker/components/view_application_modal');
}

if ($this->session->userType == 'Job Seeker') {
    if (isset($resumeData)) {
        if (! isset($status)) {
            $this->load->view('auth_sections/jobseeker/components/submit_application_modal', $resumeData);
        } else {
            if ($status = 'Pending') {
                $modalConfig = [
                    'centered'      => TRUE,
                    'nofade'        => TRUE,
                    'id'            => 'cancelApplicationModal',
                    'theme'         => 'warning',
                    'title'         => 'Cancel Application',
                    'modalIcon'     => 'WARNING',
                    'message'       => '
                        <p class="m-1">Are you sure you want to cancel you application for this job?</p>
                        <p class="m-1"><strong>Note: You may apply again if this job is still available.</strong></p>
                    ',
                    'actionPath'    => NULL,
                    'actionID'      => 'cancelApplicationBtn',
                    'actionIcon'    => 'file',
                    'actionLabel'   => 'Cancel my application!',
                ];
            }
            $this->load->view('sections/components/modal', $modalConfig);
        }
    }
}

?>

<script>
    $(document).on('click','#cancelApplicationBtn', function(e) {
        e.preventDefault();
        $.ajax({
            url:        "<?php echo base_url() ?>auth/cancel_application",
            type:       "post",
            dataType:   "json",
            data: {
                applicationID: <?php echo isset($applicationID) ? $applicationID : NULL ?>,
            },
            success:    function(data) {
                location.reload();
            }
        });
    });

    $(document).on('click','#addBookmarkBtn', function(e) {
        e.preventDefault();
        var jobPostID = $(this).attr('value');
        $.ajax({
            url:        "<?php echo base_url() ?>auth/add_bookmark",
            type:       "post",
            dataType:   "json",
            data: {
                jobPostID: jobPostID
            },
            success:    function(data) {
                location.reload();
            } 
        });
    });

    $(document).on('click','#removeBookmarkBtn', function(e) {
        e.preventDefault();
        var jobPostID = $(this).attr('value');
        $.ajax({
            url:        "<?php echo base_url() ?>auth/remove_bookmark",
            type:       "post",
            dataType:   "json",
            data: {
                jobPostID: jobPostID
            },
            success:    function(data) {
                location.reload();
            } 
        });
    });
</script>