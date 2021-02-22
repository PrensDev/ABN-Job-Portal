<div class="row">
    <div class="col-md-auto d-flex justify-content-center">
        <?php if (isset($profilePic)) { ?>
            <img 
                src             = "<?php echo base_url() . 'public/img/employers/' . $profilePic ?>" 
                alt             = "<?php echo $companyName ?>" 
                height          = "125"
                width           = "125" 
                class           = "border" 
                draggable       = "false"
                data-toggle     = "tooltip"
                data-placement  = "bottom"
                title           = "Company Logo"
            >
        <?php } else { ?>
            <img 
                src             = "<?php echo base_url() ?>public/img/employers/blank_dp.png" 
                alt             = "<?php echo $companyName ?>" 
                height          = "125"
                width           = "125" 
                class           = "border" 
                draggable       = "false"
                data-toggle     = "tooltip"
                data-placement  = "bottom"
                title           = "This company doesn't have logo yet"
            >
        <?php } ?>
    </div>

    <!-- COMPANY INFORMATION -->
    <div class="col-md text-center text-md-left mt-3 mt-md-0">
        <h1>
            <a 
                class           = "text-decoration-none text-dark font-weight-normal" 
                href            = "<?php echo base_url() . 'companies/details/' . $employerID ?>"
                data-toggle     = "tooltip"
                data-placement  = "bottom"
                title           = "Company"
            >
                <?php echo $companyName ?>
            </a>
        </h1>
        
        <div class="d-block d-md-flex flex-wrap">
            <div 
                class          = "mr-3"
                data-toggle    = "tooltip"
                data-placement = "top"
                title          = "Location"
            >
                <i class="fas fa-map-marker-alt mr-1 text-danger"></i>
                <span class="text-secondary"><?php echo $location ?></span>
            </div>

            <div 
                class          = "mr-3"
                data-toggle    = "tooltip"
                data-placement = "top"
                title          = "Contact Number"
            >
                <i class="fas fa-phone-alt mr-1 text-danger"></i>
                <span class="text-secondary"><?php echo $contactNumber ?></span>
            </div>

            <div 
                class          = "mr-3"
                data-toggle    = "tooltip"
                data-placement = "top"
                title          = "Email"
            >
                <i class="fas fa-envelope mr-1 text-danger"></i>
                <span class="text-secondary"><?php echo $email ?></span>
            </div>
        </div>

    </div>
</div>

<hr class="my-4">