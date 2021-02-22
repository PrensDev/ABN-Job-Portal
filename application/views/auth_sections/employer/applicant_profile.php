<?php

$fullName = $firstName . ' ' . $lastName;

$lastUpdated = 'Last updated <strong>' . date_format(date_create($lastUpdated),"F d, Y") . '</strong>';

?>

<div class="container-fluid py-5">
<div class="container-md">
    
    <div class="row mb-4">
        <div class="col-md-auto d-flex justify-content-center">
            <?php if (isset($profilePic)) { ?>
                <img 
                    src         = "<?php echo base_url() .'public/img/jobseekers/' . $profilePic ?>" 
                    height      = "125" 
                    width       = "125" 
                    class       = "rounded-pill" 
                    draggable   = "false"
                >
            <?php } else { ?>
                <img 
                    src         = "<?php echo base_url()?>public/img/jobseekers/blank_dp.png" 
                    height      = "125" 
                    width       = "125" 
                    class       = "rounded-pill" 
                    draggable   = "false"
                >
            <?php } ?>
        </div>

        <div class="col-md text-center text-md-left px-0 mt-3 mt-md-0">
            <h1 class="font-weight-normal">
                <span
                    data-toggle    = "tooltip"
                    data-placement = "bottom"
                    title          = "Applicant Name"
                ><?php echo $fullName ?></span>
            </h1>
            
            <div class="d-block d-md-flex flex-wrap">
                
                <!-- LOCATION -->
                <div 
                    class          = "mr-3"
                    data-toggle    = "tooltip"
                    data-placement = "top"
                    title          = "Location"
                >
                    <i class="fas fa-map-marker-alt mr-1 text-danger"></i>
                    <span class=" text-secondary"><?php echo $cityProvince ?></span>
                </div>

                <!-- PHONE NUMBER -->
                <div 
                    class          = "mr-3"
                    data-toggle    = "tooltip"
                    data-placement = "top"
                    title          = "Contact Number"
                >
                    <i class="fas fa-phone-alt mr-1 text-danger"></i>
                    <span class=" text-secondary"><?php echo $contactNumber ?></span>
                </div>

                <!-- EMAIL ADDRESS -->
                <div 
                    class          = "mr-3"
                    data-toggle    = "tooltip"
                    data-placement = "top"
                    title          = "Email"
                >
                    <i class="fas fa-envelope mr-1 text-danger"></i>
                    <span class="text-secondary text-truncate"><?php echo $email ?></span>
                </div>

            </div>
        </div>
    </div>

    <div class="mb-4"><hr></div>

    <div id="applicationStatus">
        <?php if ($status == 'Pending') { ?>
            <div class="container-fluid alert alert-success mb-4 p-2" id="pendingStatus">
                <div class="row align-items-center">
                    <div class="col-md-8 text-md-left text-center">
                        <div class="m-1">
                            <strong><?php echo $fullName ?></strong> is applying for <strong><a href="<?php echo base_url() . 'auth/job_details/' . $jobPostID ?>"><?php echo $jobTitle ?></strong></a>. 
                        </div>
                    </div>
                    <div class="col-md-4 text-md-right text-center mt-2 mt-md-0">
                        <button 
                            type        = "submit" 
                            class       = "btn btn-success m-1 text-nowrap" 
                            data-toggle = "modal" 
                            data-target = "#hireModal"
                        >Hire</button>
                        <button 
                            type        = "submit" 
                            class       = "btn btn-primary m-1 text-nowrap" 
                            data-toggle = "modal" 
                            data-target = "#interviewModal"
                        >Call for Interview</button>
                        <button 
                            type        = "submit" 
                            class       = "btn btn-danger m-1 text-nowrap" 
                            data-toggle = "modal" 
                            data-target = "#rejectModal"
                        >Reject</button>
                    </div> 
                </div> 
            </div>
        <?php } else if ($status == 'Hired') { ?>
            <div class="container-fluid alert alert-primary mb-4 p-2" id="hiredStatus">
                <div class="row align-items-center">
                    <div class="col-md-8 text-md-left text-center">
                        <div class="m-1">
                            You hired <strong><?php echo $fullName ?></strong> for <strong><a href="<?php echo base_url() . 'auth/job_details/' . $jobPostID ?>"><?php echo $jobTitle ?></strong></a>. 
                        </div>
                    </div>
                    <div class="col-md-4 text-md-right text-center mt-2 mt-md-0">
                        <button type="submit" class="btn btn-warning m-1 text-nowrap" data-toggle="modal" data-target="#cancelHiringModal">Cancel</button>
                    </div> 
                </div> 
            </div>
        <?php } else if ($status == 'Rejected') { ?>
            <div class="container-fluid alert alert-danger mb-4 p-2" id="rejectedStatus">
                <div class="row align-items-center">
                    <div class="col-md-8 text-md-left text-center">
                        <div class="m-1">
                            You rejected <strong><?php echo $fullName ?></strong> for <strong><a href="<?php echo base_url() . 'auth/job_details/' . $jobPostID ?>"><?php echo $jobTitle ?></strong></a>. 
                        </div>
                    </div>
                    <div class="col-md-4 text-md-right text-center mt-2 mt-md-0">
                        <button type="submit" class="btn btn-warning m-1 text-nowrap" data-toggle="modal" data-target="#cancelRejectingModal">Cancel</button>
                    </div> 
                </div> 
            </div>
        <?php } ?>
    </div>


    <div class="row">
        
        <!-- APPLICANT INFORMATION -->
        <div class="col-lg-8">
        <div class="mb-3 mb-lg-0 shadow p-md-5 p-3 border">

            <!-- NASIC INFORMATION -->
            <div class="mb-5">
                <h2 class="font-weight-normal"><?php echo $fullName ?></h2>
                <small class="font-italic text-secondary"><?php echo $lastUpdated ?></small>
                <hr class="border-primary">
                <h5 class="mb-2"><?php echo $headline ?></h5>

                <div class="mb-3">
                    <p class="mb-0"><?php echo $age . ' years old, ' . $gender ?></p>
                    <p class="mb-0"><?php echo $cityProvince ?></p>
                    <p class="mb-0"><?php echo $contactNumber ?></p>
                    <p class="mb-0"><?php echo $email ?></p>
                </div>
                <p><?php echo $description ?></p>
            </div>

            <!-- SKILLS -->
            <div class="mb-5">
                <h6 class="text-primary">
                    <i class="fas fa-cogs mr-1"></i>  
                    <span>Skills</span> 
                </h6>
                <hr class="my-2">
                <p><?php echo $skills ?></p>

            </div>

            <!-- EDUCATION -->
            <div class="mb-5">
                <h6 class="text-primary">
                    <i class="fas fa-book mr-1"></i>  
                    <span>Education</span> 
                </h6>
                <hr class="my-2">
                <p><?php echo $education ?></p>

            </div>

            <!-- EXPERIENCES -->
            <div class="mb-5">
                <h6 class="text-primary">
                    <i class="fas fa-chart-line mr-1"></i>  
                    <span>My Experiences</span> 
                </h6>
                <hr class="my-2">
                <p><?php echo $experiences ?></p>
            </div>

        </div>
        </div>


        <!-- APPLICANT INFORMATION SUMMARY -->
        <div class="col-lg-4">

            <?php
                // APPLICANT PERSONAL INFORMATION
                $this->load->view('sections/components/info_card', [
                    'title'        => 'Personal Information',
                    'theme'        => 'info',
                    'infoID'       => 'personalInfo',
                    'infoElements' => [
                        [
                            'icon'          => 'user-tie',
                            'element'       => 'Gender',
                            'content'       => $gender,
                        ],
                        [
                            'icon'          => 'clock',
                            'element'       => 'Age',
                            'content'       => $age,
                        ],
                        [
                            'icon'          => 'map-marker-alt',
                            'element'       => 'Location',
                            'content'       => $cityProvince,
                        ],
                    ],
                ]); 
                
                // APPLICANT CONTACT INFORMATION
                $this->load->view('sections/components/info_card', [
                    'title'        => 'Contact Information',
                    'theme'        => 'danger',
                    'infoID'       => 'contactInfo',
                    'infoElements' => [
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
                    ],
                ]); 
            ?>
            
        </div>

    </div>

