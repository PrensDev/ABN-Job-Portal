<?php

if ($this->session->userType == 'Job Seeker') {
    $resumeData = $this->JBSK_model->view_resume();
}

if ($jobType == 'Full Time') {
    $jobTypeClass = 'success';
} else if ($jobType == 'Part Time') {
    $jobTypeClass = 'info';
} else if ($jobType == 'Intern/OJT') {
    $jobTypeClass = 'warning';
} else if ($jobType == 'Temporary') {
    $jobTypeClass = 'secondary';
}

function moneyStyle($money) {
    if ($money < 1000) {
        return number_format($money, 1, '.', '');
    } else if ($money < 1000000) {
        return number_format($money / 1000, 1, '.', '') . 'K';
    } else if ($money < 1000000000) {
        return number_format($money / 1000000, 1, '.', '') . 'M';
    } else if ($money < 1000000000000) {
        return number_format($money / 1000000000, 1, '.', '') . 'B';
    } else if ($money < 1000000000000000) {
        return number_format($money / 1000000000000, 1, '.', '') . 'T';
    }
}

$minSalary = moneyStyle($minSalary);
$maxSalary = moneyStyle($maxSalary);
$offeredSalary = '&#8369;' . $minSalary . ' - &#8369;' . $maxSalary;

$datePosted = date_format(date_create($dateCreated),"F d, Y; h:i a");

?>

<!-- HEADER -->
<div class="container-fluid py-5">
<div class="container">
    
    <div class="row">

        <div class="col-auto d-none d-sm-inline">
            <a href="<?php base_url() . 'companies/details/' . $employerID ?>">
                <?php if (isset($profilePic)) { ?>
                    <img 
                        src         = "<?php echo base_url() . 'public/img/employers/' . $profilePic ?>" 
                        alt         = "<?php echo $jobTitle ?>" 
                        height      = "125" 
                        width       = "125" 
                        draggable   = "false"
                        class       = "border"
                    >
                <?php } else { ?>
                    <img 
                        src         = "<?php echo base_url() ?>public/img/employers/blank_dp.png" 
                        alt         = "<?php echo $jobTitle ?>" 
                        height      = "125" 
                        width       = "125" 
                        draggable   = "false"
                        class       = "border"
                    >
                <?php } ?>
            </a>
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
    ?>
                    <div class="container-fluid alert alert-success mb-5">
                        <div class="row align-items-center text-center">
                            <div class="col-md-8 text-md-left">
                                <div class="m-1">
                                    You submitted your application for this job at <strong><?php echo $dateApplied ?></strong></a>. 
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
    <?php       } else if ($status == 'Hired') { ?>
                    <div class="alert alert-primary mb-5 text-md-left text-center">
                        You are <strong>hired</strong> for this job.</a>
                    </div>
    <?php
                }
            }
        }
    ?>
    
