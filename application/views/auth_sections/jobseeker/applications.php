<!-- APPLICANT PROFILE DETAILS SECTION -->
<div class="container-fluid bg-light">
<div class="container-md py-5">
    
    <div class="mb-4">
        <h1 class="font-weight-normal mb-2">Applications</h1>

        <div class="text-secondary d-flex justify-content-between">
            <p class="m-0">You already applied to <strong><?php echo $totalRows ?></strong> available job<?php echo $totalRows > 1 ? 's' : '' ?>.</p>
            <?php
                if ($totalPages > 1) {
                    echo '
                        <p class="m-0">Showing page ' . $currentPage . ' of ' . $totalPages . '.</p>
                    ';
                }
            ?>
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
        <?php foreach ( $posts as $post ) { $this->load->view('auth_sections/jobseeker/components/job_post_card', $post); } ?>
    </div>
    <!-- END OF JOB LIST -->

    <?php echo $this->pagination->create_links(); ?>

</div>
</div>