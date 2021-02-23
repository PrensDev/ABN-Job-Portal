<!-- HEADER -->
<div class="container-fluid py-3 py-5 user-select-none bg-light">
<div class="container-md">   
<div class="row">

    <!-- COMPANY IMAGE/LOGO -->
    <div class="col-md-auto d-flex justify-content-center">
        <?php if ($profilePic != NULL) { ?>
        <div
            data-toggle     = "tooltip"
            data-placement  = "bottom"
            title           = "Click here to edit your profile picture"
        >
            <img 
                src         = "<?php echo base_url() . 'public/img/employers/' . $profilePic ?>" 
                alt         = "" 
                height      = "125" 
                class       = "btn p-0 border" 
                draggable   = "false"
                data-toggle = "modal" 
                data-target = "#editImageModal"
            >
        </div>
            
        <?php } else { ?>
        <div
            data-toggle     = "tooltip"
            data-placement  = "bottom"
            title           = "Click here to edit your profile picture"
        >
            <img 
                src         = "<?php echo base_url() ?>public/img/employers/blank_dp.png" 
                alt         = "" 
                height      = "125" 
                class       = "btn p-0 border" 
                draggable   = "false"
                data-toggle = "modal" 
                data-target = "#editImageModal"
            >
        </div>
        <?php } ?>
    </div>
    
    <!-- COMPANY INFORMATION -->
    <div class="col-md text-center text-md-left mt-3 mt-md-0">
        <h1 class="font-weight-normal">
            <span
                data-toggle     = "tooltip"
                data-placement  = "bottom"
                title           = "Company Name"
            >
                <?php echo $userName ?>
            </span>
        </h1>
        
        <div class="d-block d-md-flex flex-wrap">
            
            <div 
                class           = "mr-3"
                data-toggle     = "tooltip"
                data-placement  = "top"
                title           = "Location"
            >
                <i class="fas fa-map-marker-alt mr-1 text-info"></i>
                <span class="text-secondary"><?php echo $location ?></span>
            </div>

            <div 
                class           = "mr-3"
                data-toggle     = "tooltip"
                data-placement  = "top"
                title           = "Contact Number"
            >
                <i class="fas fa-phone-alt mr-1 text-info"></i>
                <span class="text-secondary"><?php echo $contactNumber ?></span>
            </div>

            <div 
                class           = "mr-3"
                data-toggle     = "tooltip"
                data-placement  = "top"
                title           = "Email"
            >
                <i class="fas fa-envelope mr-1 text-info"></i>
                <span class="text-secondary"><?php echo $email ?></span>
            </div>

        </div>
        
        <div class="mt-3 text-center d-block d-md-flex">

            <!-- EDIT PROFILE PICTURE -->
            <div class="mr-3 mb-1 mb-md-0 text-primary">
                <small>
                    <a class="btn btn-sm btn-outline-primary py-1 px-2" data-toggle="modal" data-target="#editImageModal" id="editInfoBtn">
                        <i class="fas fa-image mr-1"></i>
                        <span>Edit profile picture</span>
                    </a>
                </small>
            </div>

            <div class="mr-3 text-primary">
                <small>
                    <a class="btn btn-sm btn-outline-primary py-1 px-2" href="<?php echo base_url() ?>auth/edit_information">
                        <i class="fas fa-pen mr-1"></i>
                        <span>Edit your information</span>
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
]) ?>