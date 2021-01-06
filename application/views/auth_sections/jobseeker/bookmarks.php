<!-- APPLICANT PROFILE DETAILS SECTION -->
<div class="container-fluid">
<div class="container-md py-5">
    
    <div class="mb-4">
        <h1 class="font-weight-light mb-2">Bookmarks</h1>

        <div class="text-secondary d-sm-flex justify-content-between">
            <p class="m-0">You already saved <strong><?php echo $totalRows ?></strong> bookmark<?php echo $totalRows > 1 ? 's' : '' ?>.</p>
            <?php if ($totalPages > 1) {  ?>
                <p class="m-0">Showing page <?php echo $currentPage ?> of <?php echo $totalPages ?>.</p>
            <?php } ?>
        </div>
    </div>

    <!-- JOB LIST -->
    <div class="row mt-2 mb-5 animate__animated animate__fadeIn animate__faster">
        <?php foreach ( $posts as $post ) { $this->load->view('auth_sections/jobseeker/components/job_post_card', $post); } ?>
    </div>

    <?php echo $this->pagination->create_links(); ?>

</div>
</div>

<script>
    // REMOVE BOOKMARK
    $(document).on('click','#removeBookmarkBtn', function(e) {
        e.preventDefault();
        var bookmarkID = $(this).attr('value');
        $.ajax({
            url:        "<?php echo base_url() ?>auth/remove_bookmark",
            type:       "post",
            dataType:   "json",
            data: {
                bookmarkID: bookmarkID
            },
            success:    function(data) {
                location.reload();
            } 
        });
    });
</script>