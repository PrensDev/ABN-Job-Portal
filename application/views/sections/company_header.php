<div class="row">
    <div class="col-md-auto d-flex justify-content-center">
        <?php
            if (isset($profilePic)) {
                echo '
                    <img 
                        src         = "'. base_url() . 'public/img/employers/' . $profilePic . '" 
                        alt         = "' . $companyName . '" 
                        height      = "125"
                        width       = "125" 
                        class       = "border" 
                        draggable   = "false"
                    >
                ';
            } else {
                echo '
                    <img 
                        src         = "'. base_url() . 'public/img/employers/blank_dp.png" 
                        alt         = "' . $companyName . '" 
                        height      = "125"
                        width       = "125" 
                        class       = "border" 
                        draggable   = "false"
                    >
                ';
            }
        ?>
    </div>

    <!-- COMPANY INFORMATION -->
    <div class="col-md text-center text-md-left mt-3 mt-md-0">
        <h1>
            <a class="text-decoration-none text-dark font-weight-normal" href="<?php echo base_url() . 'companies/details/' . $employerID ?>">
                <?php echo $companyName ?>
            </a>
        </h1>
        
        <div class="d-block d-md-flex flex-wrap">
            <div class="mr-3">
                <i class="fas fa-map-marker-alt mr-1 text-danger"></i>
                <span class="text-secondary"><?php echo $location ?></span>
            </div>

            <div class="mr-3">
                <i class="fas fa-phone-alt mr-1 text-danger"></i>
                <span class="text-secondary"><?php echo $contactNumber ?></span>
            </div>

            <div class="mr-3">
                <i class="fas fa-envelope mr-1 text-danger"></i>
                <span class="text-secondary"><?php echo $email ?></span>
            </div>
        </div>

    </div>
</div>

<hr class="my-4">