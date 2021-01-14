<!-- APPLICANT PROFILE DETAILS SECTION -->
<div class="container-fluid">
<div class="container-md py-5">
    
    <div class="mb-4">
        <h1 class="font-weight-light mb-2">Applications</h1>

        <div class="text-secondary d-sm-flex justify-content-between">
            <p class="m-0">
                <?php
                    $s = $totalRows > 1 ? 's' : '';
                    if ($statusPage == 'Pending') {
                        echo '<strong>' . $totalRows . '</strong> application' . $s . ' are on pending.';
                    } else if ($statusPage == 'Hired') {
                        echo 'You are hired for <strong>' . $totalRows . '</strong> job' . $s . '.';
                    } else if ($statusPage == 'Interviewing') {
                        echo 'You have <strong>' . $totalRows . '</strong> job' . $s . ' for interview.';
                    } else if ($statusPage == 'Rejected') {
                        echo '<strong>' . $totalRows . '</strong> application' . $s . ' have been rejected.';
                    }
                ?>
            </p>
            <?php
                if ($totalPages > 1) {
                    echo '
                        <p class="m-0">Showing page ' . $currentPage . ' of ' . $totalPages . '.</p>
                    ';
                }
            ?>
        </div>
    </div>    

    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a 
                class = "btn nav-link<?php echo $statusPage == 'Pending' ? ' active' : '' ?>" 
                id    = "pendingTab"
            >Pending</a>
        </li>
        <li class="nav-item">
            <a 
                class = "btn nav-link<?php echo $statusPage == 'Interviewing' ? ' active' : '' ?>" 
                id    = "interviewingTab"
            >Interviewing</a>
        </li>
        <li class="nav-item">
            <a 
                class = "btn nav-link<?php echo $statusPage == 'Hired' ? ' active' : '' ?>" 
                id    = "hiredTab"
            >Hired</a>
        </li>
        <li class="nav-item">
            <a 
                class = "btn nav-link<?php echo $statusPage == 'Rejected' ? ' active' : '' ?>" 
                id    = "rejectedTab"
            >Rejected</a>
        </li>
    </ul>

    <!-- JOB LIST -->
    <div class="row mt-2 mb-5 animate__animated animate__fadeIn animate__faster">
        <?php foreach ( $posts as $post ) { $this->load->view('auth_sections/jobseeker/components/job_post_card', $post); } ?>
    </div>

    <?php echo $this->pagination->create_links(); ?>

</div>
</div>


<script>
    $('#pendingTab').on('click', function() {
        location.replace('<?php echo base_url() ?>auth/applications/pending');
    });

    $('#interviewingTab').on('click', function() {
        location.replace('<?php echo base_url() ?>auth/applications/interviewing');
    });

    $('#hiredTab').on('click', function() {
        location.replace('<?php echo base_url() ?>auth/applications/hired');
    });

    $('#rejectedTab').on('click', function() {
        location.replace('<?php echo base_url() ?>auth/applications/rejected');
    });    

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