<!-- APPLICANT PROFILE DETAILS SECTION -->
<div class="container-fluid">
<div class="container-md py-5">
    
    <div class="mb-4">
        <div class="d-flex justify-content-between">
            <div>
                <h1 class="font-weight-normal mb-2">Job Posts</h1>
            </div>
            <div>
                <a href="<?php echo base_url() ?>auth/post_new_job" class="btn btn-primary" data-toggle="tooltip" data-placement="left" title="Post new job">
                    <i class="fas fa-pen"></i>
                    <span class="d-none d-sm-inline">Post new job</span>
                </a>
            </div>
        </div>

        <div class="text-secondary d-flex justify-content-between">
            <p class="m-0">You already have <strong><?php echo $totalRows ?></strong> posts.</p>
            <p class="m-0">Showing page <?php echo $currentPage ?> of <?php echo $totalPages ?>.</p>
        </div>
    </div>        
<!-- 
    <div class="alert alert-success alert-dismissible fade show my-2 mb-4" role="alert">
        <span>New job has successfully been <strong>added</strong>.</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> -->


    <!-- JOB LIST -->
    <div class="row mt-2 mb-5">
        <?php foreach ( $posts as $post ) { $this->load->view('auth_sections/employer/components/job_post_card', $post); } ?>
    </div>
    <!-- END OF JOB LIST -->

    <?php echo $this->pagination->create_links(); ?>

</div>
</div>