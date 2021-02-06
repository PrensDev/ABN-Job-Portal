<!-- HEADER -->
<div class="container-fluid py-3 py-5 user-select-none bg-light">
<div class="container-md">   
<div class="row">

    <!-- COMPANY IMAGE/LOGO -->
    <div class="col-md-auto d-flex justify-content-center">
        <?php if ($profilePic != NULL) { ?>
            <img 
                src         = "<?php echo base_url() . 'public/img/employers/' . $profilePic ?>" 
                alt         = "" 
                height      = "125" 
                class       = "btn p-0 border" 
                draggable   = "false"
                data-toggle = "modal" 
                data-target = "#editImageModal"
            >
        <?php } else { ?>
            <img 
                src         = "<?php echo base_url() ?>public/img/employers/blank_dp.png" 
                alt         = "" 
                height      = "125" 
                class       = "btn p-0 border" 
                draggable   = "false"
                data-toggle = "modal" 
                data-target = "#editImageModal"
            >
        <?php } ?>
    </div>
    
    <!-- COMPANY INFORMATION -->
    <div class="col-md text-center text-md-left mt-3 mt-md-0">
        <h1 class="font-weight-normal"><?php echo $userName ?></h1>
        
        <div class="d-block d-md-flex flex-wrap">
            
            <div class="mr-3">
                <i class="fas fa-map-marker-alt mr-1 text-info"></i>
                <span class="text-secondary"><?php echo $location ?></span>
            </div>

            <div class="mr-3">
                <i class="fas fa-phone-alt mr-1 text-info"></i>
                <span class="text-secondary"><?php echo $contactNumber ?></span>
            </div>

            <div class="mr-3">
                <i class="fas fa-envelope mr-1 text-info"></i>
                <span class="text-secondary"><?php echo $email ?></span>
            </div>

        </div>
        
        <!-- EDIT INFORMATION USER CONTROL -->
        <div class="mt-3">
            <div class="mr-3">
                <small class="text-primary">
                    <i class="fas fa-pen mr-1"></i>
                    <a class="link" data-toggle="modal" data-target="#editImageModal" id="editInfoBtn">
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
]) ?>