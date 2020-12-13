<!-- HEADER -->
<div 
    class="container-fluid py-3 parallax-window image-overlay py-5" 
    data-parallax="scroll" 
    data-image-src="<?php echo base_url() ?>public/img/employer_header.jpg">
<div class="container-md text-white">
<div class="row">

    <!-- COMPANY IMAGE/LOGO -->
    <div class="col-md-auto d-flex justify-content-center">
        <img src="<?php echo base_url() ?>public/img/job_logo_5.jpg" alt="" height="125" class="rounded" draggable="false">
    </div>
    
    <!-- COMPANY INFORMATION -->
    <div class="col-md text-center text-md-left px-0 mt-3 mt-md-0">
        <h1>
            <a class="text-decoration-none text-white font-weight-light" href="<?php echo base_url() . 'companies/details/' . $employerID ?>">
                <?php echo $companyName ?>
            </a>
        </h1>
        
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
    
    </div>
    <!-- END OF COMPANY INFORMATION -->

</div>
</div>
</div>