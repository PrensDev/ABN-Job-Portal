<?php

if ($middleName == NULL) {
    $fullName = $firstName . ' ' . $lastName;
} else {
    $fullName = $firstName . ' ' . $middleName . ' ' . $lastName;
}

$location = $street . ', ' . $brgyDistrict . ', ' . $cityMunicipality;

?>

<div class="container-fluid py-5">
<div class="container-md">
    
    <div class="row mb-4">
        <div class="col-md-auto d-flex justify-content-center">
            <img src="assets\97.jpg" height="125" width="125" class="rounded-pill">
        </div>
        
        <div class="col-md text-center text-md-left px-0 mt-3 mt-md-0">
            <h1 class="font-weight-normal"><?php echo $fullName ?></h1>
            
            <div class="d-block d-md-flex flex-wrap">
                
                <!-- LOCATION -->
                <div class="mr-3">
                    <i class="fas fa-map-marker-alt mr-1 text-danger"></i>
                    <span class=" text-secondary"><?php echo $location ?></span>
                </div>

                <!-- PHONE NUMBER -->
                <div class="mr-3">
                    <i class="fas fa-phone-alt mr-1 text-danger"></i>
                    <span class=" text-secondary"><?php echo $contactNumber ?></span>
                </div>

                <!-- EMAIL ADDRESS -->
                <div class="mr-3">
                    <i class="fas fa-envelope mr-1 text-danger"></i>
                    <span class=" text-secondary"><?php echo $email ?></span>
                </div>

            </div>
        </div>
    </div>

    <div class="mb-4"><hr></div>

    <!-- APPLIED JOB INFORMATION -->
    <div class="container-fluid border border-primary mb-4 p-2">
        <div class="row align-items-center">
            <div class="col-md-8 text-md-left text-center">
                <div class="m-1">
                    <strong><?php echo $fullName ?></strong> is applying for <a href="<?php echo base_url() ?>auth/job_details/<?php echo $jobPostID ?>"><?php echo $jobTitle ?></a>. 
                </div>
            </div>
            <div class="col-md-4 text-md-right text-center mt-2 mt-md-0">
                <button type="submit" class="btn btn-success m-1 text-nowrap">Hire Now!</button>
                <button type="submit" class="btn btn-danger m-1 text-nowrap">Reject</button>
            </div> 
        </div> 
    </div>
    <!-- END OF APPLIED JOB INFORMATION -->

    <div class="row">
        
        <!-- APPLICANT INFORMATION -->
        <div class="col-lg-8">
            <div class="mb-3 mb-lg-0">

                <div class="mb-5">
                    <h5 class="text-primary mb-3">
                        <i class="fas fa-book-reader mr-2"></i>  
                        <span>About Me</span> 
                    </h5>
                    <p class="text-justify"><?php echo $description ?></p>
                </div>
                
                <div class="mb-5">
                    <h5 class="text-primary mb-3">
                        <i class="fas fa-chart-line mr-2"></i>  
                        <span>My Experiences</span> 
                    </h5>
                    <p class="text-justify"><?php echo $experiences ?></p>
                </div>

                <div class="mb-5">
                    <h5 class="text-primary mb-3">
                        <i class="fas fa-cogs mr-2"></i>  
                        <span>My Skills</span> 
                    </h5>
                    <p class="text-justify"><?php echo $skills ?></p>
                </div>
                
                <div class="mb-5">
                    <h5 class="text-primary mb-3">
                        <i class="fas fa-book-reader mr-2"></i>  
                        <span>My Education</span> 
                    </h5>
                    <p class="text-justify"><?php echo $education ?></p>
                </div>

            </div>
        </div>
        <!-- END OF APPLICANT INFORMATION -->


        <!-- APPLICANT INFORMATION SUMMARY -->
        <div class="col-lg-4">
            
            <!-- GENERAL INFORMATION CARD -->
            <div class="card mb-3">
                <div class="card-header">
                    <strong>
                        <i class="fas fa-user-circle mr-2"></i>
                        <span>Personal Information</span>    
                    </strong>
                </div>
                <div class="card-body p-0">
                    
                    <div class="list-group list-group-flush">

                        <div class="list-group-item d-flex">
                            <div class="list-group-item-icon h4 text-info">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <div>
                                <p class="m-0 font-weight-bold">Gender</p>
                                <p class="m-0 text-secondary"><?php echo $gender ?></p>
                            </div>
                        </div>

                        <div class="list-group-item d-flex">
                            <div class="list-group-item-icon h4 text-info">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div>
                                <p class="m-0 font-weight-bold">Age</p>
                                <p class="m-0 text-secondary"><?php echo $age ?></p>
                            </div>
                        </div>

                        <div class="list-group-item d-flex">
                            <div class="list-group-item-icon h4 text-info">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <p class="m-0 font-weight-bold">Location</p>
                                <p class="m-0 text-secondary"><?php echo $location ?></p>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
            <!-- END OF GENERAL INFORMATION CARD -->

            <!-- CONTACT INFORMATION CARD -->
            <div class="card mb-3">
                <div class="card-header">
                    <strong>
                        <i class="fas fa-phone-square-alt mr-2"></i>
                        <span>Contact Information</span>    
                    </strong>
                </div>
                <div class="card-body p-0">
                    
                    <div class="list-group list-group-flush">

                        <div class="list-group-item d-flex">
                            <div class="list-group-item-icon h4 text-danger">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div>
                                <p class="m-0 font-weight-bold">Contact Number</p>
                                <p class="m-0 text-secondary"><?php echo $contactNumber ?></p>
                            </div>
                        </div>

                        <div class="list-group-item d-flex">
                            <div class="list-group-item-icon h4 text-danger">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div>
                                <p class="m-0 font-weight-bold">Email</p>
                                <p class="m-0 text-secondary"><?php echo $email ?></p>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
            
            <div>
                <button class="btn btn-warning btn-block" data-toggle="modal" data-target="#messageForm">
                    <i class="fas fa-file-contract mr-1"></i>
                    <span>View Resume/CV</span>
                </button>
            </div>
            
        </div>

    </div>

</div>
</div>