</div>
</div>

<?php
if ($status == 'Pending') {
    $this->load->view('sections/components/modal', [
        'id'            => 'hireModal',
        'theme'         => 'success',
        'nofade'        => TRUE,
        'centered'      => TRUE,
        'title'         => 'Hire an applicant',
        'modalIcon'     => 'INFO',
        'message'       => '<p class="m-1">Are you sure you want to hire <strong>' . $fullName . '</strong> for <strong>' . $jobTitle . '</strong>?</p>',
        'actionPath'    => NULL,
        'actionID'      => 'hireApplicantBtn',
        'actionValue'   => $applicationID,
        'actionIcon'    => 'user',
        'actionLabel'   => 'Hire now!',
    ]);

    $this->load->view('sections/components/modal', [
        'id'            => 'interviewModal',
        'theme'         => 'primary',
        'nofade'        => TRUE,
        'centered'      => TRUE,
        'title'         => 'Call for an interview',
        'modalIcon'     => 'INFO',
        'message'       => '<p class="m-1">Are you sure you want to call for an interview for <strong>' . $fullName . '</strong> for <strong>' . $jobTitle . '</strong>?</p>',
        'actionPath'    => NULL,
        'actionID'      => 'interviewApplicantBtn',
        'actionValue'   => $applicationID,
        'actionIcon'    => 'phone-alt',
        'actionLabel'   => 'Continue',
    ]);

    $this->load->view('sections/components/modal', [
        'id'            => 'rejectModal',
        'nofade'        => TRUE,
        'centered'      => TRUE,
        'theme'         => 'danger',
        'title'         => 'Reject an applicant',
        'modalIcon'     => 'WARNING',
        'message'       => '<p class="m-1">You are about to reject <strong> ' . $fullName . '</strong> for <strong>' . $jobTitle . '</strong>. Do you want to continue?</p>',
        'actionPath'    => NULL,
        'actionID'      => 'rejectApplicantBtn',
        'actionValue'   => $applicationID,
        'actionIcon'    => 'user-times',
        'actionLabel'   => 'Reject',
    ]);
} else if ($status == 'Hired') {
    $this->load->view('sections/components/modal', [
        'id'            => 'cancelHiringModal',
        'theme'         => 'warning',
        'title'         => 'Cancel hiring',
        'modalIcon'     => 'WARNING',
        'message'       => '<p class="m-1">Are you sure you want to <strong>cancel hiring</strong> to <strong>' . $fullName . '</strong>?</p>',
        'actionPath'    => NULL,
        'actionID'      => 'cancelHiringBtn',
        'actionValue'   => $applicationID,
        'actionIcon'    => 'user-times',
        'actionLabel'   => 'Continue',
    ]);
} else if ($status == 'Rejected') {
    $this->load->view('sections/components/modal', [
        'id'            => 'cancelRejectingModal',
        'nofade'        => TRUE,
        'centered'      => TRUE,
        'theme'         => 'warning',
        'title'         => 'Cancel rejecting',
        'modalIcon'     => 'WARNING',
        'message'       => '<p class="m-1">Are you sure you want to <strong>cancel rejecting </strong> to <strong>' . $fullName . '</strong>?</p>',
        'actionPath'    => NULL,
        'actionID'      => 'cancelHiringBtn',
        'actionValue'   => $applicationID,
        'actionIcon'    => 'user-times',
        'actionLabel'   => 'Continue',
    ]);
}
?>

