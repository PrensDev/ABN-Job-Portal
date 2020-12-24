<div class="container-fluid bg-light">
<div class="container py-5">

    <!-- HEADER OF CONTENT -->
    <div class="d-flex justify-content-between align-items-center">
        <div class="mr-3">
            <h1 class="font-weight-normal text-uppercase"><?php echo $jobTitle ?></h1>
            <p class="text-secondary m-0">
                <i class="fas fa-users"></i>
                <span><strong><?php echo $totalRows ?></strong> applicant<?php echo $totalRows > 1 ? 's' : '' ?> applied for this job.</span>
            </p>
        </div>
        <div>
            <a href="<?php echo base_url() ?>auth/job_details/<?php echo $jobPostID ?>" class="btn btn-primary text-nowrap" data-toggle="tooltip" data-placement="left" title="About this job">
                <i class="fas fa-exclamation-circle"></i>
                <span class="d-none d-sm-inline">
                    <span>About this job</span>
                </span>
            </a>
        </div>
    </div>
    <!-- END OF HEADER OF CONTENT -->

    <div class="mb-4">
        <hr>
    </div>

    <h5 class="text-primary mb-3">
        <i class="fas fa-users mr-2"></i>  
        <span>Applicants</span> 
    </h5>

    <!-- APPLICANT LIST -->
    <div class="row">
        <?php foreach ( $posts as $post ) { $this->load->view('auth_sections/employer/components/applicant_card', $post); } ?>
    </div>
    <!-- END OF APPLICANT LIST -->

    <?php echo $this->pagination->create_links(); ?>

</div>
</div>


<!-- HIRE APPLICANT MODAL -->
<div class="modal fade user-select-none" id="hireApplicantModal" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content">

    <div class="modal-header align-items-center">
        <h5 class="modal-title text-success">
            <span>Hire an applicant</span>
        </h5>
        <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
            <i class="fas fa-times text-dark"></i>
        </button>
    </div>

    <div class="modal-body">
        <div class="d-flex">
            <div class="display-4 mr-2">
                <i class="fas fa-exclamation-circle text-primary mr-2"></i>
            </div>
            <div id="message"></div>
        </div>
    </div>

    <div class="modal-footer">
        <button class="btn btn-success" id="hireApplicantBtn">Hire now!</button>

        <button type="button" class="btn btn-secondary" data-dismiss="modal">
            <i class="fas fa-times mr-1"></i>
            <span>Cancel</span>
        </button>
    </div>

</div>
</div>
</div>


<!-- HIRE APPLICANT MODAL -->
<div class="modal fade user-select-none" id="hireApplicantModal" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content">

    <div class="modal-header align-items-center">
        <h5 class="modal-title text-success">
            <span>Hire an applicant</span>
        </h5>
        <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
            <i class="fas fa-times text-dark"></i>
        </button>
    </div>

    <div class="modal-body">
        <div class="d-flex">
            <div class="display-4 mr-2">
                <i class="fas fa-exclamation-circle text-primary mr-2"></i>
            </div>
            <div id="message"></div>
        </div>
    </div>

    <div class="modal-footer">
        <button class="btn btn-success" id="hireApplicantBtn">Hire now!</button>

        <button type="button" class="btn btn-secondary" data-dismiss="modal">
            <i class="fas fa-times mr-1"></i>
            <span>Cancel</span>
        </button>
    </div>

</div>
</div>
</div>


<!-- CANCEL HIRING MODAL -->
<div class="modal fade user-select-none" id="cancelHiringModal" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content">

    <div class="modal-header align-items-center">
        <h5 class="modal-title text-warning">
            <span>Cancel hiring</span>
        </h5>
        <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
            <i class="fas fa-times text-dark"></i>
        </button>
    </div>

    <div class="modal-body">
        <div class="d-flex">
            <div class="display-4 mr-2">
                <i class="fas fa-exclamation-triangle text-warning mr-2"></i>
            </div>
            <div id="message"></div>
        </div>
    </div>

    <div class="modal-footer">
        <button class="btn btn-warning" id="cancelHiringBtn">Continue</button>

        <button type="button" class="btn btn-secondary" data-dismiss="modal">
            <i class="fas fa-times mr-1"></i>
            <span>Cancel</span>
        </button>
    </div>

</div>
</div>
</div>


<script>
    $(document).ready(function() {
        $('#hireApplicantModal').on('show.bs.modal', function (e) {
            var btn = $(e.relatedTarget);
            var applicationID = btn.data('applicationid');
            var applicantName = btn.data('applicantname');
            $(this).find('#message').html('Are you sure you want to hire <strong>' + applicantName + '</strong> for <strong><?php echo $jobTitle ?></strong>?');
            $(this).find('#hireApplicantBtn').attr('value', applicationID);
        });

        $('#cancelHiringModal').on('show.bs.modal', function (e) {
            var btn = $(e.relatedTarget);
            var applicationID = btn.data('applicationid');
            var applicantName = btn.data('applicantname');
            $(this).find('#message').html('Are you sure you want to cancel hiring to <strong>' + applicantName + '</strong> for <strong><?php echo $jobTitle ?></strong>?<p><strong></strong></p>');
            $(this).find('#cancelHiringBtn').attr('value', applicationID);
        });
    });

    $(document).on('click','#hireApplicantBtn', function(e) {
        e.preventDefault();
        var applicationID = $(this).attr('value');
        $.ajax({
            url:        "<?php echo base_url() ?>auth/hire_applicant",
            type:       "post",
            dataType:   "json",
            data: {
                applicationID: applicationID
            },
            success:    function(data) {
                location.reload();
            } 
        });
    });

    $(document).on('click','#rejectApplicantBtn', function(e) {
        e.preventDefault();
        var applicationID = $(this).attr('value');
        $.ajax({
            url:        "<?php echo base_url() ?>auth/reject_applicant",
            type:       "post",
            dataType:   "json",
            data: {
                applicationID: applicationID
            },
            success:    function(data) {
                location.reload();
            } 
        });
    });

    $(document).on('click','#cancelHiringBtn', function(e) {
        e.preventDefault();
        var applicationID = $(this).attr('value');
        $.ajax({
            url:        "<?php echo base_url() ?>auth/cancel_hiring",
            type:       "post",
            dataType:   "json",
            data: {
                applicationID: applicationID
            },
            success:    function(data) {
                location.reload();
            } 
        });
    });
</script>