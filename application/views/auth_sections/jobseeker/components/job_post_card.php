<?php
    $jobTypeClass   = getJobTypeClass($jobType);
    $offeredSalary  = salaryRangeFormat($minSalary, $maxSalary);

    if (isset($dateApplied)) {
        $userDate = 'Applied ' . dateFormat($dateApplied,"M. d, Y") . ' at ' . dateFormat($dateApplied,"h:i a");
    } else if (isset($dateBookmarked)) {
        $userDate = 'Added ' . dateFormat($dateBookmarked,"M. d, Y") . ' at ' . dateFormat($dateBookmarked,"h:i a");
    }
?>

<div class="col-lg-6 my-2">
<div class="bg-white p-3 border d-flex flex-column h-100 justify-content-between">
    
    <div class="d-flex mb-3 mr-1">

        <!-- COMPANY LOGO -->
        <div class="company-logo mr-3 d-none d-sm-block">
            <a href="<?php echo base_url() ?>companies/details/<?php echo $employerID ?>">
                <?php if (isset($profilePic)) { ?>
                    <img 
                        class   = "border" 
                        src     = "<?php echo base_url() . 'public/img/employers/' . $profilePic ?>" 
                    >
                <?php } else { ?>
                    <img 
                        class   = "border" 
                        src     = "<?php echo base_url() ?>public/img/employers/blank_dp.png" 
                    >
                <?php } ?>
            </a>
        </div>

        <!-- JOB DETAILS -->
        <div class="flex-grow-1">
            
            <div>
                <span
                    class          = "h5 text-uppercase m-0"
                    data-toggle    = "tooltip"
                    data-placement = "right"
                    title          = "Job Title"
                >
                    <a href="<?php echo base_url() ?>jobs/details/<?php echo $jobPostID ?>" class="text-decoration-none text-dark"><?php echo $jobTitle ?></a>
                </span>
            </div>
            
            <?php if($jobPostFlag == 0) { ?>
                <div
                    class          = "badge px-0 text-danger"
                    data-toggle    = "tooltip"
                    data-placement = "right"
                    title          = "This job is no longer active"
                >NOT ACTIVE</div>
            <?php } ?>

            <div class="mr-3 text-primary mt-1">
                <a 
                    href           = "<?php echo base_url() ?>companies/details/<?php echo $employerID ?>" 
                    class          = "text-primary" 
                    data-toggle    = "tooltip"
                    data-placement = "right"
                    title          = "Company"
                >
                    <span><?php echo $companyName ?></span>
                </a>
            </div>


            <?php $this->load->view('auth_sections/jobseeker/components/sub_components/application_status_badge') ?>

            <!-- JOB DETAILS -->
            <div class="d-flex flex-wrap text-secondary mt-2">
                
                <!-- OFFERED SALARY -->
                <div class="mr-3">
                    <span
                        data-toggle    = "tooltip"
                        data-placement = "right"
                        title          = "Offered Salary"
                    >
                        <i class="fas fa-money-bill-wave mr-1"></i>
                        <span><?php echo $offeredSalary ?></span>
                    </span>
                </div>

                <!-- INDUSTRY TYPE -->
                <div class="mr-3 text-capitalize">
                    <span
                        data-toggle    = "tooltip"
                        data-placement = "right"
                        title          = "Field"
                    >
                        <i class="fas fa-cog mr-1"></i>
                        <span><?php echo $field ?></span>
                    </span>
                </div>

                <!-- LOCATION -->
                <div class="mr-3 text-capitalize" title="Location: <?php echo $location ?>">
                    <span
                        data-toggle    = "tooltip"
                        data-placement = "right"
                        title          = "Location"
                    >
                        <i class="fas fa-map-marker-alt mr-1"></i>
                        <span><?php echo $location ?></span>
                    </span>
                </div>
                
            </div>

        </div>

        <!-- JOB SUB-DETAILS -->
        <div class="text-right" title="Job Type: <?php echo $jobType ?>">
            <span
                data-toggle    = "tooltip"
                data-placement = "left"
                title          = "Job Type"
            >
                <span class="badge border border-<?php echo $jobTypeClass ?> text-<?php echo $jobTypeClass ?> p-2 text-uppercase">
                    <i class="fas fa-user-tie mr-1"></i>
                    <span><?php echo $jobType ?></span>
                </span>
            </span>
            <?php if (isset($userDate)) { ?>
                <span 
                    class = "badge text-wrap text-secondary text-right mt-1" 
                    title = "<?php echo $userDate ?>"
                ><?php echo $userDate ?></span>
            <?php } ?>
        </div>

    </div>

    <!-- USER-ACTIONS -->
    <div class="text-right">
        <?php if (isset($bookmarkID)) { ?>
            <button 
                class           = "btn border border-warning text-warning" 
                data-toggle     = "tooltip" 
                data-placement  = "top" 
                title           = "Remove bookmark" 
                value           = "<?php echo $bookmarkID ?>" 
                id              = "removeBookmarkBtn"
            >
                <i class="fas fa-bookmark"></i>
            </button>
        <?php } else { ?>
            <button 
                class           = "btn border border-warning text-warning" 
                data-toggle     = "tooltip" 
                data-placement  = "top" 
                title           = "Add to bookmark" 
                value           = "<?php echo $jobPostID ?>" 
                id              = "addBookmarkBtn"
            >
                <i class="far fa-bookmark"></i>
            </button>
        <?php } ?>
        <a href="<?php echo base_url() ?>jobs/details/<?php echo $jobPostID ?>" class="btn btn-secondary">View More</a>
    </div>

</div>
</div>