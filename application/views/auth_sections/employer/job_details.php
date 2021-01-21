<?php
    if ( $status == 1 ) {
        $statusClass = "success";
        $statusLabel = "Active";
    } else {
        $statusClass = "danger";
        $statusLabel = "Not Active";
    }

    $jobTypeClass   = getJobTypeClass($jobType);
    $datePosted     = dateFormat($dateCreated ,"F d, Y; h:i a");

    if ( $dateModified == NULL) {
        $dateStatus = 'Created ' . dateFormat($dateCreated, "F d, Y") . ' at ' . dateFormat($dateCreated, "h:i a.");
        $dateModifiedLabel = 'This post doesn\'t modified yet.';
    } else {
        $dateStatus = 'Modified ' . dateFormat($dateCreated, "F d, Y") . ' at ' . dateFormat($dateCreated, "h:i a.");
        $dateModifiedLabel = dateFormat($dateModified, "F d, Y; h:i a");
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
            <?php if ($numOfApplicants > 0) { ?>
                <a 
                    href            = "<?php echo base_url() .'auth/manage_applicants/' . $jobPostID ?>" 
                    class           = "btn btn-primary text-nowrap" 
                    data-toggle     = "tooltip" 
                    data-placement  = "left" 
                    title           = "Manage Applicants"
                >
                    <div class="d-inline mr-3">
                        <i class="fas fa-users mr-1"></i>
                        <span class="d-none d-sm-inline">
                            <span>Manage Applicants</span>
                        </span>
                    </div>
                    <span class="badge badge-light"><?php echo $numOfApplicants ?></span>
                </a>
            <?php } else { ?>
                <p class="font-italic text-secondary">No applicants had applied yet.</p>
            <?php } ?>
        </div>
    </div>

    <div class="mb-4"><hr></div>

    <?php if ($this->session->flashdata('updated') == 'success') { ?>
        <div class="alert alert-success alert-dismissible fade show my-4 mb-4" role="alert">
            <span>The changes you made has been <strong>saved</strong>.</span>
            <button type="button" class="btn close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } else if ($this->session->flashdata('updated') == 'failed') { ?>
        <div class="alert alert-danger alert-dismissible fade show my-4 mb-4" role="alert">
            <span>Something <strong>wrong</strong> is happened.</span>
            <button type="button" class="btn close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } ?>

    <div class="row mt-1">

        <!-- JOB DETAILS -->
        <div class="col-lg-8">
        <div class="mb-3 mb-lg-0">

            <?php 
                $jobDetails = [
                    [
                        'icon'    => 'align-left',
                        'element' => 'Description',
                        'content' => $description,
                    ],
                    [
                        'icon'    => 'bullseye',
                        'element' => 'Responsibilities',
                        'content' => $responsibilities,
                    ],
                    [
                        'icon'    => 'cogs',
                        'element' => 'Skills Set',
                        'content' => $skills,
                    ],
                    [
                        'icon'    => 'chart-line',
                        'element' => 'Experiences',
                        'content' => $experiences,
                    ],
                    [
                        'icon'    => 'book',
                        'element' => 'Education',
                        'content' => $education,
                    ],
                ];
                
                foreach($jobDetails as $jobDetail) {
            ?>            
                <div class="mb-5">
                    <h5 class="text-primary mb-3">
                        <i class="fas fa-<?php echo $jobDetail['icon'] ?> mr-2"></i>  
                        <span><?php echo $jobDetail['element'] ?></span> 
                    </h5>
                    <p><?php echo $jobDetail['content'] ?></p>
                </div>
            <?php } ?>
            
        </div>
        </div>
        
        <!-- JOB SUMMARY -->
        <div class="col-lg-4"> 
            
            <div class="d-flex justify-content-between alert alert-primary p-3 mb-3">
                <div class="mr-3">
                    <i class="fas fa-users mr-1 text-primary"></i>
                    <span>You've already hired <strong>0</strong> people.</span>
                </div>
                <div>
                    <a class="text-nowrap text-primary" href="<?php echo base_url() . 'auth/manage_applicants/' . $jobPostID . '/hired' ?>">View All</a>
                </div>
            </div>

            <!-- JOB SUMMARY CARD -->
            <div class="card mb-3">
                <div class="card-header bg-white">
                    <strong>Job Summary</strong>
                </div>
                <div class="card-body p-0">
                    
                    <div class="list-group list-group-flush">

                        <!-- JOB TYPE -->
                        <div class="list-group-item d-flex border-0">
                            <div class="list-group-item-icon h5 text-info">
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
                        <div class="list-group-item d-flex border-0">
                            <div class="list-group-item-icon h5 text-info">
                                <i class="fas fa-cogs"></i>
                            </div>
                            <div>
                                <p class="m-0 font-weight-bold">Field</p>
                                <p class="m-0 text-secondary"><?php echo $field ?></p>
                            </div>
                        </div>

                        <!-- OFFERED SALARY -->
                        <div class="list-group-item d-flex border-0" title="Offered Salary">
                            <div class="list-group-item-icon h5 text-info">
                                <i class="fas fa-money-bill-wave"></i>
                            </div>
                            <div>
                                <p class="m-0 font-weight-bold">Offered Salary</p>
                                <p class="m-0 text-secondary"><?php echo salaryRangeFormat($minSalary, $maxSalary) ?></p>
                            </div>
                        </div>

                        <!-- DATE POSTED -->
                        <div class="list-group-item d-flex border-0">
                            <div class="list-group-item-icon h5 text-info">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <div>
                                <p class="m-0 font-weight-bold">Date Posted</p>
                                <p class="m-0 text-secondary"><?php echo $datePosted ?></p>
                            </div>
                        </div>
                        
                        <!-- DATE MDIFIED -->
                        <div class="list-group-item d-flex">
                            <div class="list-group-item-icon h5 text-info">
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

        </div>

    </div>

</div>
</div>

<?php

$this->load->view('sections/components/modal', [
    'id'            => 'deletePostModal',
    'centered'      => TRUE,
    'static'        => TRUE,
    'nofade'        => TRUE,
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