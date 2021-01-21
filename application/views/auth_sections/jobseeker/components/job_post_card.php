<?php
    $jobTypeClass   = getJobTypeClass($jobType);
    $offeredSalary  = salaryRangeFormat($minSalary, $maxSalary);

    if (isset($dateApplied)) {
        $userDate = 'Applied ' . date_format(date_create($dateApplied),"M. d, Y") . ' at ' . date_format(date_create($dateApplied),"h:i a");
    } else if (isset($dateBookmarked)) {
        $userDate = 'Added ' . date_format(date_create($dateBookmarked),"M. d, Y") . ' at ' . date_format(date_create($dateBookmarked),"h:i a");
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
            
            <p class="h5 text-uppercase m-0" title="Job Title: <?php echo $jobTitle ?>">
                <a href="<?php echo base_url() ?>jobs/details/<?php echo $jobPostID ?>" class="text-decoration-none text-dark"><?php echo $jobTitle ?></a>
            </p>

            <div class="mr-3 text-primary mt-1">
                <a href="<?php echo base_url() ?>companies/details/<?php echo $employerID ?>" class="text-primary" title="Company: <?php echo $companyName ?>">
                    <span><?php echo $companyName ?></span>
                </a>
            </div>

            <?php
                if ($this->session->userType == 'Job Seeker') {
                    if (isset($status)) {
                        if ($status == 'Pending') {
                            echo '
                                <div>
                                    <span class="badge badge-success px-2 py-1" title="Your application is pending.">Pending</span>
                                </div>
                            ';
                        } else if ($status == 'Hired') {
                            echo '
                                <div>
                                    <span class="badge badge-primary px-2 py-1" title="You are hired for this job.">Hired</span>
                                </div>
                            ';
                        } else if ($status == 'Rejected') {
                            echo '
                                <div>
                                    <span class="badge badge-danger px-2 py-1" title="You are rejected for this job.">Rejected</span>
                                </div>
                            ';
                        }
                    }
                }            
            ?>

            <!-- JOB DETAILS -->
            <div class="d-flex flex-wrap text-secondary mt-2">
                
                <!-- OFFERED SALARY -->
                <div class="mr-3" title="Offered Salary: <?php echo $offeredSalary ?>">
                    <i class="fas fa-money-bill-wave mr-1"></i>
                    <span><?php echo $offeredSalary ?></span>
                </div>

                <!-- INDUSTRY TYPE -->
                <div class="mr-3 text-capitalize" title="Industry Type: <?php echo $field ?>">
                    <i class="fas fa-cog mr-1"></i>
                    <span><?php echo $field ?></span>
                </div>

                <!-- LOCATION -->
                <div class="mr-3 text-capitalize" title="Location: <?php echo $location ?>">
                    <i class="fas fa-map-marker-alt mr-1"></i>
                    <span><?php echo $location ?></span>
                </div>
                
            </div>

        </div>

        <!-- JOB SUB-DETAILS -->
        <div class="text-right" title="Job Type: <?php echo $jobType ?>">
            <span class="badge border border-<?php echo $jobTypeClass ?> text-<?php echo $jobTypeClass ?> p-2 text-uppercase">
                <i class="fas fa-user-tie mr-1"></i>
                <span><?php echo $jobType ?></span>
            </span>
            <?php
                if (isset($userDate)) {
                    echo '
                        <span 
                            class="badge text-wrap text-secondary text-right mt-1" 
                            title="' . $userDate . '"
                        >' . $userDate . '</span>
                    ';
                }
            ?>
        </div>

    </div>

    <!-- USER-ACTIONS -->
    <div class="text-right">
        <?php
            if (isset($bookmarkID)) {
                echo '
                    <button 
                        class           = "btn border border-warning text-warning" 
                        data-toggle     = "tooltip" 
                        data-placement  = "top" 
                        title           = "Remove bookmark" 
                        value           = "' . $bookmarkID . '" 
                        id              = "removeBookmarkBtn"
                    >
                        <i class="fas fa-bookmark"></i>
                    </button>    
                ';
            } else {
                echo '
                    <button 
                        class           = "btn border border-warning text-warning" 
                        data-toggle     = "tooltip" 
                        data-placement  = "top" 
                        title           = "Add to bookmark" 
                        value           = "' . $jobPostID . '" 
                        id              = "addBookmarkBtn"
                    >
                        <i class="far fa-bookmark"></i>
                    </button>    
                ';
            }
        ?>
        <a href="<?php echo base_url() ?>jobs/details/<?php echo $jobPostID ?>" class="btn btn-secondary">View More</a>
    </div>

</div>
</div>