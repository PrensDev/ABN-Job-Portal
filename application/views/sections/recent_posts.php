<!-- RECENT JOB SECTION -->
<div class="container-fluid bg-light">
<div class="container-md py-5">

    <h1 class="display-4 text-center">Recent Available Jobs</h1>
    <p class="h5 font-weight-normal text-center text-secondary">Discover our latest jobs listed here.</p>
    
    <!-- JOB LIST -->
    <div class="row my-5">
        <?php
            foreach ($posts as $post) { $this->load->view('sections/components/job_post_card', $post); }
        ?>
    </div>

    <div class="d-flex justify-content-center">
        <a href="<?php echo base_url() ?>jobs/recent" class="btn btn-primary btn-lg">View More Recent Jobs</a>
    </div>

</div>
</div>