<div class="row">

    <!-- JOB DETAILS -->
    <div class="col-lg-8">
    <div class="mb-3 mb-lg-0">

        <?php 
            $jobDetails = [
                [
                    'icon'    => 'align-left',
                    'element' => 'Description',
                    'content' => $description,
                ],
                [
                    'icon'    => 'bullseye',
                    'element' => 'Responsibilities',
                    'content' => $responsibilities,
                ],
                [
                    'icon'    => 'cogs',
                    'element' => 'Skills Set',
                    'content' => $skills,
                ],
                [
                    'icon'    => 'chart-line',
                    'element' => 'Experiences',
                    'content' => $experiences,
                ],
                [
                    'icon'    => 'book',
                    'element' => 'Education',
                    'content' => $education,
                ],
            ];
            
            foreach($jobDetails as $jobDetail) {
        ?>            
            <div class="mb-5">
                <h5 class="text-primary mb-3">
                    <i class="fas fa-<?php echo $jobDetail['icon'] ?> mr-2"></i>  
                    <span><?php echo $jobDetail['element'] ?></span> 
                </h5>
                <p><?php echo $jobDetail['content'] ?></p>
            </div>
        <?php } ?>
        
    </div>
    </div>
    
    <!-- JOB SUMMARY -->
    <div class="col-lg-4">
        
        <?php
            // EDIT POST BY EMPLOYER
            if ($this->session->userType == 'Employer') {
                if ($this->session->id == $employerID) {
        ?>
            <div class="d-flex justify-content-between alert alert-info p-3 mb-3">
                <div class="mr-3">
                    <span>Do you want to edit your post?</span>
                </div>
                <div class="text-nowrap">
                    <i class="fas fa-pen text-info"></i>
                    <a class="text-info" href="<?php echo base_url() . 'auth/edit_post/' . $jobPostID ?>">
                        <span>Edit</span>
                    </a>
                </div>
            </div>
        <?php
                }
            }

            // JOB SUMMARY CARD
            $this->load->view('sections/components/info_card', [
                'title'        => 'Job Summary',
                'theme'        => 'info',
                'infoElements' => [
                    [
                        'icon'          => 'user-tie',
                        'element'       => 'Job Type',
                        'customContent' => true,
                        'content'       => '
                            <span class="badge border border-' . $jobTypeClass . ' text-' . $jobTypeClass . ' p-2 text-uppercase">
                                <i class="fas fa-user-tie mr-2"></i>
                                <span>' . $jobType . '</span>
                            </span>
                        ',
                    ],
[
                        'icon'          => 'cogs',
                        'element'       => 'Field',
                        'customContent' => false,
                        'content'       => $offeredSalary,
                    ],
                    [
                        'icon'          => 'money-bill-wave',
                        'element'       => 'Offered Salary',
                        'customContent' => false,
                        'content'       => $field,
                    ],
                    [
                        'icon'          => 'calendar-alt',
                        'element'       => 'Date Posted',
                        'customContent' => false,
                        'content'       => $datePosted,
                    ],
                ],
            ]); 

            // COMPANY DETAILS CARD
            if ($website == '') {
                $websiteContent = '<p class="m-0 text-secondary">This company doesn\'t have website yet.</p>';
            } else {
                $websiteContent = '
                    <p class="m-0">
                        <a 
                            href            = "' . $website . '" 
                            class           = "btn btn-primary btn-sm mt-1" 
                            target          = "_blank" 
                            data-toggle     = "tooltip" 
                            data-placement  = "left" 
                            title           = "' . $website . '"
                        >
                            <i class="fas fa-external-link-alt"></i>
                            <span>Go to their website</span>
                        </a> 
                    </p>
                ';
            }

            $this->load->view('sections/components/info_card', [
                'title'        => 'Company Details',
                'theme'        => 'danger',
                'infoElements' => [
                    [
                        'icon'          => 'city',
                        'element'       => 'Company',
                        'customContent' => true,
                        'content'       => '
                            <p class="m-0 text-secondary">' . $companyName . '</p>
                            <p class="m-0">
                                <a href="' . base_url() . 'companies/details/' . $employerID .'" class="btn btn-primary btn-sm mt-1">
                                    <i class="fas fa-ellipsis-h"></i>
                                    <span>More about this company</span>
                                </a> 
                            </p>
                        ',
                    ],
                    [
                        'icon'          => 'map-marker-alt',
                        'element'       => 'Location',
                        'content'       => $location,
                    ],
                    [
                        'icon'          => 'phone-alt',
                        'element'       => 'Contact Number',
                        'content'       => $contactNumber,
                    ],
                    [
                        'icon'          => 'envelope',
                        'element'       => 'Email',
                        'content'       => $email,
                    ],
                    [
                        'icon'          => 'globe-asia',
                        'element'       => 'Website',
                        'customContent' => true,
                        'content'       => $websiteContent,
                    ],
                ],
            ]); 
            
            // JOB SEEKER CONTROLS
            if ($this->session->userType == 'Job Seeker') {
                if (! isset($status)) {
                    if (isset($resumeData)) {
                        $userControlConfig = [
                            'theme'         => 'primary',
                            'modalID'       => 'submitApplicationModal',
                            'statusLabel'   => 'Apply now!',
                        ];
                    } else {
                        $userControlConfig = [
                            'theme'         => 'primary',
                            'modalID'       => 'emptyResumeModal',
                            'statusLabel'   => 'Apply now!',
                        ];
                    }
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
    if ($this->session->userType == 'Job Seeker') {
        if (! isset($status)) {
            if (isset($resumeData)) {
                $this->load->view('auth_sections/jobseeker/components/submit_application_modal', $resumeData);
            } else {
                $this->load->view('auth_sections/jobseeker/components/empty_resume_modal');
            }
        } else {
            if ($status = 'Pending') {
                $this->load->view('auth_sections/jobseeker/components/view_application_modal');
                $this->load->view('sections/components/modal', [
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
                ]);
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
                applicationID: <?php echo isset($applicationID) ? $applicationID : 0 ?>,
            },
            success:    function(data) {
                location.reload();
            }
        });
    });

    $(document).on('click','#addBookmarkBtn', function(e) {
        e.preventDefault();
        $.ajax({
            url:        "<?php echo base_url() ?>auth/add_bookmark",
            type:       "post",
            dataType:   "json",
            data: {
                jobPostID: <?php echo $jobPostID ?>
            },
            success:    function(data) {
                location.reload();
            }
        });
    });

    $(document).on('click','#removeBookmarkBtn', function(e) {
        e.preventDefault();
        $.ajax({
            url:        "<?php echo base_url() ?>auth/remove_bookmark",
            type:       "post",
            dataType:   "json",
            data: {
                bookmarkID: <?php echo isset($bookmarkID) ? $bookmarkID : 0 ?>
            },
            success:    function(data) {
                location.reload();
            } 
        });
    });
</script>
<?php } ?>