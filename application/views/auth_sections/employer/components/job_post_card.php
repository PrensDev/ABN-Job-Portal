<?php
    $jobTypeClass   = getJobTypeClass($jobType);
    $offeredSalary  = salaryRangeFormat($minSalary, $maxSalary);
    $dateCreated    = dateFormat($dateCreated, "M. d, Y; h:i a");

    if ( $jobPostFlag == 1 ) {
        $statusClass = 'success';
        $statusLabel = 'Active';
    } else {
        $statusClass = 'danger';
        $statusLabel = 'Not Active';
    }

?>


<div class="col-lg-6 my-2 user-select-none">
<div class="bg-white p-3 border border d-flex flex-column justify-content-between h-100">
    
    <div class="d-flex">

        <div class="flex-grow-1 mr-1">
            
            <!-- JOB TITLE -->
            <p class="h5 text-uppercase">
                <a 
                    class          = "text-decoration-none text-dark" 
                    data-toggle    = "tooltip"
                    data-placement = "right"
                    title          = "Job Title" 
                    href           = "<?php echo base_url() . 'auth/job_details/' . $jobPostID ?>"
                >
                    <?php echo $jobTitle ?>
                </a>    
            </p>   
                
            <!-- INDUSTRY TYPE -->
            <div class="mr-3 text-secondary">
                <span
                    data-toggle    = "tooltip"
                    data-placement = "right"
                    title          = "Field"    
                >
                    <i class="fas fa-cogs mr-1"></i>
                    <span><?php echo $field ?></span>
                </span>
            </div>
            
            <!-- OFFERED SALARY -->
            <div class="mr-3 text-secondary">
                <span
                    data-toggle    = "tooltip"
                    data-placement = "right"
                    title          = "Offered Salary"    
                >
                    <i class="fas fa-money-bill-wave mr-1"></i>
                    <span><?php echo $offeredSalary ?></span>
                </span>
            </div>

            <!-- JOB TYPE -->
            <div class="mt-2">
                <span 
                    class = "
                        badge 
                        border 
                        border-<?php echo $jobTypeClass ?> 
                        text-<?php echo $jobTypeClass ?> 
                        p-2 
                        text-uppercase
                    "
                    data-toggle    = "tooltip"
                    data-placement = "right"
                    title          = "Job Type"
                >
                    <i class="fas fa-user-tie mr-1"></i>
                    <?php echo $jobType ?>
                </span>
            </div>

        </div>

        <div class="text-right">
            
            <!-- STATUS -->
            <div>
                <span 
                    class = "
                        badge 
                        text-uppercase 
                        text-<?php echo $statusClass ?>
                    " 
                    data-toggle    = "tooltip"
                    data-placement = "left"
                    title          = "This post is <?php echo ucwords($statusLabel) ?>"
                >
                    <?php echo $statusLabel ?>
                </span>
            </div>
            
            <!-- DATE POSTED -->
            <div>
                <span 
                    class          = "badge text-secondary mt-1" 
                    data-toggle    = "tooltip"
                    data-placement = "left"
                    title          = "Posted <?php echo $dateCreated ?>"
                >
                    <i class="fas fa-clock"></i>
                    <?php echo $dateCreated ?>
                </span>
            </div>

        </div>
    </div>
    

    <!-- USER-ACTIONS -->
    <div class="d-flex justify-content-between align-items-center mt-4">
        <div>
            <?php
                if ($applicantsNum > 0) {
                    $s = $applicantsNum > 1 ? 's' : '';
            ?>
                <a 
                    href            = "<?php echo base_url() . 'auth/manage_applicants/' . $jobPostID ?>" 
                    class           = "btn btn-primary"
                    data-toggle     = "tooltip"
                    data-placement  = "top"
                    title           = "<?php echo 'There are ' . $applicantsNum . ' applicant' . $s . ' for this job.' ?>"
                >
                    <span class="mr-4">
                        <i class="fas fa-users mr-1"></i>
                        <span class="d-none d-sm-inline">Manage Applicants</span>
                    </span>
                    <span class="badge badge-light"><?php echo $applicantsNum ?></span>
                </a>
            <?php } else { ?>
                <span class="font-italic text-secondary">No applicants yet.</span>
            <?php } ?>
        </div>
        <div>
            <a 
                href           = "<?php echo base_url() ?>auth/edit_post/<?php echo $jobPostID ?>" 
                class          = "btn border text-info"  
                data-toggle    = "tooltip" 
                data-placement = "top" 
                title          = "Edit Post"
            >
                <i class="fas fa-pen"></i>
            </a>
            <a 
                href           = "<?php echo base_url() ?>auth/job_details/<?php echo $jobPostID ?>" 
                class          = "btn border text-secondary" 
                data-toggle    = "tooltip" 
                data-placement = "top" 
                title          = "View More"
            >
                <i class="fas fa-ellipsis-h"></i>
            </a>
        </div>
    </div>

</div>
</div>