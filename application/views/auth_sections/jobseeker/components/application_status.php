<?php
    if ($this->session->userType === 'Jobseeker' && isset($applicationStatus) && isset($dateApplied)) {
        $dateApplied = dateFormat($dateApplied,"F d, Y, h:i a");
        if ($applicationStatus == 'Pending') { 
?>
            <div class="container-fluid alert alert-warning mb-4">
                <div class="row align-items-center text-center">
                    <div class="col-md-8 text-md-left">
                        <div class="m-1">
                            You submitted your application for this job at <strong><?php echo $dateApplied ?></strong></a>. 
                        </div>
                    </div>
                    <div class="col-md-4 text-md-right mt-2 mt-md-0">
                        <button 
                            class       = "btn btn-warning btn-sm"
                            data-toggle = "modal"
                            data-target = "#viewApplicationModal"
                        >View my application</button>
                    </div> 
                </div> 
            </div>
<?php   } else if ($applicationStatus == 'Hired') { ?>
            <div class="alert alert-success mb-4 text-md-left text-center">
                You are <strong>hired</strong> for this job.</a>
            </div>
<?php   } else if ($applicationStatus == 'Rejected') { ?>
            <div class="alert alert-dark mb-4 text-md-left text-center">
                Your application is not approved.</a>
            </div>
<?php
        }
    }
?>