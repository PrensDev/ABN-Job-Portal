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
        $minSalary = number_format($minSalary / 1000, 1, '.', 'K');
    } else if ($minSalary < 1000000000) {
        $minSalary = number_format($minSalary / 1000000, 1, '.', 'M');
    } else if ($minSalary < 1000000000000) {
        $minSalary = number_format($minSalary / 1000000000, 1, '.', 'B');
    } 

    if ($maxSalary < 1000) {
        $maxSalary = number_format($maxSalary, 1, '.', '');
    } else if ($maxSalary < 1000000) {
        $maxSalary = number_format($maxSalary / 1000, 1, '.', 'K');
    } else if ($maxSalary < 1000000000) {
        $maxSalary = number_format($maxSalary / 1000000, 1, '.', 'M');
    } else if ($maxSalary < 1000000000000) {
        $maxSalary = number_format($maxSalary / 1000000000, 1, '.', 'B');
    }

    $offeredSalary = '&#8369;' . $minSalary . ' - &#8369;' . $maxSalary;

    $dateCreated = date_format(date_create($dateCreated),"M. d, Y");
?>

<div class="col-lg-6 my-2">
<div class="bg-white p-3 shadow d-flex flex-column h-100 justify-content-between">
    
    <div class="d-flex mb-3 mr-1">

        <!-- COMPANY LOGO -->
        <div class="company-logo mr-3 d-none d-sm-block">
            <a href="<?php echo base_url() ?>companies/details/<?php echo $employerID ?>">
                <img class="border" src="<?php echo base_url() ?>public/img/job_logo_5.jpg" alt="">
            </a>
        </div>

        <!-- JOB DETAILS -->
        <div class="flex-grow-1">
            
            <h5 class="mb-1">
                <a href="<?php echo base_url() ?>jobs/details/<?php echo $jobPostID ?>" title="Job Title: <?php echo $jobTitle ?>" class="text-decoration-none text-uppercase text-dark"><?php echo $jobTitle ?></a>
            </h5>
            
            <div class="text-primary">
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
                <div class="mr-3 text-capitalize" title="Industry Type: <?php echo $industryType ?>">
                    <i class="fas fa-cog mr-1"></i>
                    <span><?php echo $industryType ?></span>
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
            <span class="badge text-secondary mt-1" title="Posted <?php echo $dateCreated ?>">
                <i class="fas fa-clock"></i>
                <?php echo $dateCreated ?>
            </span>
        </div>

    </div>

    <!-- USER-ACTIONS -->
    <div class="text-right">
        <?php
            if ($this->session->userType == 'Job Seeker') {
                if ($bookmarkID == NULL) {
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
                } else {
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
                }
                
            } else if ($this->session->userType == 'Employer' && $this->session->id == $employerID) {
                echo '
                    <a href="' . base_url() . 'auth/edit_post/' . $jobPostID . '" class="btn btn-info"  data-toggle="tooltip" data-placement="top" title="Edit Post">
                        <i class="fas fa-pen"></i>
                    </a>
                ';
            }
        ?>
        <a href="<?php echo base_url() ?>jobs/details/<?php echo $jobPostID ?>" class="btn btn-secondary">View More</a>
    </div>

</div>
</div>