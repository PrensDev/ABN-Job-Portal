<div class="container-fluid bg-light">
<div class="container py-5">

    <!-- HEADER OF CONTENT -->
    <div class="d-flex justify-content-between align-items-center">
        <div class="mr-3">
            <h1 class="font-weight-normal text-uppercase"><?php echo $jobTitle ?></h1>
            <p class="text-secondary m-0">
                <i class="fas fa-users"></i>
                <span><?php echo $totalRows ?> applicant<?php echo $totalRows > 1 ? 's' : '' ?> applied for this job.</span>
            </p>
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
    <!-- END OF HEADER OF CONTENT -->

    <div class="mb-4">
        <hr>
    </div>

    <h5 class="text-primary mb-3">
        <i class="fas fa-users mr-2"></i>  
        <span>Applicants</span> 
    </h5>

    <!-- APPLICANT LIST -->
    <div class="row">
        <?php foreach ( $posts as $post ) { $this->load->view('auth_sections/employer/components/applicant_card', $post); } ?>
    </div>
    <!-- END OF APPLICANT LIST -->

    <?php echo $this->pagination->create_links(); ?>

</div>
</div>