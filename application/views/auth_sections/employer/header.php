<!-- HEADER -->
<div 
    class="container-fluid py-3 parallax-window image-overlay py-5 user-select-none" 
    data-parallax="scroll" 
    data-image-src="<?php echo base_url() ?>public/img/employer_header.jpg"
>
<div class="container-md text-white">   
<div class="row">

    <!-- COMPANY IMAGE/LOGO -->
    <div class="col-md-auto d-flex justify-content-center">
        <img src="assets\job_logo_5.jpg" alt="" height="125" class="rounded">
    </div>
    
    <!-- COMPANY INFORMATION -->
    <div class="col-md text-center text-md-left px-0 mt-3 mt-md-0">
        <h1 class="font-weight-light"><?php echo $username ?></h1>
        
        <div class="d-block d-md-flex flex-wrap">
            
            <div class="mr-3">
                <i class="fas fa-map-marker-alt mr-1"></i>
                <span><?php echo $location ?></span>
            </div>

            <div class="mr-3">
                <i class="fas fa-phone-alt mr-1"></i>
                <span><?php echo $contactNumber ?></span>
            </div>

            <div class="mr-3">
                <i class="fas fa-envelope mr-1"></i>
                <span><?php echo $email ?></span>
            </div>

        </div>
        
        <!-- EDIT INFORMATION USER CONTROL -->
        <div class="mt-3">
            <div class="mr-3">
                <small>
                    <a href="edit_employer_information.html" class="text-light">
                        <i class="fas fa-pen mr-1"></i>
                        <span>Edit information</span>
                    </a>
                </small>
            </div>
        </div>
        <!-- END OF EDIT INFORMATION USER CONTROL -->

    </div>
    <!-- END OF COMPANY INFORMATION -->

</div>
</div>
</div>