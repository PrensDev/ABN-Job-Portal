<?php
    $jobTypeClass   = getJobTypeClass($jobType);
    $offeredSalary  = salaryRangeFormat($minSalary, $maxSalary);
    $datePosted     = dateFormat($dateCreated ,"F d, Y; h:i a");
?>

<!-- JOB DETAILS HEADER -->
<div class="container-fluid py-5">
<div class="container">
    
    <div class="row">

        <div class="col-auto d-none d-sm-inline">
            <a href="<?php echo base_url() . 'companies/details/' . $employerID ?>">
                <div
                    data-toggle     = "tooltip"
                    data-placement  = "bottom"
                    title           = "Go to <?php echo $companyName ?> Profile"
                >
                    <?php if ($profilePic === NULL) { ?>
                        <img 
                            src         = "<?php echo base_url() ?>public/img/employers/blank_dp.png" 
                            alt         = "<?php echo $jobTitle ?>" 
                            height      = "125" 
                            width       = "125" 
                            draggable   = "false"
                            class       = "border"
                        >
                    <?php } else { ?>
                        <img 
                            src         = "<?php echo base_url() . 'public/img/employers/' . $profilePic ?>" 
                            alt         = "<?php echo $jobTitle ?>" 
                            height      = "125" 
                            width       = "125" 
                            draggable   = "false"
                            class       = "border"
                        >
                    <?php } ?>
                </div>
            </a>
        </div>
        
        <!-- JOB DETAILS -->
        <div class="col flex-grow-1">
            <h1 class="font-weight-normal text-uppercase">
                <span
                    data-toggle    = "tooltip"
                    data-placement = "bottom"
                    title          = "Job Title"
                >
                    <?php echo $jobTitle ?>
                </span>
            </h1>
            
            <div class="d-flex flex-wrap">
                
                <div class="mr-3">
                    <span
                        data-toggle    = "tooltip"
                        title          = "Company"
                    >
                        <i class="fas fa-briefcase mr-1 text-info"></i>
                        <a href="<?php echo base_url() ?>companies/details/<?php echo $employerID ?>" class="text-secondary">
                            <span><?php echo $companyName ?></span>
                        </a>
                    </span>
                </div>

                <div class="mr-3">
                    <span
                        data-toggle    = "tooltip"
                        title          = "Location"
                    >    
                        <i class="fas fa-map-marker-alt mr-1 text-info"></i>
                        <span class="text-secondary"><?php echo $location ?></span>
                    </span>
                </div>

                <div class="mr-3">
                    <span
                        data-toggle    = "tooltip"
                        title          = "Offered Salary"
                    >
                        <i class="fas fa-money-bill-wave mr-1 text-info"></i>
                        <span class="text-secondary"><?php echo $offeredSalary ?></span>
                    </span>
                </div>

                <div class="mr-3">
                    <span
                        data-toggle    = "tooltip"
                        title          = "Field"
                    >                
                        <i class="fas fa-cog mr-1 text-info"></i>
                        <span class="text-secondary"><?php echo $field ?></span>
                    </span>
                </div>

            </div>

            <div class="pt-2">
                <span 
                    class          = "
                        badge 
                        text-<?php echo $jobTypeClass ?> 
                        border 
                        border-<?php echo $jobTypeClass ?> 
                        p-2 
                        text-uppercase
                    "
                    data-toggle    = "tooltip"
                    data-placement = "right"
                    title          = "Job Type"
                >
                    <i class="fas fa-user-tie mr-2"></i>
                    <?php echo $jobType ?>
                </span>
            </div>
            
        </div>

    </div>

    <hr class="my-4">

    <?php if ($jobPostFlag == 0) { ?>
        <div class="alert alert-danger mb-4">
            <span>This job is no longer active.</span>
        </div>
    <?php } ?>
    
    <?php
        if ($this->session->userType === 'Jobseeker' && isset($applicationStatus))
            $this->load->view('auth_sections/jobseeker/components/application_status', $applicationStatus);
    ?>
    
    <div class="row pt-2">

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
            
            <?php if ($this->session->userType === 'Employer' && $this->session->id == $employerID) { ?>
                <div class="d-flex justify-content-between alert alert-info p-3 mb-3">
                    <div class="mr-3">
                        <span>Do you want to edit your job post?</span>
                    </div>
                    <div class="text-nowrap">
                        <i class="fas fa-pen text-info"></i>
                        <a class="text-info" href="<?php echo base_url() . 'auth/edit_post/' . $jobPostID ?>">
                            <span>Edit</span>
                        </a>
                    </div>
                </div>
            <?php } ?>
            
            <?php

                // JOBSEEKER CONTROLS
                if ($this->session->userType === 'Jobseeker' && isset($applicationStatus))
                    $this->load->view('auth_sections/jobseeker/components/application_controls', $applicationStatus);

                // JOB SUMMARY CARD
                $this->load->view('sections/components/info_card', [
                    'title'        => 'Job Summary',
                    'theme'        => 'info',
                    'infoID'       => 'jobSummary',
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
                    'infoID'       => 'companyDetails',
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
            ?>
        </div>

    </div>

</div>
</div>

<?php 
    // JOBSEEKER MODALS FOR CONTROLS
    if ($this->session->userType === 'Jobseeker' && isset($applicationStatus))
        $this->load->view('auth_sections/jobseeker/components/application_modals', $applicationStatus) 
?>