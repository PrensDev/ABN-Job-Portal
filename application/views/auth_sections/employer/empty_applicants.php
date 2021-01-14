<?php
    if ($statusPage == 'Pending') {
        $heading = 'No applicants are on pending yet.';
    } else if ($statusPage == 'Hired') {
        $heading = 'No applicants had hired yet.';
    } else if ($statusPage == 'Interviewing') {
        $heading = 'No applicants are on interview yet.';
    } else if ($statusPage == 'Rejected') {
        $heading = 'No applicants have been rejected.';
    }
?>

<div class="container-fluid">
<div class="container py-5">

    <!-- HEADER OF CONTENT -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="mr-3">
            <h1 class="font-weight-normal text-uppercase"><?php echo $jobTitle ?></h1>
            <p class="m-0"><?php echo $heading ?></p>
        </div>
        <div>
            <a href="<?php echo base_url() ?>auth/job_details/<?php echo $jobPostID ?>" class="btn btn-primary text-nowrap" data-toggle="tooltip" data-placement="left" title="About this job">
                <i class="fas fa-exclamation-circle"></i>
                <span class="d-none d-sm-inline">
                    <span>About this job</span>
                </span>
            </a>
        </div>
    </div>

    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a 
                class = "btn nav-link<?php echo $statusPage == 'Pending' ? ' active' : '' ?>" 
                id    = "pendingTab"
            >Pending</a>
        </li>
        <li class="nav-item">
            <a 
                class = "btn nav-link<?php echo $statusPage == 'Interviewing' ? ' active' : '' ?>" 
                id    = "interviewingTab"
            >Interviewing</a>
        </li>
        <li class="nav-item">
            <a 
                class = "btn nav-link<?php echo $statusPage == 'Hired' ? ' active' : '' ?>" 
                id    = "hiredTab"
            >Hired</a>
        </li>
        <li class="nav-item">
            <a 
                class = "btn nav-link<?php echo $statusPage == 'Rejected' ? ' active' : '' ?>" 
                id    = "rejectedTab"
            >Rejected</a>
        </li>
    </ul>

    <div class="text-center my-5 py-5 animate__animated animate__fadeIn animate__faster">
        <h2 class="font-weight-normal"><?php echo $heading ?></h2>
    </div>

    <?php echo $this->pagination->create_links(); ?>

</div>
</div>

<script>
    $('#pendingTab').on('click', function() {
        location.replace('<?php echo base_url() . 'auth/manage_applicants/' . $jobPostID . '/pending' ?>');
    });

    $('#interviewingTab').on('click', function() {
        location.replace('<?php echo base_url() . 'auth/manage_applicants/' . $jobPostID . '/interviewing' ?>');
    });

    $('#hiredTab').on('click', function() {
        location.replace('<?php echo base_url() . 'auth/manage_applicants/' . $jobPostID . '/hired' ?>');
    });

    $('#rejectedTab').on('click', function() {
        location.replace('<?php echo base_url() . 'auth/manage_applicants/' . $jobPostID . '/rejected' ?>');
    });
</script>