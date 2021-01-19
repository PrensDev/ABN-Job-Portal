<!-- COMPANY PROFILE DETAILS SECTION -->
<div class="container-fluid">
<div class="container py-5">

<?php $this->load->view('sections/company_header', $employerDetails) ?>

<div class="row">

    <!-- COMPANY DESCRIPTION AND AVAILABLE JOBS -->
    <div class="col-lg-8 mb-3">
        <div class="mb-5">
            <h5 class="text-primary mb-3">
                <i class="fas fa-users mr-2"></i>  
                <span>About Our Company</span> 
            </h5>
            <p class="text-justify"><?php echo $description ?></p>
        </div>

        <div class="text-center">
            <a href="<?php echo base_url() . 'companies/available_jobs/' . $employerID ?>" class="btn btn-primary">View all available jobs</a>
        </div>
    </div>
    
    <!-- COMPANY SUMMARY -->
    <div class="col-lg-4">

        <?php
            if ($this->session->userType == 'Employer') {
                if ($this->session->id == $employerID) {
        ?>
            <div class="d-flex justify-content-between alert alert-primary p-3 mb-3">
                <div class="mr-3">
                    <span>Do you want to edit your info?</span>
                </div>
                <div class="text-nowrap">
                    <i class="fas fa-pen text-primary"></i>
                    <a href="<?php echo base_url() ?>auth/edit_information">
                        <span>Edit</span>
                    </a>
                </div>
            </div>
        <?php
                }
            }
        
            // COMPANY DETAILS CARD
            if ($website == '') {
                $websiteContent = '<p class="m-0 text-secondary">This company doesn\'t have website yet.</p>';
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
                'infoElements' => [
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