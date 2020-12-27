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

    <!-- JOB LIST -->
    <div class="row mt-2 mb-5">
        <?php foreach ( $posts as $post ) { $this->load->view('auth_sections/jobseeker/components/job_post_card', $post); } ?>
    </div>

    <?php echo $this->pagination->create_links(); ?>

</div>
</div>

<script>
    $(document).on('click','#addBookmarkBtn', function(e) {
        e.preventDefault();
        var jobPostID = $(this).attr('value');
        $.ajax({
            url:        "<?php echo base_url() ?>auth/add_bookmark",
            type:       "post",
            dataType:   "json",
            data: {
                jobPostID: jobPostID
            },
            success:    function(data) {
                location.reload();
            } 
        });
    });

    $(document).on('click','#removeBookmarkBtn', function(e) {
        e.preventDefault();
        var jobPostID = $(this).attr('value');
        $.ajax({
            url:        "<?php echo base_url() ?>auth/remove_bookmark",
            type:       "post",
            dataType:   "json",
            data: {
                jobPostID: jobPostID
            },
            success:    function(data) {
                location.reload();
            } 
        });
    });
</script>