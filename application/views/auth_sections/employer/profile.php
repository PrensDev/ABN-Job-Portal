<!-- COMPANY PROFILE DETAILS SECTION -->
<div class="container-fluid">
<div class="container-md py-5">

    <!-- HEADER OF CONTENT -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="font-weight-light">Information</h1>
        </div>
        <div>
            <a 
                href            = "<?php echo base_url() ?>auth/edit_information" 
                class           = "btn btn-primary" 
                data-toggle     = "tooltip" 
                data-placement  = "left" 
                title           = "Edit information"
            >
                <i class="fas fa-pen mr-1"></i>
                <span class="d-none d-sm-inline">Edit information</span>
            </a>
        </div>
    </div>

    <?php $this->load->view('auth_sections/components/alert') ?>

    <!-- INFORMAION DETAILS -->
    <div class="row">
        <div class="col-lg-8 mb-3 lg-0">

            <!-- USER DESCRIPTION -->
            <div class="mb-5">
                <h5 class="text-primary mb-3">
                    <i class="fas fa-users mr-2"></i>  
                    <span>About this company</span> 
                </h5>
                <p><?php echo $description ?></p>
            </div>

        </div>
        
        <div class="col-lg-4">
            <?php
                // COMPANY DETAILS CARD
                if ($website == '') {
                    $websiteContent = '<p class="m-0 text-secondary">You don\'t have website yet.</p>';
                } else {
                    $websiteContent = '
                        <p class="m-0">
                            <a 
                                href            = "' . $website . '" 
                                class           = "btn btn-primary btn-sm mt-1" 
                                target          = "_blank" 
                                data-toggle     = "tooltip" 
                                data-placement  = "left" 
                                title           = "' . $website . '"
                            >
                                <i class="fas fa-external-link-alt"></i>
                                <span>Go to their website</span>
                            </a> 
                        </p>
                    ';
                }

                $this->load->view('sections/components/info_card', [
                    'title'        => 'Company Details',
                    'theme'        => 'danger',
                    'infoID'       => 'companyDetails',
                    'infoElements' => [
                        [
                            'icon'          => 'city',
                            'element'       => 'Company',
                            'content'       => $companyName,
                        ],
                        [
                            'icon'          => 'map-marker-alt',
                            'element'       => 'Location',
                            'content'       => $location,
                        ],
                        [
                            'icon'          => 'phone-alt',
                            'element'       => 'Contact Number',
                            'content'       => $contactNumber,
                        ],
                        [
                            'icon'          => 'envelope',
                            'element'       => 'Email',
                            'content'       => $email,
                        ],
                        [
                            'icon'          => 'globe-asia',
                            'element'       => 'Website',
                            'customContent' => true,
                            'content'       => $websiteContent,
                        ],
                    ],
                ]); 
            ?>

        </div>
    </div>

</div>
</div>