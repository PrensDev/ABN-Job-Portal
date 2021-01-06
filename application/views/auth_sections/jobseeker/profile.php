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
            ?>
            
            <!-- GENERAL INFORMATION CARD -->
            <div class="card mb-3">
                <div class="card-header bg-white">
                    <strong>Personal Information</strong>
                </div>
                <div class="card-body p-0">
                    
                    <div class="list-group list-group-flush">

                        <div class="list-group-item d-flex border-0">
                            <div class="list-group-item-icon h5 text-info">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <div>
                                <p class="m-0 font-weight-bold">Gender</p>
                                <p class="m-0 text-secondary"><?php echo $gender ?></p>
                            </div>
                        </div>

                        <div class="list-group-item d-flex border-0">
                            <div class="list-group-item-icon h5 text-info">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div>
                                <p class="m-0 font-weight-bold">Age</p>
                                <p class="m-0 text-secondary"><?php echo $age ?></p>
                            </div>
                        </div>

                        <div class="list-group-item d-flex border-0">
                            <div class="list-group-item-icon h5 text-info">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <p class="m-0 font-weight-bold">Location</p>
                                <p class="m-0 text-secondary"><?php echo $cityProvince ?></p>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
            </div>

            <!-- CONTACT INFORMATION CARD -->
            <div class="card mb-3">
                <div class="card-header bg-white">
                    <strong>Contact Information</strong>
                </div>
                <div class="card-body p-0">
                    
                    <div class="list-group list-group-flush">

                        <div class="list-group-item d-flex border-0">
                            <div class="list-group-item-icon h5 text-danger">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div>
                                <p class="m-0 font-weight-bold">Contact Number</p>
                                <p class="m-0 text-secondary"><?php echo $contactNumber ?></p>
                            </div>
                        </div>

                        <div class="list-group-item d-flex border-0">
                            <div class="list-group-item-icon h5 text-danger">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div>
                                <p class="m-0 font-weight-bold">Email</p>
                                <p class="m-0 text-secondary"><?php echo $email ?></p>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
            </div>

        </div>

    </div>
    
</div>
</div>