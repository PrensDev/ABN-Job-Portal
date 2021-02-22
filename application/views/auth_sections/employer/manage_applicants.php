<div class="container-fluid">
<div class="container py-5">

    <!-- HEADER OF CONTENT -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="mr-3">
            <h1 class="font-weight-normal text-uppercase"><?php echo $jobTitle ?></h1>
            <p class="text-secondary m-0">
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

    <?php $this->load->view('auth_sections/employer/components/application_status_tabs') ?>

    <!-- APPLICANT LIST -->
    <div class="row animate__animated animate__fadeIn animate__faster">
        <?php foreach ( $applicants as $applicant ) { $this->load->view('auth_sections/employer/components/applicant_card', $applicant); } ?>
    </div>

    <?php echo $this->pagination->create_links(); ?>

</div>
</div>



<!-- HIRE APPLICANT MODAL -->
<div class="modal user-select-none" id="hireApplicantModal" tabindex="-1">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">

    <div class="modal-header align-items-center">
        <h5 class="modal-title text-success">
            <span>Hire an applicant</span>
        </h5>
        <button type="button" class="btn text-secondary" data-dismiss="modal" aria-label="Close">
            <i class="fas fa-times"></i>
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
        <button type="button" class="btn text-secondary" data-dismiss="modal">
            <i class="fas fa-times mr-1"></i>
            <span>Cancel</span>
        </button>
        <button class="btn btn-success" id="hireApplicantBtn">Hire now!</button>
    </div>

</div>
</div>
</div>


<!-- INTERVIEW APPLICANT MODAL -->
<div class="modal user-select-none" id="interviewApplicantModal" tabindex="-1">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">

    <div class="modal-header align-items-center">
        <h5 class="modal-title text-primary">
            <span>Call for an interview</span>
        </h5>
        <button type="button" class="btn text-secondary" data-dismiss="modal" aria-label="Close">
            <i class="fas fa-times"></i>
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
        <button type="button" class="btn text-secondary" data-dismiss="modal">
            <i class="fas fa-times mr-1"></i>
            <span>Cancel</span>
        </button>
        <button class="btn btn-primary" id="interviewApplicantBtn">Continue</button>
    </div>

</div>
</div>
</div>


<!-- REJECT APPLICANT MODAL -->
<div class="modal user-select-none" id="rejectApplicantModal" tabindex="-1">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">

    <div class="modal-header align-items-center">
        <h5 class="modal-title text-danger">
            <span>Reject an applicant</span>
        </h5>
        <button type="button" class="btn text-secondary" data-dismiss="modal" aria-label="Close">
            <i class="fas fa-times"></i>
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
        <button type="button" class="btn text-secondary" data-dismiss="modal">
            <i class="fas fa-times mr-1"></i>
            <span>Cancel</span>
        </button>
        <button class="btn btn-danger" id="rejectApplicantBtn">Reject</button>
    </div>

</div>
</div>
</div>


<!-- CANCEL HIRING MODAL -->
<div class="modal user-select-none" id="cancelHiringModal" tabindex="-1">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">

    <div class="modal-header align-items-center">
        <h5 class="modal-title text-warning">
            <span>Cancel hiring</span>
        </h5>
        <button type="button" class="btn text-secondary" data-dismiss="modal" aria-label="Close">
            <i class="fas fa-times"></i>
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
        <button type="button" class="btn text-secondary" data-dismiss="modal">
            <i class="fas fa-times mr-1"></i>
            <span>Cancel</span>
        </button>
        <button class="btn btn-warning" id="cancelHiringBtn">Continue</button>
    </div>

</div>
</div>
</div>


<!-- CANCEL REJECTING MODAL -->
<div class="modal user-select-none" id="cancelRejectModal" tabindex="-1">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">

    <div class="modal-header align-items-center">
        <h5 class="modal-title text-warning">
            <span>Cancel rejecting</span>
        </h5>
        <button type="button" class="btn text-secondary" data-dismiss="modal" aria-label="Close">
            <i class="fas fa-times"></i>
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
        <button type="button" class="btn text-secondary" data-dismiss="modal">
            <i class="fas fa-times mr-1"></i>
            <span>Cancel</span>
        </button>
        <button class="btn btn-warning" id="cancelRejectingBtn">Continue</button>
    </div>

</div>
</div>
</div>


<script>
    $('#pendingTab').on('click', function() {
        location.replace('<?php echo base_url() . 'auth/manage_applicants/' . $jobPostID . '/pending' ?>');
    });

    $('#hiredTab').on('click', function() {
        location.replace('<?php echo base_url() . 'auth/manage_applicants/' . $jobPostID . '/hired' ?>');
    });

    $('#rejectedTab').on('click', function() {
        location.replace('<?php echo base_url() . 'auth/manage_applicants/' . $jobPostID . '/rejected' ?>');
    });

    $(document).ready(function() {
        $('#hireApplicantModal').on('show.bs.modal', function (e) {
            var btn = $(e.relatedTarget);
            var applicationID = btn.data('applicationid');
            var applicantName = btn.data('applicantname');
            $(this).find('#message').html('Are you sure you want to hire <strong>' + applicantName + '</strong> for <strong><?php echo $jobTitle ?></strong>?');
            $(this).find('#hireApplicantBtn').attr('value', applicationID);
        });

        $('#rejectApplicantModal').on('show.bs.modal', function (e) {
            var btn = $(e.relatedTarget);
            var applicationID = btn.data('applicationid');
            var applicantName = btn.data('applicantname');
            $(this).find('#message').html('Are you sure you want to reject <strong>' + applicantName + '</strong> for <strong><?php echo $jobTitle ?></strong>?');
            $(this).find('#rejectApplicantBtn').attr('value', applicationID);
        });

        $('#cancelHiringModal').on('show.bs.modal', function (e) {
            var btn = $(e.relatedTarget);
            var applicationID = btn.data('applicationid');
            var applicantName = btn.data('applicantname');
            $(this).find('#message').html('Are you sure you want to cancel hiring to <strong>' + applicantName + '</strong> for <strong><?php echo $jobTitle ?></strong>?<p><strong></strong></p>');
            $(this).find('#cancelHiringBtn').attr('value', applicationID);
        });

        $('#cancelRejectModal').on('show.bs.modal', function (e) {
            var btn = $(e.relatedTarget);
            var applicationID = btn.data('applicationid');
            var applicantName = btn.data('applicantname');
            $(this).find('#message').html('Are you sure you want to cancel rejecting to <strong>' + applicantName + '</strong> for <strong><?php echo $jobTitle ?></strong>?<p><strong></strong></p>');
            $(this).find('#cancelRejectingBtn').attr('value', applicationID);
        });
    });

    // HIRE APPLICANT
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

    // REJECT APPLICANT
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

    // CANCEL HIRING
    $(document).on('click','#cancelHiringBtn', function(e) {
        e.preventDefault();
        var applicationID = $(this).attr('value');
        $.ajax({
            url:        "<?php echo base_url() ?>auth/cancel_hiring_rejecting",
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

    // CANCEL REJECTING
    $(document).on('click','#cancelRejectingBtn', function(e) {
        e.preventDefault();
        var applicationID = $(this).attr('value');
        $.ajax({
            url:        "<?php echo base_url() ?>auth/cancel_hiring_rejecting",
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