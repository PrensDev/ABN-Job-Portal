<?php

if ($jobType == 'Full Time') {
    $jobTypeClass = 'success';
} else if ($jobType == 'Part Time') {
    $jobTypeClass = 'info';
} else if ($jobType == 'Internship/OJT') {
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
<div 
    class="container-fluid py-3 parallax-window image-overlay py-5"
    data-parallax="scroll" 
    data-image-src="<?php echo base_url() ?>public/img/job_title_bg.jpeg"
>
<div class="container d-flex justify-content-between">
    
    <!-- COMPANY IMAGE/LOGO -->
    <div class="d-none d-sm-inline mr-sm-3">
        <img src="<?php echo base_url() ?>public/img/job_logo_5.jpg" alt="" height="125" class="rounded" draggable="false">
    </div>
    
    <!-- JOB DETAILS -->
    <div class="text-white flex-grow-1">
        <h1 class="font-weight-light text-capitalize"><?php echo $jobTitle ?></h1>
        
        <div class="d-flex flex-wrap">
            
            <div class="mr-3">
                    <i class="fas fa-briefcase mr-1"></i>
                    <a href="<?php echo base_url() ?>companies/details/<?php echo $employerID ?>" class="text-white">
                        <span><?php echo $companyName ?></span>
                    </a>
            </div>

            <div class="mr-3">
                <i class="fas fa-map-marker-alt mr-1"></i>
                <span><?php echo $location ?></span>
            </div>

            <div class="mr-3">
                <i class="fas fa-money-bill-wave mr-1"></i>
                <span><?php echo $offeredSalary ?></span>
            </div>

            <div class="mr-3">
                <i class="fas fa-cog mr-1"></i>
                <span><?php echo $industryType ?></span>
            </div>

        </div>

        <div class="pt-2">
            <span class="badge badge-<?php echo $jobTypeClass ?> p-2 text-uppercase">
                <i class="fas fa-user-tie mr-2"></i>
                <?php echo $jobType ?>
            </span>
        </div>
        
    </div>

</div>
</div>


<!-- JOB DETAILS SECTION -->
<div class="container-fluid">
<div class="container py-5">

<?php
    if ($this->session->userType == 'Job Seeker') {
        if(isset($status) && isset($dateApplied)) {
            $dateApplied = date_format(date_create($dateApplied),"F d, Y, h:i a");

            if ($status == 'Pending') {
                echo '
                    <div class="container-fluid alert alert-success mb-5">
                        <div class="row align-items-center">
                            <div class="col-md-8 text-md-left text-center">
                                <div class="m-1">
                                    You submitted your application for this job at <strong>' . $dateApplied . '</strong></a>. 
                                </div>
                            </div>
                            <div class="col-md-4 text-md-right mt-2 mt-md-0">
                                <span class="badge badge-success py-2 px-3">' . $status . '</span>
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
                <p class="text-justify"><?php echo $description ?></p>
            </div>

            <!-- RESPONSIBILITIES -->
            <div class="mb-5">
                <h5 class="text-primary mb-3">
                    <i class="fas fa-bullseye mr-2"></i>  
                    <span>Responsibilities</span> 
                </h5>
                <p class="text-justify"><?php echo $responsibilities ?></p>
            </div>
            
            <!-- SKILLS SET -->
            <div class="mb-5">
                <h5 class="text-primary mb-3">
                    <i class="fas fa-cogs mr-2"></i>  
                    <span>Skills Set</span> 
                </h5>
                <p class="text-justify"><?php echo $skills ?></p>
            </div>

            <!-- EXPERIENCES -->
            <div class="mb-5">
                <h5 class="text-primary mb-3">
                    <i class="fas fa-chart-line mr-2"></i>  
                    <span>Experiences</span> 
                </h5>
                <p class="text-justify"><?php echo $experiences ?></p>
            </div>
            
            <!-- EDUCATION -->
            <div class="mb-5">
                <h5 class="text-primary mb-3">
                    <i class="fas fa-book mr-2"></i>  
                    <span>Education</span> 
                </h5>
                <p class="text-justify"><?php echo $education ?></p>
            </div>
            
        </div>
        <!-- END OF JOB DESCRIPTION SECTION -->

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
            <div class="card-header">
                <strong>
                    <i class="fas fa-briefcase mr-2"></i>
                    <span>Job Summary</span>    
                </strong>
            </div>
            <div class="card-body p-0">
                
                <div class="list-group list-group-flush">

                    <!-- JOB TYPE -->
                    <div class="list-group-item d-flex">
                        <div class="list-group-item-icon h4 text-info">
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
                    <div class="list-group-item d-flex">
                        <div class="list-group-item-icon h4 text-info">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <div>
                            <p class="m-0 font-weight-bold">Industry Type</p>
                            <p class="m-0 text-secondary"><?php echo $industryType ?></p>
                        </div>
                    </div>

                    <!-- OFFERED SALARY -->
                    <div class="list-group-item d-flex">
                        <div class="list-group-item-icon h4 text-info">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <div>
                            <p class="m-0 font-weight-bold">Offered Salary</p>
                            <p class="m-0 text-secondary"><?php echo $offeredSalary ?></p>
                        </div>
                    </div>

                    <!-- DATE POSTED -->
                    <div class="list-group-item d-flex">
                        <div class="list-group-item-icon h4 text-info">
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
        <!-- END OF JOB SUMMARY CARD -->
        
        <!-- COMPANY DETAILS CARD -->
        <div class="card mb-3">
            <div class="card-header">
                <strong>
                    <i class="fas fa-briefcase mr-2"></i>
                    <span>Company Details</span>    
                </strong>
            </div>
            <div class="card-body p-0">
                
                <div class="list-group list-group-flush">
                    
                    <!-- COMPANY NAME -->
                    <div class="list-group-item d-flex">
                        <div class="list-group-item-icon h4 text-danger">
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
                    <div class="list-group-item d-flex">
                        <div class="list-group-item-icon h4 text-danger">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <p class="m-0 font-weight-bold">Location</p>
                            <p class="m-0 text-secondary"><?php echo $location ?></p>
                        </div>
                    </div>

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

                    <!-- COMPANY EMAIL -->
                    <div class="list-group-item d-flex">
                        <div class="list-group-item-icon h4 text-danger">
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
                            'theme'         => 'warning',
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

if ($this->session->userType == 'Job Seeker') {
    if (! isset($status)) {
        $modalConfig = [
            'id'            => 'submitApplicationModal',
            'theme'         => 'primary',
            'title'         => 'Submit Application',
            'modalIcon'     => 'INFO',
            'message'       => '
                <p class="m-1">Are you sure you want to apply for this job?</p>
                <p class="m-1"><strong>Note: Your information will be submitted to the employer for review.</strong></p>
            ',
            'actionPath'    => NULL,
            'actionID'      => 'submitApplicationBtn',
            'actionValue'   => $jobPostID,
            'actionIcon'    => 'file',
            'actionLabel'   => 'Apply me!',
        ];
    } else {
        if ($status = 'Pending') {
            $modalConfig = [
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
                'actionValue'   => $jobPostID,
                'actionIcon'    => 'file',
                'actionLabel'   => 'Cancel my application!',
            ];
        }
    }
    $this->load->view('sections/components/modal', $modalConfig);
}

?>

<script>
    $(document).on('click','#submitApplicationBtn', function(e) {
        e.preventDefault();
        var jobPostID = $(this).attr('value');
        $.ajax({
            url:        "<?php echo base_url() ?>auth/submit_application",
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

    $(document).on('click','#cancelApplicationBtn', function(e) {
        e.preventDefault();
        var jobPostID = $(this).attr('value');
        $.ajax({
            url:        "<?php echo base_url() ?>auth/cancel_application",
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