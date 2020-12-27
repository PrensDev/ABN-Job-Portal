<?php

if ($middleName == NULL) {
    $fullName = $firstName . ' ' . $lastName;
} else {
    $fullName = $firstName . ' ' . $middleName . ' ' . $lastName;
}

$location = $brgyDistrict . ', ' . $cityMunicipality;

if ($status == 'Pending') {
    $statusTheme = 'success';
} else if ($status == "Hired") {
    $statusTheme = 'primary';
} else if ($status == 'Rejected') {
    $statusTheme = 'danger';
}

$dateApplied = date_format(date_create($dateApplied),"M. d, Y \a\\t h:i a");

?>

<div class="col-md-6 col-xl-4 my-3">
<div class="bg-white shadow p-3 d-flex flex-column justify-content-between h-100">

    <div class="flex-grow-1">
        <div class="d-flex justify-content-center mb-3">
            <?php
                if (isset($profilePic)) {
                    echo '
                        <img 
                            src         = "' . base_url() . 'public/img/jobseekers/' . $profilePic .'" 
                            alt         = "' . $fullName . '" 
                            height      = "125"
                            class       = "rounded-pill" 
                            draggable   = "false"
                        >
                    ';
                } else {
                    echo '
                        <img 
                            src         = "' . base_url() . 'public/img/jobseekers/blank_dp.png" 
                            alt         = "' . $fullName . '" 
                            height      = "125"
                            class       = "rounded-pill" 
                            draggable   = "false"
                        >
                    ';
                }
            ?>
            
        </div>

        <h4 class="font-weight-normal text-center"><?php echo $fullName ?></h4>

        <div class="text-center">
            <small>
                <p class="font-italic text-secondary">Applied <?php echo $dateApplied ?></p>
            </small>
            <span class="badge badge-<?php echo $statusTheme ?> py-1 px-2"><?php echo $status ?></span>
        </div>

        <div class="list-group list-group-flush">

            <div class="list-group-item d-flex">
                <div class="list-group-item-icon h5 text-danger">
                    <i class="fas fa-user-tie"></i>
                </div>
                <div>
                    <p class="m-0 font-weight-bold">Gender</p>
                    <p class="m-0 text-secondary"><?php echo $gender ?></p>
                </div>
            </div>

            <div class="list-group-item d-flex">
                <div class="list-group-item-icon h5 text-danger">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div>
                    <p class="m-0 font-weight-bold">Location</p>
                    <p class="m-0 text-secondary"><?php echo $location ?></p>
                </div>
            </div>

            <div class="list-group-item d-flex">
                <div class="list-group-item-icon h5 text-danger">
                    <i class="fas fa-envelope"></i>
                </div>
                <div>
                    <p class="m-0 font-weight-bold">Email</p>
                    <p class="m-0 text-secondary"><?php echo $email ?></p>
                </div>
            </div>
        </div>
    </div>

    <div>
        <a href="" class="btn btn-outline-warning btn-block btn-sm">
            <i class="fas fa-file-contract mr-1"></i>
            <span>View Resume/CV</span>
        </a>
        <a href="<?php echo base_url() ?>auth/applicant_profile/<?php echo $jobPostID . '/' . $jobseekerID ?>" class="btn btn-outline-primary btn-block btn-sm">
            <i class="fas fa-ellipsis-h mr-1"></i>
            <span>View Information</span>
        </a>

        <?php
            if ($status == 'Pending') {
                echo '
                    <div class="row mt-2">
                        <div class="col-6 pr-1">
                            <button 
                                type               = "button"
                                class              = "btn btn-sm btn-block btn-success text-nowrap" 
                                data-toggle        = "modal" 
                                data-target        = "#hireApplicantModal" 
                                data-applicationid = "' . $applicationID . '"
                                data-applicantname = "' . $fullName . '"
                            >
                                <i class="fas fa-check mr-1"></i>
                                <span>Hire</span>
                            </button>
                        </div>
                        <div class="col-6 pl-1">
                            <button 
                                type="button"
                                class="btn btn-sm btn-block btn-danger text-nowrap" 
                                data-toggle        = "modal" 
                                data-target        = "#rejectApplicantModal" 
                                data-applicationid = "' . $applicationID . '"
                                data-applicantname = "' . $fullName . '"
                            >
                                <i class="fas fa-times mr-1"></i>
                                <span>Reject</span>
                            </button>
                        </div>
                    </div>
                ';
            } else if ($status == 'Hired') {
                echo '
                    <div class="mt-2">
                        <button
                            type="button" 
                            class="btn btn-secondary btn-block btn-sm"
                            data-toggle        = "modal" 
                            data-target        = "#cancelHiringModal" 
                            data-applicationid = "' . $applicationID . '"
                            data-applicantname = "' . $fullName . '"
                        >Cancel Hiring</button>
                    </div>
                ';
            } else if ($status == 'Rejected') {
                echo '
                    <div class="mt-2">
                        <button
                            type="button" 
                            class="btn btn-secondary btn-block btn-sm"
                            data-toggle        = "modal" 
                            data-target        = "#cancelRejectModal" 
                            data-applicationid = "' . $applicationID . '"
                            data-applicantname = "' . $fullName . '"
                        >Cancel Rejecting</button>
                    </div>
                ';
            }
        ?>
    </div>

</div>    
</div>