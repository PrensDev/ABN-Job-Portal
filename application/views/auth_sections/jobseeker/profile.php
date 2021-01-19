<div class="container-fluid">
<div class="container-md py-5">
    
    <div class="mb-4">
        <h1 class="font-weight-light">Resume</h1>
    </div>

    <?php $this->load->view('auth_sections/components/alert') ?>

    <div class="row">

        <!-- RESUME -->
        <div class="col-lg-8">
            <?php
                if (isset($resumeData)) {
                    $this->load->view('auth_sections/jobseeker/components/resume', $resumeData);
                } else {
                    $this->load->view('auth_sections/jobseeker/components/empty_resume');
                }
            ?>
        </div>
        
        <!-- BASIC INFORMATION -->
        <div class="col-lg-4">
            <?php
                if (isset($resumeData)) {
                    $this->load->view('auth_sections/jobseeker/components/resume_control', $resumeData);
                }

                // PERSONAL INFORMATION
                $this->load->view('sections/components/info_card', [
                    'title'         => 'Personal Information',
                    'theme'         => 'info',
                    'infoElements'  => [
                        [
                            'icon'      => 'user-tie',
                            'element'   => 'Gender',
                            'content'   => $gender,
                        ],
                        [
                            'icon'      => 'clock',
                            'element'   => 'Age',
                            'content'   => $age,
                        ],
                        [
                            'icon'      => 'map-marker-alt',
                            'element'   => 'Location',
                            'content'   => $cityProvince,
                        ],
                    ],
                ]);

                // CONTACT INFORMATION
                $this->load->view('sections/components/info_card', [
                    'title'         => 'Contact Information',
                    'theme'         => 'danger',
                    'infoElements'  => [
                        [
                            'icon'      => 'phone-alt',
                            'element'   => 'Contact Number',
                            'content'   => $contactNumber,
                        ],
                        [
                            'icon'      => 'envelope',
                            'element'   => 'Email',
                            'content'   => $email,
                        ],
                    ],
                ]);
            ?>
        </div>

    </div>
    
</div>
</div>