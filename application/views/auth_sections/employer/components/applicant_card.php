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
                    src            = "<?php echo base_url() . 'public/img/jobseekers/' . $profilePic ?>" 
                    alt            = "<?php $fullName ?>" 
                    height         = "125"
                    class          = "rounded-pill border" 
                    draggable      = "false"
                    data-toggle    = "tooltip"
                    data-placement = "bottom"
                    title          = "Applicant's profile picture."
                >
            <?php } else { ?>
                <img 
                    src            = "<?php echo base_url() ?>public/img/jobseekers/blank_dp.png" 
                    alt            = "<?php echo $fullName ?>" 
                    height         = "125"
                    class          = "rounded-pill border" 
                    draggable      = "false"
                    data-toggle    = "tooltip"
                    data-placement = "bottom"
                    title          = "This applicant doesn't have profile picture."
                >
            <?php } ?>
        </div>

        <h4 
            class           = "font-weight-normal text-center"
            data-toggle     = "tooltip"
            data-placement  = "top"
            title           = "Applicant's name"
        ><?php echo $fullName ?></h4>

        <div class="text-center">
            <p class="font-italic text-secondary">
                <small>
                    <span
                        data-toggle    = "tooltip"
                        data-placement = "top"
                        title          = "Applied <?php echo $dateApplied ?>"
                    >
                        Applied <strong><?php echo $dateApplied ?></strong>
                    </span>
                </small>
            </p>
            <span 
                class          = "badge badge-<?php echo $statusTheme ?> py-1 px-2"
                data-toggle    = "tooltip"
                data-placement = "top"
                title          = "Application is <?php echo $status ?>"
            >
                <?php echo $status ?>
            </span>
        </div>
        
        <div class="my-3">
            <p class="mb-0">
                <span 
                    data-toggle     = "tooltip"
                    data-placement  = "top"
                    title           = "Applicant's Age"
                ><?php echo $age . ' years old'?></span>
                <span>,</span>
                <span 
                    data-toggle     = "tooltip"
                    data-placement  = "top"
                    title           = "Applicant's Gender"
                ><?php echo $gender ?></span>
            </p>
            <p class="mb-0">
                <span 
                    data-toggle     = "tooltip"
                    data-placement  = "right"
                    title           = "Applicant's Location"
                >
                    <?php echo $cityProvince ?>
                </span>
            </p>
            <p class="mb-0">
                <span 
                    data-toggle     = "tooltip"
                    data-placement  = "right"
                    title           = "Applicant's Contact number"
                >
                    <?php echo $contactNumber ?>
                </span>
            </p>
            <p class="mb-0">
                <span 
                    data-toggle     = "tooltip"
                    data-placement  = "right"
                    title           = "Applicant's Email"
                >
                    <?php echo $email ?>
                </p>
        </div>
    </div>

    <div>
        <a 
            href  = "<?php echo base_url() ?>auth/applicant_profile/<?php echo $jobPostID . '/' . $jobseekerID ?>" 
            class = "btn btn-outline-primary btn-block btn-sm"
        >
            <i class="fas fa-ellipsis-h mr-1"></i>
            <span>View Information</span>
        </a>

        <?php if ($status == 'Pending') { ?>
            <div class="row mt-2">
                <div class="col-6 pr-1">
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
                <div class="col-6 pl-1">
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