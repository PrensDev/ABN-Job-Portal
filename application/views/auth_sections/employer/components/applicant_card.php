<?php

if ($middleName == NULL) {
    $fullName = $firstName . ' ' . $lastName;
} else {
    $fullName = $firstName . ' ' . $middleName . ' ' . $lastName;
}

$location = $brgyDistrict . ', ' . $cityMunicipality;

?>

<div class="col-md-6 col-lg-4 my-3">
<div class="border bg-white shadow p-3 d-flex flex-column justify-content-between h-100">

    <div class="flex-grow-1">
        <div class="d-flex justify-content-center mb-3">
            <img src="<?php echo base_url() ?>public/img/97.jpg" alt="" class="rounded-pill" draggable="false">
        </div>

        <h4 class="font-weight-normal text-center"><?php echo $fullName ?></h4>

        <p class="font-weight-bold text-center text-info"><?php echo $status ?></p>

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
        <a href="" class="btn btn-warning btn-block btn-sm">
            <i class="fas fa-file-contract"></i>
            <span>View Resume/CV</span>
        </a>
        <a href="<?php echo base_url() ?>auth/applicant_profile/<?php echo $jobPostID . '/' . $jobseekerID ?>" class="btn btn-secondary btn-block btn-sm">
            <i class="fas fa-ellipsis-h"></i>
            <span>View Information</span>
        </a>
    </div>

</div>    
</div>