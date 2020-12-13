<!-- APPLICANT PROFILE DETAILS SECTION -->
<div class="container-fluid">
<div class="container-md py-5">
    
    <div class="mb-3">
        <div class="d-flex justify-content-between mb-2">
            <div>
                <h5 class="text-primary">
                    <i class="fas fa-list mr-2"></i>  
                    <span>Available Jobs</span> 
                </h5>
            </div>
            <div>
                <a href="<?php echo base_url() . 'companies/details/' . $employerID ?>" class="btn btn-primary">
                    <i class="fas fa-arrow-left mr-1"></i>
                    <span>Back to details<span>
                </a>
            </div>
        </div>
        
        <div class="text-secondary d-flex justify-content-between">
            <p class="m-0"><strong><?php echo $companyName ?></strong> has <strong><?php echo $totalRows ?></strong> available jobs.</p>
            <?php 
                if ($totalPages > 1) {
                    echo '<p class="m-0">Showing page ' . $currentPage . ' of ' . $totalPages . '.</p>';
                }
            ?>
        </div>
    </div>

    <div class="row mb-5">
        <?php foreach ($posts as $post) { $this->load->view('sections/components/job_post_card', $post); } ?>
    </div>

    <?php echo $this->pagination->create_links(); ?>

</div>
</div>