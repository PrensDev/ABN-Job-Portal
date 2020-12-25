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

if ( $status == 1 ) {
    $statusClass = 'success';
    $statusLabel = 'Active';
} else {
    $statusClass = 'danger';
    $statusLabel = 'Not Active';
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

$dateCreated = date_format(date_create($dateCreated),"M. d, Y; h:i a");

?>


<div class="col-lg-6 my-2 user-select-none">
<div class="bg-white p-3 shadow d-flex flex-column justify-content-between h-100">
    
    <div class="d-flex">

        <div class="flex-grow-1 mr-1">
            
            <!-- JOB TITLE -->
            <p class="h5 text-uppercase">
                <a class="text-decoration-none text-dark" title="Job Title: <?php echo $jobTitle ?>" href="<?php echo base_url() ?>auth/job_details/<?php echo $jobPostID ?>">
                <?php echo $jobTitle ?>
                </a>    
            </p>   
                
            <!-- INDUSTRY TYPE -->
            <div class="mr-3 text-secondary" title="Industry Type: <?php echo $industryType ?>">
                <i class="fas fa-cogs mr-1"></i>
                <span><?php echo $industryType ?></span>
            </div>
            
            <!-- OFFERED SALARY -->
            <div class="mr-3 text-secondary" title="Offered Salary: <?php echo $offeredSalary ?>">
                <i class="fas fa-money-bill-wave mr-1"></i>
                <span><?php echo $offeredSalary ?></span>
            </div>

            <!-- JOB TYPE -->
            <div class="mt-2">
                <span class="badge border border-<?php echo $jobTypeClass ?> text-<?php echo $jobTypeClass ?> p-2 text-uppercase" title="Job Type: <?php echo $jobType ?>">
                    <i class="fas fa-user-tie mr-1"></i>
                    <?php echo $jobType ?>
                </span>
            </div>

        </div>

        <div class="text-right">
            
            <!-- STATUS -->
            <div>
                <span class="badge text-uppercase text-<?php echo $statusClass ?>" title="This post is <?php echo ucwords($statusLabel) ?>">
                    <i class="fas fa-circle mr-1 text-<?php echo $statusClass ?>"></i>
                    <?php echo $statusLabel ?>
                </span>
            </div>
            
            <!-- DATE POSTED -->
            <div>
                <span class="badge text-secondary mt-1" title="Posted <?php echo $dateCreated ?>">
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
                if ($numOfApplicants > 0) {
                    $s = $numOfApplicants > 1 ? 's' : '';
                    echo '
                        <a href="' . base_url() . 'auth/manage_applicants/' . $jobPostID . '" class="btn btn-primary"data-toggle="tooltip" data-placement="top" title="' . $numOfApplicants . ' applicant' . $s . ' apply for ' . $jobTitle . '.">
                            <span class="mr-4">
                                <i class="fas fa-users mr-1"></i>
                                <span class="d-none d-sm-inline">Manage Applicants</span>
                            </span>
                            <span class="badge badge-light">' . $numOfApplicants . '</span>
                        </a>
                    ';
                } else {
                    echo '
                        <p class="m-0 font-italic text-secondary">No applicants yet.</p>
                    ';
                }
            ?>
        </div>
        <div>
            <a href="<?php echo base_url() ?>auth/edit_post/<?php echo $jobPostID ?>" class="btn btn-info"  data-toggle="tooltip" data-placement="top" title="Edit Post">
                <i class="fas fa-pen"></i>
            </a>
            <a href="<?php echo base_url() ?>auth/job_details/<?php echo $jobPostID ?>" class="btn btn-secondary"  data-toggle="tooltip" data-placement="top" title="View More">
                <i class="fas fa-ellipsis-h"></i>
            </a>
        </div>
    </div>

</div>
</div>