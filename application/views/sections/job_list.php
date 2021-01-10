<!-- JOB LIST SECTION -->
<div class="container-fluid py-5">
<div class="container-md">

    <h1 class="font-weight-light"><?php echo $bodyTitle ?></h1>
    <p class="text-secondary"><?php echo $bodySubtitle ?></p>

    <div class="d-flex justify-content-between">
        <p><?php echo $totalRows ?> match found.</p>
        <?php 
            if ($totalPages > 1) {
                echo '<p>Showing page ' . $currentPage . ' of ' . $totalPages . '.</p>';
            }
        ?>
    </div>

    <div class="row mb-5 animate__animated animate__fadeIn animate__faster">
        <?php foreach ($posts as $post) { $this->load->view('sections/components/job_post_card', $post); } ?>
    </div>

    <?php echo $this->pagination->create_links(); ?>

</div>
</div>

<?php if ($this->session->userType == 'Job Seeker') { ?>
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
<?php } ?>