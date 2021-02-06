<div class="container-fluid py-5 user-select-none bg-light">
<div class="container-md">
<div class="row">

    <!-- COMPANY IMAGE/LOGO -->
    <div class="col-md-auto d-flex justify-content-center">
        <?php if ($profilePic == NULL) { ?>
            <img 
                src         = "<?php echo base_url() ?>public/img/jobseekers/blank_dp.png" 
                alt         = "<?php echo $fullName ?>" 
                height      = "125" 
                width       = "125" 
                class       = "btn p-0 border rounded-pill" 
                draggable   = "false"
                data-toggle = "modal" 
                data-target = "#editImageModal"
            >
        <?php } else { ?>
            <img 
                src         = "<?php echo base_url() . 'public/img/jobseekers/' . $profilePic ?>" 
                alt         = "<?php echo $fullName ?>" 
                height      = "125" 
                width       = "125" 
                class       = "btn p-0 border rounded-pill" 
                draggable   = "false"
                data-toggle = "modal" 
                data-target = "#editImageModal"
            >
        <?php } ?>
    </div>
    
    <!-- COMPANY INFORMATION -->
    <div class="col-md text-center text-md-left px-0 mt-3 mt-md-0">
        <h1 class="font-weight-normal"><?php echo $fullName ?></h1>
        
        <div class="d-block d-md-flex flex-wrap">
            
            <!-- CITY -->
            <div class="mr-3">
                <i class="fas fa-map-marker-alt mr-1 text-danger"></i>
                <span class="text-secondary"><?php echo $cityProvince ?></span>
            </div>

            <!-- PHONE NUMBER -->
            <div class="mr-3">
                <i class="fas fa-phone-alt mr-1 text-danger"></i>
                <span class="text-secondary"><?php echo $contactNumber ?></span>
            </div>

            <!-- EMAIL ADDRESS -->
            <div class="mr-3">
                <i class="fas fa-envelope mr-1 text-danger"></i>
                <span class="text-secondary"><?php echo $email ?></span>
            </div>

        </div>

        <div class="mt-3">

            <!-- EDIT PROFILE PICTURE -->
            <div class="mr-3 text-primary">
                <small>
                    <i class="fas fa-pen mr-1"></i>
                    <a class="btn-link" data-toggle="modal" data-target="#editImageModal" id="editInfoBtn">
                        <span>Edit profile picture</span>
                    </a>
                </small>
            </div>

        </div>
    </div>
    
</div>
</div>
</div>

<?php $this->load->view('auth_sections/components/edit_img_modal', [
    'profilePic' => $profilePic,
    'userName'   => $userName,
]); ?>