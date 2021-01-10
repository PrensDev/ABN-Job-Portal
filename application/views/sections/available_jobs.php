
<!-- APPLICANT PROFILE DETAILS SECTION -->
<div class="container-fluid">
<div class="container-md py-5">

    <?php $this->load->view('sections/company_header', $employerDetails) ?>

    <div class="mb-4">
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
                    <span class="d-none d-sm-inline">Back to details<span>
                </a>
            </div>
        </div>
        
        <div class="text-secondary d-flex justify-content-between">
            <p class="m-0"><strong><?php echo $companyName ?></strong> has <strong><?php echo $totalRows ?></strong> available job<?php echo $totalRows > 1 ? 's' : '' ?>.</p>
            <?php 
                if ($totalPages > 1) {
                    echo '<p class="m-0">Showing page ' . $currentPage . ' of ' . $totalPages . '.</p>';
                }
            ?>
        </div>
    </div>

    <div class="row mb-5 animate__animated animate__fadeIn animate__faster">
        <?php
            if ($this->session->userType == 'Job Seeker') {
                foreach ($posts as $post) { $this->load->view('auth_sections/jobseeker/components/job_post_card', $post); } 
            } else {
                foreach ($posts as $post) { $this->load->view('sections/components/job_post_card', $post); } 
            }
        ?>
    </div>

    <?php echo $this->pagination->create_links(); ?>

</div>
</div>

<?php if ($this->session->userTye == 'Job Seeker') { ?>
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