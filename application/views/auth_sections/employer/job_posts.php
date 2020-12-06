<!-- APPLICANT PROFILE DETAILS SECTION -->
<div class="container-fluid">
<div class="container-md py-5">
    
    <!-- HEADER OF CONTENT -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="font-weight-normal m-0">Job Posts (12)</h1>
        </div>
        <div>
            <a href="<?php echo base_url() ?>auth/post_new_job" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="left" title="Post new job">
                <i class="fas fa-pen"></i>
                <span class="d-none d-sm-inline">Post new job</span>
            </a>
        </div>
    </div>
    <!-- END OF HEADER OF CONTENT -->

    <!-- SUCCESS ALERT BOX -->
    <div class="alert alert-success alert-dismissible fade show my-2 mb-4" role="alert">
        <span>New job has successfully been <strong>added</strong>.</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <!-- END OF SUCCESS ALERT BOX -->

    <!-- PAGINATION SECTION -->
    <div class="d-flex justify-content-between align-items-top">
        <div>
            <span class="text-secondary text-right">Showing page 1 of 2</span>
        </div>
        <!-- PAGINATION -->
        <nav class="d-none d-sm-block">
                <ul class="pagination justify-content-end">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                            <i class="fas fa-caret-left"></i>
                        </a>
                    </li>
                    <li class="page-item active">
                        <a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">3</a>
                    </li>
                    <li class="page-item disabled">
                        <a class="page-link" href="#">...</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">18</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">
                            <i class="fas fa-caret-right"></i>
                        </a>
                    </li>
                </ul>
        </nav>
        <!-- END OF PAGINATION -->
    </div>
    <!-- END OF PAGINATION SECTION -->


    <!-- JOB LIST -->
    <div class="row my-2">
        <?php

            $query = $this->db->query("EXEC [GetJobPosts] @employerID = '" . $this->session->id . "'");
            $rows  = $query->result();

            foreach ( $rows as $row ) {
                $jobType = $row->jobType;
                if ($jobType == 'Full Time') {
                    $jobTypeClass = 'success';
                } else if ($jobType == 'Part Time') {
                    $jobTypeClass = 'info';
                } else if ($jobType == 'Internship/OJT') {
                    $jobTypeClass = 'warning';
                } else if ($jobType == 'Temporary') {
                    $jobTypeClass = 'secondary';
                }

                if ( $row->status == 1 ) {
                    $statusClass = 'success';
                    $statusLabel = 'Active';
                } else {
                    $statusClass = 'danger';
                    $statusLabel = 'Not Active';
                }
                echo '
                    <div class="col-lg-6 my-1">
                    <div class="bg-white p-3 border">
                        
                        <div class="d-flex">
        
                            <!-- JOB DETAILS -->
                            <div class="flex-grow-1 mb-3">
                                <!-- JOB TITLE -->
                                <p class="h5 text-uppercase m-0">' . $row->jobTitle . '</p>
        
                                <!-- JOB DETAILS -->
                                <div class="d-flex flex-wrap text-secondary mt-2">
                                    
                                    <!-- OFFERED SALARY -->
                                    <div class="mr-3">
                                        <i class="fas fa-money-bill-wave mr-1"></i>
                                        <span>P' . $row->minSalary . ' - P' . $row->maxSalary . '</span>
                                    </div>
        
                                    <!-- INDUSTRY TYPE -->
                                    <div class="mr-3">
                                        <i class="fas fa-cogs mr-1"></i>
                                        <span>' . $row->industryType . '</span>
                                    </div>
        
                                    <!-- DATE CREATED -->
                                    <div class="mr-3">
                                        <i class="fas fa-clock mr-1"></i>
                                        <span>' . $row->dateCreated . '</span>
                                    </div>
                                    
                                </div>
        
                                <!-- JOB TYPE -->
                                <div class="mt-1">
                                    <span class="badge badge-' . $jobTypeClass . ' p-2 text-uppercase">' . $row->jobType . '</span>
                                </div>
        
                            </div>
        
                            <!-- JOB POST STATUS -->
                            <div>
                                <span class="badge text-uppercase text-' . $statusClass . '">' . $statusLabel . '</span>
                            </div>
        
                        </div>
        
                        <div>
                            <p class="text-truncate">' . $row->description . '</p>
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
                                <a href="edit_job_post.html" class="btn btn-outline-primary"  data-toggle="tooltip" data-placement="top" title="Edit Post">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <button class="btn btn-outline-danger" data-toggle="tooltip" data-placement="top" title="Delete Post">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <a href="job_post.html" class="btn btn-outline-secondary"  data-toggle="tooltip" data-placement="top" title="View More">
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

    <!-- PAGINATION -->
    <nav class="mt-3">
        <ul class="pagination justify-content-end">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                    <i class="fas fa-caret-left"></i>
                </a>
            </li>
            <li class="page-item active">
                <a class="page-link" href="#">1</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#">2</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#">3</a>
            </li>
            <li class="page-item disabled">
                <a class="page-link" href="#">...</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#">18</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#">
                    <i class="fas fa-caret-right"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- END OF PAGINATION -->

</div>
</div>