<?php

$fullName       = $this->session->fullName;
$firstName      = $this->session->firstName;
$middleName     = $this->session->middleName;
$lastName       = $this->session->lastName;
$location       = $this->session->location;
$contactNumber  = $this->session->contactNumber;
$email          = $this->session->email;  

?>

<!-- HEADER -->
<div 
    class="container-fluid py-3 parallax-window image-overlay py-5 user-select-none" 
    data-parallax="scroll" 
    data-image-src="<?php echo base_url() ?>/public/img/jobseeker_header.jpg"
>
<div class="container-md text-white">
<div class="row">

    <!-- COMPANY IMAGE/LOGO -->
    <div class="col-md-auto d-flex justify-content-center">
        <img src="assets\97.jpg" alt="" height="125" width="125" class="rounded-pill">
    </div>
    
    <!-- COMPANY INFORMATION -->
    <div class="col-md text-center text-md-left px-0 mt-3 mt-md-0">
        <h1 class="font-weight-light"><?php echo $fullName ?></h1>
        
        <div class="d-block d-md-flex flex-wrap">
            
            <!-- LOCATION -->
            <div class="mr-3">
                <i class="fas fa-map-marker-alt mr-1"></i>
                <span><?php echo $location ?></span>
            </div>

            <!-- PHONE NUMBER -->
            <div class="mr-3">
                <i class="fas fa-phone-alt mr-1"></i>
                <span><?php echo $contactNumber ?></span>
            </div>

            <!-- EMAIL ADDRESS -->
            <div class="mr-3">
                <i class="fas fa-envelope mr-1"></i>
                <span><?php echo $email ?></span>
            </div>

        </div>

        <div class="mt-3">

            <!-- EDIT PROFILE PICTURE -->
            <div class="mr-3">
                <small>
                    <a href="edit_jobseeker_information.html" class="text-light">
                        <i class="fas fa-pen mr-1"></i>
                        <span>Edit my information</span>
                    </a>
                </small>
            </div>

        </div>

        

    </div>
    <!-- END OF COMPANY INFORMATION -->

</div>
</div>
</div>
<!-- END OF HEADER -->