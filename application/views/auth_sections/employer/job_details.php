<?php
    if ( $jobPostFlag == 1 ) {
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
            <?php if ($applicantsNum > 0) { ?>
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
                            <span>Manage all applicants</span>
                        </span>
                    </div>
                    <span class="badge badge-light"><?php echo $applicantsNum ?></span>
                </a>
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
            
            <!-- NUMBER OF PENDING APPLICANTS -->
            <?php if ($pendingApplicantsNum > 0) { ?>
                <div class="d-flex justify-content-between alert alert-warning p-3 mb-3">
                    <div class="mr-3">
                        <i class="fas fa-users mr-1 text-warning"></i>
                        <span>There are <strong><?php echo $pendingApplicantsNum ?></strong> pending applications.</span>
                    </div>
                    <div>
                        <a class="text-nowrap text-warning" href="<?php echo base_url() . 'auth/manage_applicants/' . $jobPostID . '/pending' ?>">View All</a>
                    </div>
                </div>
            <?php } ?>

            <!-- NUMBER OF HIRED APPLICANTS -->
            <?php if ($hiredApplicantsNum > 0) { ?>
                <div class="d-flex justify-content-between alert alert-success p-3 mb-3">
                    <div class="mr-3">
                        <i class="fas fa-users mr-1 text-success"></i>
                        <span>You've already hired <strong><?php echo $hiredApplicantsNum ?></strong> people.</span>
                    </div>
                    <div>
                        <a class="text-nowrap text-success" href="<?php echo base_url() . 'auth/manage_applicants/' . $jobPostID . '/hired' ?>">View All</a>
                    </div>
                </div>
            <?php } ?>

            <!-- EMPLOYER CONTROLS -->
            <div class="mb-3">
                <a 
                    href="<?php echo base_url() ?>auth/edit_post/<?php echo $jobPostID ?>" 
                    class="btn btn-block btn-info"
                    draggable="false"
                >
                    <i class="fas fa-pen mr-2"></i>
                    <span>Edit This Post</span>
                </a>

                <?php if ($applicantsNum == 0 && $jobPostFlag == 0) { ?>
                    <button class="btn btn-block btn-danger" data-toggle="modal" data-target="#deletePostModal">
                        <i class="fas fa-trash mr-2"></i>
                        <span>Delete This Post</span>
                    </button>
                <?php } ?>
            </div>

            <?php
                $jobType = '
                    <p class="m-0">
                        <span 
                            class="
                                badge 
                                border 
                                border-' . $jobTypeClass . ' 
                                text-' . $jobTypeClass . ' 
                                text-uppercase 
                                p-2
                            "
                        >
                            <i class="fas fa-user-tie mr-1"></i>
                            <span>' . $jobType . '</span>
                        </span>
                    </p>
                ';

                $this->load->view('sections/components/info_card', [
                    'title'        => 'Job Summary',
                    'theme'        => 'info',
                    'infoID'       => 'jobSummary',
                    'infoElements' => [
                        [
                            'icon'          => 'user-tie',
                            'element'       => 'Job Type',
                            'customContent' => true,
                            'content'       => $jobType,
                        ],
                        [
                            'icon'          => 'cogs',
                            'element'       => 'Field',
                            'content'       => $field,
                        ],
                        [
                            'icon'          => 'money-bill-wave',
                            'element'       => 'Offered Salary',
                            'content'       => salaryRangeFormat($minSalary, $maxSalary),
                        ],
                        [
                            'icon'          => 'calendar-alt',
                            'element'       => 'Date Posted',
                            'content'       => $datePosted,
                        ],
                        [
                            'icon'          => 'pen',
                            'element'       => 'Last Modified',
                            'content'       => $dateModifiedLabel,
                        ],
                    ],
                ]); 
            ?>

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
        'actionPath'    => NULL,
        'actionID'      => 'deletePost',
        'actionValue'   => $jobPostID,
        'actionIcon'    => 'trash',
        'actionLabel'   => 'Delete',
    ]);
?>

<script>
    $(document).on('click','#deletePost', function(e) {
        $(this).attr("disabled", true);
        $(this).prepend('<span class="spinner-border spinner-border-sm mr-1" role="status" aria-hidden="true"></span>');
        
        e.preventDefault();
        var jobPostID = $(this).attr('value');
        $.ajax({
            url:        "<?php echo base_url() ?>auth/delete_post",
            type:       "post",
            data: {
                jobPostID: jobPostID
            },
            success:    function(data) {
                location.replace('<?php echo base_url() ?>auth/job_posts');
            },
            failed:    function(data) {
                alert('Something error happened')
            } 
        });
    });
</script>