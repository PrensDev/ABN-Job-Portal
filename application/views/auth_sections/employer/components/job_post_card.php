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
<div class="col-lg-6 my-1 user-select-none">
<div class="bg-white p-3 border d-flex flex-column justify-content-between h-100">
    
    <div>
        <div class="d-flex">

            <!-- JOB DETAILS -->
            <div class="flex-grow-1 mb-3">
                <!-- JOB TITLE -->
                <p class="h5 text-uppercase m-0">
                    <a class="text-decoration-none text-dark" title="Job Title: <?php echo $jobTitle ?>" href="<?php echo base_url() ?>auth/job_details/<?php echo $jobPostID ?>">
                    <?php echo $jobTitle ?>
                    </a>    
                </p>

                <!-- JOB DETAILS -->
                <div class="d-flex flex-wrap text-secondary mt-2">
                    
                    <!-- OFFERED SALARY -->
                    <div class="mr-3" title="Offered Salary: <?php echo $offeredSalary ?>">
                        <i class="fas fa-money-bill-wave mr-1"></i>
                        <span><?php echo $offeredSalary ?></span>
                    </div>

                    <!-- INDUSTRY TYPE -->
                    <div class="mr-3 text-capitalize" title="Industry Type: <?php echo $industryType ?>">
                        <i class="fas fa-cogs mr-1"></i>
                        <span><?php echo $industryType ?></span>
                    </div>

                    <!-- DATE CREATED -->
                    <div class="mr-3" title="Posted <?php echo $dateCreated ?>">
                        <i class="fas fa-clock mr-1"></i>
                        <span><?php echo $dateCreated ?></span>
                    </div>
                    
                </div>

                <!-- JOB TYPE -->
                <div class="mt-1">
                    <span class="badge badge-<?php echo $jobTypeClass ?> p-2 text-uppercase" title="Job Type: <?php echo $jobType ?>">
                        <i class="fas fa-user-tie mr-1"></i>
                        <?php echo $jobType ?>
                    </span>
                </div>

            </div>

            <!-- JOB POST STATUS -->
            <div>
                <span class="badge text-uppercase text-<?php echo $statusClass ?>" title="This post is <?php echo $statusLabel ?>"><?php echo $statusLabel ?></span>
            </div>
        </div>
    
        <div>
            <p class="text-truncate" title="View more to read description"><?php echo $description ?></p>
        </div>
    </div>    

    <!-- USER-ACTIONS -->
    <div class="d-flex justify-content-between">
        <div>
            <a href="manage_applicants.html" class="btn btn-primary"data-toggle="tooltip" data-placement="top" title="Manage Applicants">
                <span class="mr-2">
                    <i class="fas fa-users"></i>
                    <span class="d-none d-sm-inline">Manage Applicants</span>
                </span>
                <span class="badge badge-light">34</span>
            </a>
        </div>
        <div>
            <a href="<?php echo base_url() ?>auth/edit_post/<?php echo $jobPostID ?>" class="btn btn-outline-primary"  data-toggle="tooltip" data-placement="top" title="Edit Post">
                <i class="fas fa-pen"></i>
            </a>
            <a href="<?php echo base_url() ?>auth/job_details/<?php echo $jobPostID ?>" class="btn btn-outline-secondary"  data-toggle="tooltip" data-placement="top" title="View More">
                <i class="fas fa-ellipsis-h"></i>
            </a>
        </div>
    </div>

</div>
</div>