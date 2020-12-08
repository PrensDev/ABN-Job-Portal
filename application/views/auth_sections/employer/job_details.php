<?php

if ( $status == 1 ) {
    $statusClass = "success";
    $statusLabel = "Active";
} else {
    $statusClass = "danger";
    $statusLabel = "Not Active";
}

$datePosted = date_format(date_create($dateCreated),"M. d, Y; H:i a");

if ( $dateModified == NULL) {
    $dateStatus = 'Created ' . date_format(date_create($dateCreated),"F d, Y; h:i a");
} else {
    $dateStatus = 'Modified ' . date_format(date_create($dateModified),"F d, Y; h:i a");
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
    $minSalary = number_format($minSalary, 0, '.', '');
} else if ($minSalary < 1000000) {
    $minSalary = number_format($minSalary / 1000, 0, '.', '') . 'K';
} else if ($minSalary < 1000000000) {
    $minSalary = number_format($minSalary / 1000000, 0, '.', '') . 'M';
} else if ($minSalary < 1000000000000) {
    $minSalary = number_format($minSalary / 1000000000, 0, '.', '') . 'B';
} else if ($minSalary < 1000000000000000) {
    $minSalary = number_format($minSalary / 1000000000000, 0, '.', '') . 'T';
} 

if ($maxSalary < 1000) {
    $maxSalary = number_format($maxSalary, 0, '.', '');
} else if ($maxSalary < 1000000) {
    $maxSalary = number_format($maxSalary / 1000, 0, '.', '') . 'K';
} else if ($maxSalary < 1000000000) {
    $maxSalary = number_format($maxSalary / 1000000, 0, '.', '') . 'M';
} else if ($maxSalary < 1000000000000) {
    $maxSalary = number_format($maxSalary / 1000000000, 0, '.', '') . 'B';
} else if ($maxSalary < 1000000000000000) {
    $maxSalary = number_format($maxSalary / 1000000000000, 0, '.', '') . 'T';
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
            <a href="manage_applicants.html" class="btn btn-primary text-nowrap" data-toggle="tooltip" data-placement="left" title="Manage Applicants">
                <i class="fas fa-users"></i>
                <span class="d-none d-sm-inline">
                    <span>Manage Applicants</span>
                </span>
                <span class="badge badge-light ml-1">12</span>
            </a>
        </div>
    </div>
    <!-- END OF HEADER OF CONTENT -->

    <div class="mb-4">
        <hr>
    </div>


    <div class="alert alert-success alert-dismissible fade show my-4 mb-4" role="alert">
        <span>The changes you made has been <strong>saved</strong>.</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <!-- END OF SUCCESS ALERT BOX -->


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

            <!-- HIRED STATUS -->
            <div class="d-flex justify-content-between border border-primary p-3 mb-3">
                <div class="mr-3">
                    <i class="fas fa-users mr-1 text-primary"></i>
                    <span>You've already hired <strong>0</strong> people.</span>
                </div>
                <div>
                    <a class="text-nowrap" href="hired_applicants.html">View All</a>
                </div>
            </div>
            <!-- END OF HIRED STATUS -->
            
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
                                <p class="m-0 text-secondary">
                                    <i class="fas fa-circle mr-1 text-<?php echo $jobTypeClass ?>"></i>
                                    <span><?php echo $jobType ?><span>
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
                        <div class="list-group-item d-flex">
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

                    </div>
                    
                </div>
            </div>
            <!-- END OF JOB SUMMARY CARD -->
            
            <!-- USER CONTROLS -->
            <div>
                <a href="<?php echo base_url() ?>auth/edit_post/<?php echo $jobPostID ?>" class="btn btn-block btn-primary">
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

$this->load->view('templates/modal', [
    'id'            => 'deletePostModal',
    'theme'         => 'danger',
    'title'         => 'Delete this post',
    'icon'          => 'trash',
    'message'       => '
        <p>Are you sure you want to delete this post?</p>
        <p><strong>Note: You cannot retrieved this after you delete it.</strong></p>
    ',
    'actionPath'    => 'auth/delete_post/' . $jobPostID,
    'actionLabel'   => 'Delete',
    'actionIcon'    => 'trash',
]);

?>