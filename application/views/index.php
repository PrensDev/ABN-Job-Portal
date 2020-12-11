<!-- HERO -->
<div class="container-fluid parallax-window image-overlay text-light py-5" data-parallax="scroll" data-image-src="<?php echo base_url() ?>public/img/hero-bg.jpg">
<div class="container-md my-lg-5 py-lg-5">
    
    <h1 class="display-3 mt-0 animate__animated animate__fadeInDown animate__slow">Find your <span class="font-weight-bold">dream job</span> here.</h1>
    <p class="px-1 m-0 h5 font-weight-light animate__animated animate__fadeInDown animate__slow">Search over thousands of our available jobs posted here.</p>

    <!-- SEARCH BAR -->
    <div class="search-bar bg-white mt-5 p-1">
        <form action="" method="POST">
        <div class="row">
            
            <!-- KEYWORD FIELD -->
            <div class="col-lg">
            <div class="input-group">
                <input type="text" class="form-control border-0 shadow-none" placeholder="Keyword..." name="jobKeyword">
                <div class="input-group-append">
                    <span class="input-group-text bg-white border-0"><i class="fas fa-search"></i></span>
                </div>
            </div>
            </div>

            <!-- LOCATION FIELD -->
            <div class="col-lg">
            <div class="input-group">
                <input type="text" class="form-control border-0 shadow-none" placeholder="Location..." name="jobKeyword">
                <div class="input-group-append">
                    <span class="input-group-text bg-white border-0"><i class="fas fa-map-marker-alt"></i></span>
                </div>
            </div>
            </div>

            <!-- JOB TYPE FIELD -->
            <div class="col-lg">
            <select class="selectpicker show-tick border-0 shadow-none form-control bg-white" data-style="btn bg-white text-dark" title="Job Type...">
                <option value="Full Time">Full Time</option>
                <option value="Part Time">Part Time</option>
                <option value="Internship/OJT">Internship/OJT</option>
                <option value="Temporary">Temporary</option>
            </select>
            </div>

            <div class="col-lg">
            <button type="submit" class="btn btn-primary btn-block">
                <i class="fas fa-search"></i> Search Now
            </button>
            </div>
            
        </div>
        </form>
    </div>
    <!-- END OF SEARCH BAR -->

    <p class="mt-1">
        <span class="font-weight-bold">Suggestions: </span>
        <a href="#" class="text-white">Software Developer</a>, 
        <a href="#" class="text-white">Mobile Developer</a>, 
        <a href="#" class="text-white">Programmer</a>, 
        <a href="#" class="text-white">more...</a>
    </p>

</div>
</div>
<!-- END OF HERO -->

<?php

    if ( $this->session->has_userdata( 'userType' ) ) {
        #do nothinf
    } else {
        $this->load->view('sections/create_account');
    }

?>

