<!-- APPLICANT PROFILE DETAILS SECTION -->
<div class="container-fluid">
<div class="container-md py-5">
    
    <!-- HEADER CONTENT -->
    <div class="mb-4">
        <div class="d-flex justify-content-between">
            <div>
                <h1 class="font-weight-light mb-2">Job Posts</h1>
            </div>
            <div>
                <a href="<?php echo base_url() ?>auth/post_new_job" class="btn btn-success" data-toggle="tooltip" data-placement="left" title="Post new job">
                    <i class="fas fa-plus"></i>
                    <span class="d-none d-sm-inline">Post new job</span>
                </a>
            </div>
        </div>

        <div class="text-secondary d-sm-flex justify-content-between">
            <p class="m-0">You already have <strong><?php echo $totalRows ?></strong> post<?php echo $totalRows > 1 ? 's' : '' ?>.</p>
            <?php
                if ($totalPages > 1) {
                    echo '
                        <p class="m-0">Showing page ' . $currentPage . ' of ' . $totalPages . '.</p>
                    ';
                }
            ?>
        </div>
    </div>    

    <?php $this->load->view('auth_sections/components/alert') ?>

    <!-- JOB LIST -->
    <div class="row mt-2 mb-5 animate__animated animate__fadeIn animate__faster">
        <?php foreach ( $posts as $post ) { $this->load->view('auth_sections/employer/components/job_post_card', $post); } ?>
    </div>

    <!-- PAGINATION -->
    <?php echo $this->pagination->create_links(); ?>

</div>
</div>