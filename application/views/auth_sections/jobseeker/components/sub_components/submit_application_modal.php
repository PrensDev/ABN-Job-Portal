<div class="modal fade user-select-none" id="submitApplicationModal" tabindex="-1">
<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
<div class="modal-content">

    <div class="modal-header p-0">
        <div class="m-3">
            <div class="mb-3">
                <h3 class="text-uppercase font-weight-normal"><?php echo $jobTitle ?></h3>
                <p class="m-0 text-secondary"><?php echo $companyName . ' - ' . $location ?></p>
                <p class="m-0 text-secondary"><?php echo $jobType ?></p>
            </div>

            <p class="m-0">Please review your resume before submitting:</p>
            
            <?php if ($resumeFlag == 0) { ?>
                <small class="mb-3 text-danger">Your resume is not active and you cannot apply for this job.</span></small>
            <?php } ?>
        </div>
    </div>

    <div class="modal-body">
    <div class="border shadow p-4 my-3">
    
        <!-- BASIC INFORMATION -->
        <div class="mb-5">
            <h4><?php echo $fullName ?></h4>
            <hr class="border-primary">
            <p class="m-0"><?php echo $age . ' years old, ' . $gender ?></p>
            <p class="m-0"><?php echo $cityProvince ?></p>
            <p class="m-0"><?php echo $contactNumber ?></p>
            <p><?php echo $email ?></p>
            <p><?php echo $description ?></p>
        </div>
        
        <!-- SKILLS -->
        <div class="mb-5">
            <h6 class="text-primary">
                <i class="fas fa-cogs mr-1"></i>  
                <span>Skills</span> 
            </h6>
            <hr class="my-2">
            <p><?php echo $skills ?></p>
        </div>

        <!-- EDUCATION -->
        <div class="mb-5">
            <h6 class="text-primary">
                <i class="fas fa-book mr-1"></i>  
                <span>Education</span> 
            </h6>
            <hr class="my-2">
            <p><?php echo $education ?></p>
        </div>
        
        <!-- EXPERIENCES -->
        <div class="mb-5">
            <h6 class="text-primary">
                <i class="fas fa-chart-line mr-1"></i>  
                <span>My Experiences</span> 
            </h6>
            <hr class="my-2">
            <p><?php echo $experiences ?></p>
        </div>
    </div>
    </div>

    <div class="modal-footer">
        <a href="<?php echo base_url() . 'auth/edit_resume/' . $resumeID ?>" target="_blank" class="btn btn-light btn-block border">
            <i class="fas fa-pen mr-1"></i>
            <span>Edit</span>
        </a>

        <button type="button" class="btn text-secondary" data-dismiss="modal">
            <i class="fas fa-times mr-1"></i>
            <span>Cancel</span>
        </button>
        <button 
            type  ="button" 
            class ="btn btn-primary" 
            id    ="submitApplicationBtn"
            <?php echo $resumeFlag == 0 ? 'disabled' : ''?>
        >
            <span>Submit</span>
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