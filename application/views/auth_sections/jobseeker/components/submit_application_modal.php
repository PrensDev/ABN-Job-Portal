<div class="modal fade user-select-none" id="submitApplicationModal" tabindex="-1">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">

    <div class="modal-body">
        <div class="mb-3">
            <h3 class="text-uppercase font-weight-normal"><?php echo $jobTitle ?></h3>
            <p class="m-0 text-secondary"><?php echo $companyName . ' - ' . $location ?></p>
            <p class="m-0 text-secondary"><?php echo $jobType ?></p>
        </div>

        <p class="m-0">Please review your resume before submitting:</p>
        
        <?php
            if ($status == 0) {
                echo '
                    <small class="mb-3 text-danger">Your resume is not active and you cannot apply for this job.</span></small>
                ';
            }
        ?>
        
        <div class="border shadow p-4 my-3">
            <h4><?php echo $fullName ?></h4>
            <hr class="border-primary">
            <p class="m-0"><?php echo $age . ' years old, ' . $gender ?></p>
            <p class="m-0"><?php echo $cityProvince ?></p>
            <p class="m-0"><?php echo $contactNumber ?></p>
            <p><?php echo $email ?></p>
            <p class="text-nowrap text-truncate"><?php echo $description ?></p>
        </div>
        
        <a href="<?php echo base_url() . 'auth/edit_resume/' . $resumeID ?>" target="_blank" class="btn btn-light btn-block">
            <i class="fas fa-pen mr-1"></i>
            <span>Edit</span>
        </a>
    </div>

    <div class="modal-footer">
        <button 
            type  ="button" 
            class ="btn btn-primary" 
            id    ="submitApplicationBtn"
            <?php echo $status == 0 ? 'disabled' : ''?>
        >
            <span>Submit</span>
        </button>

        <button type="button" class="btn btn-secondary" data-dismiss="modal">
            <i class="fas fa-times mr-1"></i>
            <span>Cancel</span>
        </button>
    </div>

</div>
</div>
</div>

<script>
    $(document).on('click','#submitApplicationBtn', function(e) {
        e.preventDefault();
        $.ajax({
            url:        "<?php echo base_url() ?>auth/submit_application",
            type:       "post",
            dataType:   "json",
            data: {
                jobPostID: <?php echo $jobPostID ?>,
                resumeID: <?php echo $resumeID ?>
            },
            success:    function(data) {
                location.reload();
            }
        });
    });
</script>