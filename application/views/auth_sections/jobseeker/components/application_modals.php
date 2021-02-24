<?php
    if ($this->session->userType === 'Jobseeker') {
        if ($applicationStatus === NULL) {
            if ($resumeData === NULL) {
                $this->load->view('auth_sections/jobseeker/components/sub_components/empty_resume_modal');
            } else {
                $this->load->view('auth_sections/jobseeker/components/sub_components/submit_application_modal', $resumeData);
            }
        } else {
            if ($applicationStatus = 'Pending') {
                $this->load->view('auth_sections/jobseeker/components/sub_components/view_application_modal');
                $this->load->view('sections/components/modal', [
                    'centered'      => TRUE,
                    'nofade'        => TRUE,
                    'id'            => 'cancelApplicationModal',
                    'theme'         => 'warning',
                    'title'         => 'Cancel Application',
                    'modalIcon'     => 'WARNING',
                    'message'       => '
                        <p class="m-1">Are you sure you want to cancel you application for this job?</p>
                        <p class="m-1"><strong>Note: You may apply again if this job is still available.</strong></p>
                    ',
                    'actionPath'    => NULL,
                    'actionID'      => 'cancelApplicationBtn',
                    'actionIcon'    => NULL,
                    'actionLabel'   => 'Continue!',
                ]);
            }
        }
?>

<script>
    $(document).on('click','#cancelApplicationBtn', function(e) {
        $(this).attr("disabled", true);
        $(this).prepend('<span class="spinner-border spinner-border-sm mr-1" role="status" aria-hidden="true"></span>');
        
        e.preventDefault();
        $.ajax({
            url:        "<?php echo base_url() ?>auth/cancel_application",
            type:       "post",
            dataType:   "json",
            data: {
                applicationID: <?php echo isset($applicationID) ? $applicationID : 0 ?>,
            },
            success:    function(data) {
                location.reload();
            }
        });
    });

    $(document).on('click','#addBookmarkBtn', function(e) {
        $(this).attr("disabled", true);
        $(this).prepend('<span class="spinner-border spinner-border-sm mr-1" role="status" aria-hidden="true"></span>');
        
        e.preventDefault();
        $.ajax({
            url:        "<?php echo base_url() ?>auth/add_bookmark",
            type:       "post",
            dataType:   "json",
            data: {
                jobPostID: <?php echo $jobPostID ?>
            },
            success:    function(data) {
                location.reload();
            }
        });
    });

    $(document).on('click','#removeBookmarkBtn', function(e) {
        $(this).attr("disabled", true);
        $(this).prepend('<span class="spinner-border spinner-border-sm mr-1" role="status" aria-hidden="true"></span>');
        
        e.preventDefault();
        $.ajax({
            url:        "<?php echo base_url() ?>auth/remove_bookmark",
            type:       "post",
            dataType:   "json",
            data: {
                bookmarkID: <?php echo isset($bookmarkID) ? $bookmarkID : 0 ?>
            },
            success:    function(data) {
                location.reload();
            } 
        });
    });
</script>

<?php } ?>