<script>

    // HIRE BUTTON
    $(document).on('click','#hireApplicantBtn', function(e) {
        e.preventDefault();
        var applicationID = $(this).attr('value');
        $.ajax({
            url:        "<?php echo base_url() ?>auth/hire_applicant",
            type:       "post",
            dataType:   "json",
            data: {
                applicationID: applicationID,
                jobseekerID:   <?php echo $jobseekerID ?>
            },
            success:    function(data) {
                location.reload();
            } 
        });
    });

    // REJECT BUTTON
    $(document).on('click','#rejectApplicantBtn', function(e) {
        e.preventDefault();
        var applicationID = $(this).attr('value');
        $.ajax({
            url:        "<?php echo base_url() ?>auth/reject_applicant",
            type:       "post",
            dataType:   "json",
            data: {
                applicationID: applicationID
            },
            success:    function(data) {
                location.reload();
            } 
        });
    });

    // CANCEL HIRING BUTTON
    $(document).on('click','#cancelHiringBtn', function(e) {
        e.preventDefault();
        var applicationID = $(this).attr('value');
        $.ajax({
            url:        "<?php echo base_url() ?>auth/cancel_hiring_rejecting",
            type:       "post",
            dataType:   "json",
            data: {
                applicationID: applicationID
            },
            success:    function(data) {
                location.reload();
            } 
        });
    });

    // CANCEL REJECTING BUTTON
    $(document).on('click','#cancelRejectingBtn', function(e) {
        e.preventDefault();
        var applicationID = $(this).attr('value');
        $.ajax({
            url:        "<?php echo base_url() ?>auth/cancel_hiring_rejecting",
            type:       "post",
            dataType:   "json",
            data: {
                applicationID: applicationID
            },
            success:    function(data) {
                location.reload();
            } 
        });
    });
</script>