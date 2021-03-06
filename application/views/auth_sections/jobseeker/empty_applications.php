<?php
    if ($statusPage == 'Pending') {
        $heading = 'You don\'t have pending applications.';
    } else if ($statusPage == 'Hired') {
        $heading = 'You don\'t have jobs yet.';
    } else if ($statusPage == 'Interviewing') {
        $heading = 'You don\'t have interviews yet.';
    } else if ($statusPage == 'Rejected') {
        $heading = 'No applications have been rejected.';
    }
?>

<!-- APPLICANT PROFILE DETAILS SECTION -->
<div class="container-fluid">
<div class="container-md py-5">
    
    <div class="mb-4">
        <h1 class="font-weight-light mb-2">Applications</h1>
        <p class="m-0"><?php echo $heading ?></p>
    </div>

    <?php $this->load->view('auth_sections/jobseeker/components/application_status_tabs') ?>

    <div class="text-center my-5 py-5 animate__animated animate__fadeIn animate__faster">
        <h2 class="font-weight-normal"><?php echo $heading ?></h2>
        
        <?php if ($statusPage == 'Pending') { ?>
            <p class="text-secondary">Search our recent posts to get started.</p>
            <div class="mt-5">
                <a href="<?php echo base_url() ?>jobs" class="btn btn-primary">
                    <span>Browse for Available Jobs</span>
                </a>
            </div>
        <?php } ?>
    </div>

</div>
</div>

<script>
    $('#pendingTab').on('click', function() {
        location.replace('<?php echo base_url() ?>auth/applications/pending');
    });

    $('#interviewingTab').on('click', function() {
        location.replace('<?php echo base_url() ?>auth/applications/interviewing');
    });

    $('#hiredTab').on('click', function() {
        location.replace('<?php echo base_url() ?>auth/applications/hired');
    });

    $('#rejectedTab').on('click', function() {
        location.replace('<?php echo base_url() ?>auth/applications/rejected');
    });
</script>