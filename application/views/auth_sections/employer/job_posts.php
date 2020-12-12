<!-- APPLICANT PROFILE DETAILS SECTION -->
<div class="container-fluid">
<div class="container-md py-5">
    
    <!-- HEADER OF CONTENT -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="font-weight-normal m-0 mb-3">Job Posts</h1>
            <span class="text-secondary text-right">Showing page 1 of 2</span>
        </div>
        <div>
            <a href="<?php echo base_url() ?>auth/post_new_job" class="btn btn-primary" data-toggle="tooltip" data-placement="left" title="Post new job">
                <i class="fas fa-pen"></i>
                <span class="d-none d-sm-inline">Post new job</span>
            </a>
        </div>
    </div>
    <!-- END OF HEADER OF CONTENT -->

    <div class="alert alert-success alert-dismissible fade show my-2 mb-4" role="alert">
        <span>New job has successfully been <strong>added</strong>.</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>


    <!-- JOB LIST -->
    <div class="row mt-2 mb-5">
        <?php

            foreach ( $posts as $post ) {
                $jobType = $post->jobType;
                if ($jobType == 'Full Time') {
                    $jobTypeClass = 'success';
                } else if ($jobType == 'Part Time') {
                    $jobTypeClass = 'info';
                } else if ($jobType == 'Internship/OJT') {
                    $jobTypeClass = 'warning';
                } else if ($jobType == 'Temporary') {
                    $jobTypeClass = 'secondary';
                }

                if ( $post->status == 1 ) {
                    $statusClass = 'success';
                    $statusLabel = 'Active';
                } else {
                    $statusClass = 'danger';
                    $statusLabel = 'Not Active';
                }

                $minSalary = $post->minSalary;

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

                $maxSalary = $post->maxSalary;

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
                
                $dateCreated = date_format(date_create($post->dateCreated),"M. d, Y; h:i a");

                echo '
                    <div class="col-lg-6 my-1 user-select-none">
                    <div class="bg-white p-3 border">
                        
                        <div class="d-flex">
        
                            <!-- JOB DETAILS -->
                            <div class="flex-grow-1 mb-3">
                                <!-- JOB TITLE -->
                                <p class="h5 text-uppercase m-0" title="Job Title: '. $post->jobTitle .'">' . $post->jobTitle . '</p>
        
                                <!-- JOB DETAILS -->
                                <div class="d-flex flex-wrap text-secondary mt-2">
                                    
                                    <!-- OFFERED SALARY -->
                                    <div class="mr-3" title="Offered Salary: ' . $offeredSalary . '">
                                        <i class="fas fa-money-bill-wave mr-1"></i>
                                        <span>' . $offeredSalary . '</span>
                                    </div>
        
                                    <!-- INDUSTRY TYPE -->
                                    <div class="mr-3 text-capitalize" title="Industry Type: ' . $post->industryType . '">
                                        <i class="fas fa-cogs mr-1"></i>
                                        <span>' . $post->industryType . '</span>
                                    </div>
        
                                    <!-- DATE CREATED -->
                                    <div class="mr-3" title="Posted ' . $dateCreated . '">
                                        <i class="fas fa-clock mr-1"></i>
                                        <span>' . $dateCreated . '</span>
                                    </div>
                                    
                                </div>
        
                                <!-- JOB TYPE -->
                                <div class="mt-1" title="Job Type: ' . $post->jobType . '">
                                    <span class="badge badge-' . $jobTypeClass . ' p-2 text-uppercase">
                                        <i class="fas fa-user-tie mr-1"></i>
                                        ' . $post->jobType . '
                                    </span>
                                </div>
        
                            </div>
        
                            <!-- JOB POST STATUS -->
                            <div>
                                <span class="badge text-uppercase text-' . $statusClass . '" title="This post is ' . $statusLabel . '">' . $statusLabel . '</span>
                            </div>
        
                        </div>
        
                        <div>
                            <p class="text-truncate" title="View more to read description">' . $post->description . '</p>
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
                                <a href="' . base_url() . 'auth/edit_post/' . $post->jobPostID . '" class="btn btn-outline-primary"  data-toggle="tooltip" data-placement="top" title="Edit Post">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <a href="' . base_url() . 'auth/job_details/' . $post->jobPostID . '" class="btn btn-outline-secondary"  data-toggle="tooltip" data-placement="top" title="View More">
                                    <i class="fas fa-ellipsis-h"></i>
                                </a>
                            </div>
                        </div>
        
                    </div>
                    </div>
                ';
            }
        ?>
        

    </div>
    <!-- END OF JOB LIST -->

    <?php echo $this->pagination->create_links(); ?>

</div>
</div>