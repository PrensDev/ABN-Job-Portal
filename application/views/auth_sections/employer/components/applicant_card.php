<?php

$fullName = $firstName . ' ' . $lastName;

if ($status == 'Pending') {
    $statusTheme = 'warning';
} else if ($status == "Hired") {
    $statusTheme = 'success';
} else if ($status == 'Rejected') {
    $statusTheme = 'dark';
}

$dateApplied = date_format(date_create($dateApplied),"M. d, Y");

?>

<div class="col-md-6 col-xl-4 my-3">
<div class="bg-white border p-3 d-flex flex-column justify-content-between h-100">

    <div class="flex-grow-1">
        <div class="d-flex justify-content-center mb-3">
            <?php if (isset($profilePic)) { ?>
                <img 
                    src       = "<?php echo base_url() . 'public/img/jobseekers/' . $profilePic ?>" 
                    alt       = "<?php $fullName ?>" 
                    height    = "125"
                    class     = "rounded-pill" 
                    draggable = "false"
                >
            <?php } else { ?>
                <img 
                    src       = "<?php echo base_url() ?>public/img/jobseekers/blank_dp.png" 
                    alt       = "<?php echo $fullName ?>" 
                    height    = "125"
                    class     = "rounded-pill" 
                    draggable = "false"
                >
            <?php } ?>
        </div>

        <h4 class="font-weight-normal text-center"><?php echo $fullName ?></h4>

        <div class="text-center">
            <small>
                <p class="font-italic text-secondary">Applied <strong><?php echo $dateApplied ?></strong></p>
            </small>
            <span class="badge badge-<?php echo $statusTheme ?> py-1 px-2"><?php echo $status ?></span>
        </div>
        
        <div class="my-3">
            <p class="mb-0"><?php echo $age . ' years old, ' . $gender ?></p>
            <p class="mb-0"><?php echo $cityProvince ?></p>
            <p class="mb-0"><?php echo $contactNumber ?></p>
            <p class="mb-0"><?php echo $email ?></p>
        </div>
    </div>

    <div>
        <a href="" class="btn btn-outline-warning btn-block btn-sm">
            <i class="fas fa-file-contract mr-1"></i>
            <span>View Resume/CV</span>
        </a>
        <a 
            href  = "<?php echo base_url() ?>auth/applicant_profile/<?php echo $jobPostID . '/' . $jobseekerID ?>" 
            class = "btn btn-outline-primary btn-block btn-sm"
        >
            <i class="fas fa-ellipsis-h mr-1"></i>
            <span>View Information</span>
        </a>

        <?php if ($status == 'Pending') { ?>
            <div class="row mt-2">
                <div class="col-4 pr-1">
                    <button 
                        type               = "button"
                        class              = "btn btn-sm btn-block btn-success text-nowrap" 
                        data-toggle        = "modal" 
                        data-target        = "#hireApplicantModal" 
                        data-applicationid = "<?php echo $applicationID ?>"
                        data-applicantname = "<?php echo $fullName ?>"
                    >
                        <div data-toggle="tooltip" title="Hire this applicant">
                            <i class="fas fa-check mr-1"></i>
                        </div>
                    </button>
                </div>
                <div class="col-4 px-1">
                    <button 
                        type               = "button"
                        class              = "btn btn-sm btn-block btn-primary text-nowrap" 
                        data-toggle        = "modal" 
                        data-target        = "#interviewApplicantModal" 
                        data-applicationid = "<?php echo $applicationID ?>"
                        data-applicantname = "<?php echo $fullName ?>"
                    >
                        <div data-toggle="tooltip" title="Call for an interview">
                            <i class="fas fa-phone-alt mr-1"></i>
                        </div>
                    </button>
                </div>
                <div class="col-4 pl-1">
                    <button 
                        type               = "button"
                        class              = "btn btn-sm btn-block btn-danger text-nowrap" 
                        data-toggle        = "modal" 
                        data-target        = "#rejectApplicantModal" 
                        data-applicationid = "<?php echo $applicationID ?>"
                        data-applicantname = "<?php echo $fullName ?>"
                    >
                        <div data-toggle="tooltip" title="Reject this applicant">
                            <i class="fas fa-times mr-1"></i>
                        </div>
                    </button>
                </div>
            </div>
        <?php } else if ($status == 'Hired') { ?>
            <div class="mt-2">
                <button
                    type               = "button" 
                    class              = "btn btn-secondary btn-block btn-sm"
                    data-toggle        = "modal" 
                    data-target        = "#cancelHiringModal" 
                    data-applicationid = "<?php echo $applicationID ?>"
                    data-applicantname = "<?php echo $fullName ?>"
                >Cancel Hiring</button>
            </div>
        <?php } else if ($status == 'Rejected') { ?>
            <div class="mt-2">
                <button
                    type               = "button" 
                    class              = "btn btn-secondary btn-block btn-sm"
                    data-toggle        = "modal" 
                    data-target        = "#cancelRejectModal" 
                    data-applicationid = "<?php echo $applicationID ?>"
                    data-applicantname = "<?php echo $fullName ?>"
                >Cancel Rejecting</button>
            </div>
        <?php } ?>
    </div>
</div>    
</div>