<!-- RECENT JOB SECTIONS -->
<div class="container-fluid bg-light">
<div class="container-md py-5">

    <h1 class="display-4 text-center">Recent Available Jobs</h1>
    <p class="h5 font-weight-normal text-center text-secondary">Discover our latest jobs listed here.</p>

    <!-- JOB LIST -->
    <div class="row my-5">
        
        <?php
            foreach ($recentPosts as $post) {
                $jobType = $post->jobType;
                if ($jobType == 'Full Time') {
                    $jobTypeClass = 'success';
                } else if ($jobType == 'Part Time') {
                    $jobTypeClass = 'info';
                } else if ($jobType == 'Internship/OJT') {
                    $jobTypeClass = 'warning';
                } else if ($jobType == 'Temporary') {
                    $jobTypeClass = 'secondary';
                }

                $minSalary = $post->minSalary;

                if ($minSalary < 1000) {
                    $minSalary = number_format($minSalary, 1, '.', '');
                } else if ($minSalary < 1000000) {
                    $minSalary = number_format($minSalary / 1000, 1, '.', '') . 'K';
                } else if ($minSalary < 1000000000) {
                    $minSalary = number_format($minSalary / 1000000, 1, '.', '') . 'M';
                } else if ($minSalary < 1000000000000) {
                    $minSalary = number_format($minSalary / 1000000000, 1, '.', '') . 'B';
                } else if ($minSalary < 1000000000000000) {
                    $minSalary = number_format($minSalary / 1000000000000, 1, '.', '') . 'T';
                } 

                $maxSalary = $post->maxSalary;

                if ($maxSalary < 1000) {
                    $maxSalary = number_format($maxSalary, 1, '.', '');
                } else if ($maxSalary < 1000000) {
                    $maxSalary = number_format($maxSalary / 1000, 1, '.', '') . 'K';
                } else if ($maxSalary < 1000000000) {
                    $maxSalary = number_format($maxSalary / 1000000, 1, '.', '') . 'M';
                } else if ($maxSalary < 1000000000000) {
                    $maxSalary = number_format($maxSalary / 1000000000, 1, '.', '') . 'B';
                } else if ($maxSalary < 1000000000000000) {
                    $maxSalary = number_format($maxSalary / 1000000000000, 1, '.', '') . 'T';
                }

                $offeredSalary = '&#8369;' . $minSalary . ' - &#8369;' . $maxSalary;

                $dateCreated = date_format(date_create($post->dateCreated),"M. d, Y");

                echo '
                    <div class="col-lg-6 my-2">
                        <div class="bg-white p-3 border d-flex flex-column h-100 justify-content-between">
                            
                            <div class="d-flex mb-3">
            
                                <!-- COMPANY LOGO -->
                                <div class="company-logo mr-3 d-none d-sm-block">
                                    <a href="' . base_url() . 'companies/details/' . $post->employerID . '">
                                        <img class="border" src="' . base_url() . 'public/img/job_logo_5.jpg" alt="">
                                    </a>
                                </div>
            
                                <!-- JOB DETAILS -->
                                <div class="flex-grow-1">
                                    <!-- JOB TITLE -->
                                    <p class="h5 text-uppercase m-0" title="Job Title: ' . $post->jobTitle . '">' . $post->jobTitle . '</p>
                                    <div class="mr-3 text-primary mt-1">
                                        <a href="' . base_url() . 'companies/details/' . $post->employerID . '" class="text-primary" title="Company: ' . $post->companyName . '">
                                            <span>' . $post->companyName . '</span>
                                        </a>
                                    </div>
            
                                    <!-- JOB DETAILS -->
                                    <div class="d-flex flex-wrap text-secondary mt-2">
                                        
                                        <!-- OFFERED SALARY -->
                                        <div class="mr-3" title="Offered Salary: ' . $offeredSalary . '">
                                            <i class="fas fa-money-bill-wave mr-1 text-danger"></i>
                                            <span>' . $offeredSalary . '</span>
                                        </div>
            
                                        <!-- INDUSTRY TYPE -->
                                        <div class="mr-3 text-capitalize" title="Industry Type: ' . $post->industryType . '">
                                            <i class="fas fa-cog mr-1 text-danger"></i>
                                            <span>' . $post->industryType . '</span>
                                        </div>

                                        <!-- LOCATION -->
                                        <div class="mr-3 text-capitalize" title="Location: ' . $post->location . '">
                                            <i class="fas fa-map-marker-alt mr-1 text-danger"></i>
                                            <span>' . $post->location . '</span>
                                        </div>
                                        
                                    </div>
            
                                </div>
            
                                <!-- JOB SUB-DETAILS -->
                                <div class="text-right" title="Job Type: ' . $jobType . '">
                                    <span class="badge badge-' . $jobTypeClass . ' p-2 text-uppercase">
                                        <i class="fas fa-user-tie mr-1"></i>
                                        ' . $jobType . '
                                    </span>
                                    <p class="text-secondary font-italic mt-1" title="Posted ' . $dateCreated . '">' . $dateCreated . '</p>
                                </div>
            
                            </div>
            
                            <!-- USER-ACTIONS -->
                            <div class="text-right">
                                <button class="btn btn-outline-warning" data-toggle="tooltip" data-placement="top" title="Add to bookmark">
                                    <i class="fas fa-bookmark"></i>
                                </button>
                                <a href="' . base_url() . 'jobs/details/' . $post->jobPostID . '" class="btn btn-outline-secondary">View More</a>
                            </div>
            
                        </div>
                    </div>
                ';
            }
        ?>

    </div>
    <!-- END OF JOB LIST -->

    <div class="d-flex justify-content-center">
        <a href="<?php echo base_url() ?>jobs/recent" class="btn btn-primary btn-lg">View More Recent Jobs</a>
    </div>

</div>
</div>
<!-- END OF RECENT JOB SECTION -->

<?php

    if ( $this->session->userType == 'Job Seeker' ) {
        #do nothing
    } else {
        $this->load->view('sections/post_a_job');
    }

?>
