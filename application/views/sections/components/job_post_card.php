<?php
    // CUSTOMED VARIABLES
    $jobTypeClass   = getJobTypeClass($jobType);
    $offeredSalary  = salaryRangeFormat($minSalary, $maxSalary);
    $dateCreated    = dateFormat($dateCreated, "M. d, Y");
?>

<div class="col-lg-6 my-2">
<div class="bg-white p-3 border d-flex flex-column h-100 justify-content-between">
    
    <div class="d-flex mb-3 mr-1">

        <!-- COMPANY LOGO -->
        <div class="company-logo mr-3 d-none d-sm-block">
            <?php if ($profilePic != NULL) { ?>
                <a href="<?php echo base_url() . 'companies/details/' . $employerID ?>">
                    <img 
                        class       = "border" 
                        src         = "<?php echo base_url() . 'public/img/employers/' . $profilePic ?>" 
                        alt         = "<?php echo $jobTitle?>"
                        height      = "100"
                        draggable   = "false"
                    >
                </a>
            <?php } else { ?>
                <a href="<?php echo base_url() . 'companies/details/' . $employerID ?>">
                    <img 
                        class       = "border" 
                        src         = "<?php echo base_url() ?>public/img/employers/blank_dp.png" 
                        alt         = "<?php echo $jobTitle ?>" 
                        height      = "100"
                        draggable   = "false"
                    >
                </a>
            <?php } ?>
        </div>

        <!-- JOB DETAILS -->
        <div class="flex-grow-1">
            
            <h5 class="mb-1 mr-1">
                <a 
                    href           = "<?php echo base_url() ?>jobs/details/<?php echo $jobPostID ?>"
                    data-toggle    = "tooltip"
                    data-placement = "right"
                    title          = "Job Title" 
                    class          = "text-decoration-none text-uppercase text-dark"
                ><?php echo $jobTitle ?></a>
            </h5>
            
            <div class="text-primary">
                <a 
                    href           = "<?php echo base_url() ?>companies/details/<?php echo $employerID ?>" 
                    class          = "text-primary" 
                    data-toggle    = "tooltip"
                    data-placement = "right"
                    title          = "Company"
                >
                    <span><?php echo $companyName ?></span>
                </a>
            </div>

            <?php $this->load->view('auth_sections/jobseeker/components/sub_components/application_status_badge', ) ?>

            <!-- JOB DETAILS -->
            <div class="d-flex flex-wrap text-secondary mt-2">
                
                <!-- OFFERED SALARY -->
                <div class="mr-3">
                    <span
                        data-toggle    = "tooltip"
                        data-placement = "right"
                        title          = "Offered Salary"
                    >                   
                        <i class="fas fa-money-bill-wave mr-1"></i>
                        <span><?php echo $offeredSalary ?></span>
                    </span>
                </div>

                <!-- INDUSTRY TYPE -->
                <div class="mr-3 text-capitalize">
                    <span
                        data-toggle    = "tooltip"
                        data-placement = "right"
                        title          = "Field"
                    >  
                        <i class="fas fa-cog mr-1"></i>
                        <span><?php echo $field ?></span>
                    </span>
                </div>

                <!-- LOCATION -->
                <div class="mr-3 text-capitalize">
                    <span
                        data-toggle    = "tooltip"
                        data-placement = "right"
                        title          = "Location"
                    >  
                        <i class="fas fa-map-marker-alt mr-1"></i>
                        <span><?php echo $location ?></span>
                    </span>
                </div>
                
            </div>

        </div>
        
        <!-- JOB SUB-DETAILS -->
        <div class="text-right" title="Job Type: <?php echo $jobType ?>">
            <span 
                class          = "
                    badge 
                    border 
                    border-<?php echo $jobTypeClass ?> 
                    text-<?php echo $jobTypeClass ?> 
                    p-2 
                    text-uppercase
                "
                data-toggle    = "tooltip"
                data-placement = "left"
                title          = "Job Type"
            >
                <i class="fas fa-user-tie mr-1"></i>
                <span><?php echo $jobType ?></span>
            </span>
            <span 
                class          = "badge text-secondary mt-1" 
                data-toggle    = "tooltip"
                data-placement = "left"
                title          = "Posted <?php echo $dateCreated ?>">
                <i class="fas fa-clock"></i>
                <?php echo $dateCreated ?>
            </span>
        </div>

    </div>

    <!-- USER-ACTIONS -->
    <div class="text-right">
        <?php
            if ($this->session->userType === 'Jobseeker') {
                if ($bookmarkID === NULL) {
        ?>
            <button 
                class           = "btn border border-warning text-warning" 
                data-toggle     = "tooltip" 
                data-placement  = "top" 
                title           = "Add to bookmark" 
                value           = "<?php echo $jobPostID ?>" 
                id              = "addBookmarkBtn"
            >
                <i class="far fa-bookmark"></i>
            </button>    
        <?php   } else { ?>
            <button 
                class           = "btn border border-warning text-warning" 
                data-toggle     = "tooltip" 
                data-placement  = "top" 
                title           = "Remove bookmark" 
                value           = "<?php echo $bookmarkID ?>" 
                id              = "removeBookmarkBtn"
            >
                <i class="fas fa-bookmark"></i>
            </button>    
        <?php  
                }
            }
            
            if ($this->session->userType === 'Employer' && $this->session->id == $employerID) { ?>
                <a 
                    href            = "<?php echo base_url() . 'auth/edit_post/' . $jobPostID ?>" 
                    class           = "btn btn-light text-info border"  
                    data-toggle     = "tooltip" 
                    data-placement  = "top" 
                    title           = "Edit Post"
                >
                    <i class="fas fa-pen"></i>
                </a>
        <?php } ?>
        
        <a href="<?php echo base_url() ?>jobs/details/<?php echo $jobPostID ?>" class="btn btn-secondary">View More</a>
    </div>

</div>
</div>