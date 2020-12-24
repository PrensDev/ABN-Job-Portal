<?php

if ( $status == 1 ) {
    $statusClass = "success";
    $statusLabel = "Active";
} else {
    $statusClass = "danger";
    $statusLabel = "Not Active";
}

$datePosted = date_format(date_create($dateCreated),"F d, Y; h:i a");

if ( $dateModified == NULL) {
    $dateStatus = 'Created ' . date_format(date_create($dateCreated),"F d, Y; h:i a");
    $dateModifiedLabel = 'This post doesn\'t modified yet.';
} else {
    $dateStatus = 'Modified ' . date_format(date_create($dateModified),"F d, Y; h:i a");
    $dateModifiedLabel = date_format(date_create($dateModified),"F d, Y; h:i a");
}

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

?>

<!-- JOB DETAILS SECTION -->
<div class="container-fluid">
<div class="container py-5">

    <!-- HEADER OF CONTENT -->
    <div class="d-flex justify-content-between align-items-center">
        <div class="mr-3">
            <h1 class="font-weight-normal text-uppercase"><?php echo $jobTitle ?></h1>
            <div>
                <span class="font-weight-bold text-uppercase text-<?php echo $statusClass ?> mr-3"><?php echo $statusLabel ?></span>
                <span class="text-secondary">
                    <i class="fas fa-clock"></i>
                    <span><?php echo $dateStatus ?></span>
                </span>
                
            </div>
        </div>
        <div>
            <?php
                if ($numOfApplicants > 0) {
                    echo '
                        <a href="' . base_url() .'auth/manage_applicants/' . $jobPostID . '" class="btn btn-primary text-nowrap" data-toggle="tooltip" data-placement="left" title="Manage Applicants">
                            <div class="d-inline mr-3">
                                <i class="fas fa-users mr-1"></i>
                                <span class="d-none d-sm-inline">
                                    <span>Manage Applicants</span>
                                </span>
                            </div>
                            <span class="badge badge-light">'. $numOfApplicants . '</span>
                        </a>
                    ';
                } else {
                    echo '<p class="font-italic text-secondary">No applicants had applied yet.</p>';
                }
            ?>
        </div>
    </div>

    <div class="mb-4"><hr></div>

    <div class="alert alert-success alert-dismissible fade show my-4 mb-4" role="alert">
        <span>The changes you made has been <strong>saved</strong>.</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>


    <div class="row mt-1">

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
            
            <div class="d-flex justify-content-between alert alert-primary p-3 mb-3">
                <div class="mr-3">
                    <i class="fas fa-users mr-1 text-primary"></i>
                    <span>You've already hired <strong>0</strong> people.</span>
                </div>
                <div>
                    <a class="text-nowrap text-primary" href="hired_applicants.html">View All</a>
                </div>
            </div>

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
                                <p class="m-0">
                                    <span class="badge border border-<?php echo $jobTypeClass ?> text-<?php echo $jobTypeClass ?> text-uppercase p-2">
                                        <i class="fas fa-user-tie mr-1"></i>
                                        <?php echo $jobType ?>
                                    </span>
                                </p>
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
                        <div class="list-group-item d-flex" title="Offered Salary">
                            <div class="list-group-item-icon h4 text-info">
                                <i class="fas fa-money-bill-wave"></i>
                            </div>
                            <div>
                                <p class="m-0 font-weight-bold">Offered Salary</p>
                                <p class="m-0 text-secondary">&#8369;<?php echo $minSalary ?> - &#8369;<?php echo $maxSalary?></p>
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
                        
                        <!-- DATE MDIFIED -->
                        <div class="list-group-item d-flex">
                            <div class="list-group-item-icon h4 text-info">
                                <i class="fas fa-pen"></i>
                            </div>
                            <div>
                                <p class="m-0 font-weight-bold">Last Modified</p>
                                <p class="m-0 text-secondary"><?php echo $dateModifiedLabel ?></p>
                            </div>
                        </div>

                    </div>
                    
                </div>
            </div>
            <!-- END OF JOB SUMMARY CARD -->
            
            <!-- USER CONTROLS -->
            <div>
                <a 
                    href="<?php echo base_url() ?>auth/edit_post/<?php echo $jobPostID ?>" 
                    class="btn btn-block btn-info"
                    draggable="false"
                >
                    <i class="fas fa-pen mr-2"></i>
                    <span>Edit This Post</span>
                </a>
                <button class="btn btn-block btn-danger" data-toggle="modal" data-target="#deletePostModal">
                    <i class="fas fa-trash mr-2"></i>
                    <span>Delete This Post</span>
                </button>
            </div>
            <!-- END OF USER CONTROLS -->

        </div>
        <!-- END OF JOB SUMMARY -->

    </div>

</div>
</div>

<?php

$this->load->view('sections/components/modal', [
    'id'            => 'deletePostModal',
    'theme'         => 'danger',
    'title'         => 'Delete this post',
    'modalIcon'     => 'WARNING',
    'message'       => '
        <p class="m-1">Are you sure you want to delete this post?</p>
        <p class="m-1"><strong>Note: You cannot retrieved this after you delete it.</strong></p>
    ',
    'actionPath'    => 'auth/delete_post/' . $jobPostID,
    'actionID'      => NULL,
    'actionValue'   => NULL,
    'actionIcon'    => 'trash',
    'actionLabel'   => 'Delete',
]);

?>