<!-- JOB LIST SECTION -->
<div class="container-fluid py-5 bg-light">
<div class="container-md">
    <h1 class="font-weight-normal"><?php echo $bodyTitle ?></h1>
    <p class="text-secondary"><?php echo $bodySubtitle ?></p>

    <div class="d-flex justify-content-between">
        <p><?php echo $numRows ?> match found.</p>
        <p>Showing page <?php echo $currentPage ?> of <?php echo $totalPages ?>.</p>
    </div>

    <!-- JOB LIST -->
    <div class="row mb-5">

    <?php
            foreach ($posts as $post) {
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
                            
                            <div class="d-flex mb-3 mr-1">
            
                                <!-- COMPANY LOGO -->
                                <div class="company-logo mr-3 d-none d-sm-block">
                                    <a href="' . base_url() . 'companies/details/' . $post->employerID . '">
                                        <img class="border" src="' . base_url() . 'public/img/job_logo_5.jpg" alt="">
                                    </a>
                                </div>
            
                                <!-- JOB DETAILS -->
                                <div class="flex-grow-1">
                                    <!-- JOB TITLE -->
                                    <p class="h5 text-uppercase m-0" title="Job Title: ' . $post->jobTitle . '">
                                        <a href="' . base_url() . 'jobs/details/' . $post->jobPostID . '" class="text-decoration-none text-dark">' . $post->jobTitle . '</a>
                                    </p>
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

    <?php echo $this->pagination->create_links(); ?>

</div>
</div>
<!-- END OF JOB LIST SECTION -->