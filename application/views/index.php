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
                <select class="selectpicker show-tick border-0 shadow-none form-control bg-white" data-style="bg-white text-dark" title="Job Type...">
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

<!-- JOB SEEKER AND EMPLOYER REGISTRATION -->
<div class="container-fluid">
    <div class="container-md py-5">

    <h1 class="display-4 text-center">Create your account here!</h1>
    <p class="h5 font-weight-normal text-center text-secondary">Register now to seek thousand opportunities</p>
    
    <div class="row pt-3">

        <div class="col-lg p-3">
        <div class="card pb-3 shadow">
            <img src="<?php echo base_url() ?>public/img/job-seeker2.jpg" alt="" class="card-img-top">
            <div class="card-body text-center">
            <p class="h2">Are you a Job Seeker?</p>
            <p>Let us help you to find the job that fits to you</p>
            <a href="jobseeker_registration.html" class="btn btn-primary btn-lg mt-3">Register as JOB SEEKER</a>
            </div>
        </div>
        </div>

        <div class="col-lg py-3">
        <div class="card pb-3 shadow">
            <img src="<?php echo base_url() ?>public/img/employer.jpg" alt="" class="card-img-top">
            <div class="card-body text-center">
            <p class="h2">Are you an Employer?</p>
            <p>Find your applicants with us conveniently</p>
            <a href="employer_registration.html" class="btn btn-secondary btn-lg mt-3">Register as EMPLOYER</a>
            </div>
        </div>
        </div>

    </div>
    </div>
</div>

<!-- RECENT JOB SECTIONS -->
<div class="container-fluid bg-light">
    <div class="container-md py-5">

    <h1 class="display-4 text-center">Recent Available Jobs</h1>
    <p class="h5 font-weight-normal text-center text-secondary">Discover our latest jobs listed here.</p>
    
    <!-- JOB LIST -->
    <div class="row my-5">
        
        <!-- JOB LIST DATA -->
        <div class="col-lg-6 my-1">
            <div class="bg-white p-3 border">
                
                <div class="d-flex mb-3">

                    <!-- COMPANY LOGO -->
                    <div class="company-logo mr-3 d-none d-sm-block">
                        <img class="border" src="assets\job_logo_5.jpg" alt="">
                    </div>

                    <!-- JOB DETAILS -->
                    <div class="flex-grow-1">
                        <!-- JOB TITLE -->
                        <p class="h5 text-uppercase m-0">Product Designer</p>
                        <div class="mr-3 text-primary mt-1">
                            <a href="company_profile.html" class="text-primary">
                                <span>Puma Inc. PH</span>
                            </a>
                        </div>

                        <!-- JOB DETAILS -->
                        <div class="d-flex flex-wrap text-secondary mt-2">
                            
                            <!-- OFFERED SALARY -->
                            <div class="mr-3">
                                <i class="fas fa-money-bill-wave mr-1 text-danger"></i>
                                <span>P23k - P35k</span>
                            </div>

                            <!-- LOCATION -->
                            <div class="mr-3">
                                <i class="fas fa-map-marker-alt mr-1 text-danger"></i>
                                <span>Quezon City</span>
                            </div>
                            
                        </div>


                    </div>

                    <!-- JOB SUB-DETAILS -->
                    <div class="text-right">
                        <span class="badge badge-success p-2 text-uppercase">Full Time</span>
                        <p class="text-secondary font-italic mt-1">Jan. 27</p>
                    </div>

                </div>

                <!-- USER-ACTIONS -->
                <div class="text-right">
                    <button class="btn btn-outline-warning" data-toggle="tooltip" data-placement="top" title="Add to bookmark">
                        <i class="fas fa-bookmark"></i>
                    </button>
                    <a href="job_details.html" class="btn btn-outline-secondary">View More</a>
                </div>

            </div>
        </div>
        <!-- END OF JOB LIST DATA -->

        <!-- JOB LIST DATA -->
        <div class="col-lg-6 my-1">
            <div class="bg-white p-3 border">
                
                <div class="d-flex mb-3">

                    <!-- COMPANY LOGO -->
                    <div class="company-logo mr-3 d-none d-sm-block">
                        <img class="border" src="assets\job_logo_5.jpg" alt="">
                    </div>

                    <!-- JOB DETAILS -->
                    <div class="flex-grow-1">
                        <!-- JOB TITLE -->
                        <p class="h5 text-uppercase m-0">Product Designer</p>
                        <div class="mr-3 text-primary mt-1">
                            <a href="company_profile.html" class="text-primary">
                                <span>Puma Inc. PH</span>
                            </a>
                        </div>

                        <!-- JOB DETAILS -->
                        <div class="d-flex flex-wrap text-secondary mt-2">
                            
                            <!-- OFFERED SALARY -->
                            <div class="mr-3">
                                <i class="fas fa-money-bill-wave mr-1 text-danger"></i>
                                <span>P23k - P35k</span>
                            </div>

                            <!-- LOCATION -->
                            <div class="mr-3">
                                <i class="fas fa-map-marker-alt mr-1 text-danger"></i>
                                <span>Quezon City</span>
                            </div>
                            
                        </div>


                    </div>

                    <!-- JOB SUB-DETAILS -->
                    <div class="text-right">
                        <span class="badge badge-success p-2 text-uppercase">Full Time</span>
                        <p class="text-secondary font-italic mt-1">Jan. 27</p>
                    </div>

                </div>

                <!-- USER-ACTIONS -->
                <div class="text-right">
                    <button class="btn btn-outline-warning" data-toggle="tooltip" data-placement="top" title="Add to bookmark">
                        <i class="fas fa-bookmark"></i>
                    </button>
                    <a href="job_details.html" class="btn btn-outline-secondary">View More</a>
                </div>

            </div>
        </div>
        <!-- END OF JOB LIST DATA -->

        <!-- JOB LIST DATA -->
        <div class="col-lg-6 my-1">
            <div class="bg-white p-3 border">
                
                <div class="d-flex mb-3">

                    <!-- COMPANY LOGO -->
                    <div class="company-logo mr-3 d-none d-sm-block">
                        <img class="border" src="assets\job_logo_5.jpg" alt="">
                    </div>

                    <!-- JOB DETAILS -->
                    <div class="flex-grow-1">
                        <!-- JOB TITLE -->
                        <p class="h5 text-uppercase m-0">Product Designer</p>
                        <div class="mr-3 text-primary mt-1">
                            <a href="company_profile.html" class="text-primary">
                                <span>Puma Inc. PH</span>
                            </a>
                        </div>

                        <!-- JOB DETAILS -->
                        <div class="d-flex flex-wrap text-secondary mt-2">
                            
                            <!-- OFFERED SALARY -->
                            <div class="mr-3">
                                <i class="fas fa-money-bill-wave mr-1 text-danger"></i>
                                <span>P23k - P35k</span>
                            </div>

                            <!-- LOCATION -->
                            <div class="mr-3">
                                <i class="fas fa-map-marker-alt mr-1 text-danger"></i>
                                <span>Quezon City</span>
                            </div>
                            
                        </div>


                    </div>

                    <!-- JOB SUB-DETAILS -->
                    <div class="text-right">
                        <span class="badge badge-success p-2 text-uppercase">Full Time</span>
                        <p class="text-secondary font-italic mt-1">Jan. 27</p>
                    </div>

                </div>

                <!-- USER-ACTIONS -->
                <div class="text-right">
                    <button class="btn btn-outline-warning" data-toggle="tooltip" data-placement="top" title="Add to bookmark">
                        <i class="fas fa-bookmark"></i>
                    </button>
                    <a href="job_details.html" class="btn btn-outline-secondary">View More</a>
                </div>

            </div>
        </div>
        <!-- END OF JOB LIST DATA -->

        <!-- JOB LIST DATA -->
        <div class="col-lg-6 my-1">
            <div class="bg-white p-3 border">
                
                <div class="d-flex mb-3">

                    <!-- COMPANY LOGO -->
                    <div class="company-logo mr-3 d-none d-sm-block">
                        <img class="border" src="assets\job_logo_5.jpg" alt="">
                    </div>

                    <!-- JOB DETAILS -->
                    <div class="flex-grow-1">
                        <!-- JOB TITLE -->
                        <p class="h5 text-uppercase m-0">Product Designer</p>
                        <div class="mr-3 text-primary mt-1">
                            <a href="company_profile.html" class="text-primary">
                                <span>Puma Inc. PH</span>
                            </a>
                        </div>

                        <!-- JOB DETAILS -->
                        <div class="d-flex flex-wrap text-secondary mt-2">
                            
                            <!-- OFFERED SALARY -->
                            <div class="mr-3">
                                <i class="fas fa-money-bill-wave mr-1 text-danger"></i>
                                <span>P23k - P35k</span>
                            </div>

                            <!-- LOCATION -->
                            <div class="mr-3">
                                <i class="fas fa-map-marker-alt mr-1 text-danger"></i>
                                <span>Quezon City</span>
                            </div>
                            
                        </div>


                    </div>

                    <!-- JOB SUB-DETAILS -->
                    <div class="text-right">
                        <span class="badge badge-success p-2 text-uppercase">Full Time</span>
                        <p class="text-secondary font-italic mt-1">Jan. 27</p>
                    </div>

                </div>

                <!-- USER-ACTIONS -->
                <div class="text-right">
                    <button class="btn btn-outline-warning" data-toggle="tooltip" data-placement="top" title="Add to bookmark">
                        <i class="fas fa-bookmark"></i>
                    </button>
                    <a href="job_details.html" class="btn btn-outline-secondary">View More</a>
                </div>

            </div>
        </div>
        <!-- END OF JOB LIST DATA -->

        <!-- JOB LIST DATA -->
        <div class="col-lg-6 my-1">
            <div class="bg-white p-3 border">
                
                <div class="d-flex mb-3">

                    <!-- COMPANY LOGO -->
                    <div class="company-logo mr-3 d-none d-sm-block">
                        <img class="border" src="assets\job_logo_5.jpg" alt="">
                    </div>

                    <!-- JOB DETAILS -->
                    <div class="flex-grow-1">
                        <!-- JOB TITLE -->
                        <p class="h5 text-uppercase m-0">Product Designer</p>
                        <div class="mr-3 text-primary mt-1">
                            <a href="company_profile.html" class="text-primary">
                                <span>Puma Inc. PH</span>
                            </a>
                        </div>

                        <!-- JOB DETAILS -->
                        <div class="d-flex flex-wrap text-secondary mt-2">
                            
                            <!-- OFFERED SALARY -->
                            <div class="mr-3">
                                <i class="fas fa-money-bill-wave mr-1 text-danger"></i>
                                <span>P23k - P35k</span>
                            </div>

                            <!-- LOCATION -->
                            <div class="mr-3">
                                <i class="fas fa-map-marker-alt mr-1 text-danger"></i>
                                <span>Quezon City</span>
                            </div>
                            
                        </div>


                    </div>

                    <!-- JOB SUB-DETAILS -->
                    <div class="text-right">
                        <span class="badge badge-success p-2 text-uppercase">Full Time</span>
                        <p class="text-secondary font-italic mt-1">Jan. 27</p>
                    </div>

                </div>

                <!-- USER-ACTIONS -->
                <div class="text-right">
                    <button class="btn btn-outline-warning" data-toggle="tooltip" data-placement="top" title="Add to bookmark">
                        <i class="fas fa-bookmark"></i>
                    </button>
                    <a href="job_details.html" class="btn btn-outline-secondary">View More</a>
                </div>

            </div>
        </div>
        <!-- END OF JOB LIST DATA -->

        <!-- JOB LIST DATA -->
        <div class="col-lg-6 my-1">
            <div class="bg-white p-3 border">
                
                <div class="d-flex mb-3">

                    <!-- COMPANY LOGO -->
                    <div class="company-logo mr-3 d-none d-sm-block">
                        <img class="border" src="assets\job_logo_5.jpg" alt="">
                    </div>

                    <!-- JOB DETAILS -->
                    <div class="flex-grow-1">
                        <!-- JOB TITLE -->
                        <p class="h5 text-uppercase m-0">Product Designer</p>
                        <div class="mr-3 text-primary mt-1">
                            <a href="company_profile.html" class="text-primary">
                                <span>Puma Inc. PH</span>
                            </a>
                        </div>

                        <!-- JOB DETAILS -->
                        <div class="d-flex flex-wrap text-secondary mt-2">
                            
                            <!-- OFFERED SALARY -->
                            <div class="mr-3">
                                <i class="fas fa-money-bill-wave mr-1 text-danger"></i>
                                <span>P23k - P35k</span>
                            </div>

                            <!-- LOCATION -->
                            <div class="mr-3">
                                <i class="fas fa-map-marker-alt mr-1 text-danger"></i>
                                <span>Quezon City</span>
                            </div>
                            
                        </div>


                    </div>

                    <!-- JOB SUB-DETAILS -->
                    <div class="text-right">
                        <span class="badge badge-success p-2 text-uppercase">Full Time</span>
                        <p class="text-secondary font-italic mt-1">Jan. 27</p>
                    </div>

                </div>

                <!-- USER-ACTIONS -->
                <div class="text-right">
                    <button class="btn btn-outline-warning" data-toggle="tooltip" data-placement="top" title="Add to bookmark">
                        <i class="fas fa-bookmark"></i>
                    </button>
                    <a href="job_details.html" class="btn btn-outline-secondary">View More</a>
                </div>

            </div>
        </div>
        <!-- END OF JOB LIST DATA -->

        <!-- JOB LIST DATA -->
        <div class="col-lg-6 my-1">
            <div class="bg-white p-3 border">
                
                <div class="d-flex mb-3">

                    <!-- COMPANY LOGO -->
                    <div class="company-logo mr-3 d-none d-sm-block">
                        <img class="border" src="assets\job_logo_5.jpg" alt="">
                    </div>

                    <!-- JOB DETAILS -->
                    <div class="flex-grow-1">
                        <!-- JOB TITLE -->
                        <p class="h5 text-uppercase m-0">Product Designer</p>
                        <div class="mr-3 text-primary mt-1">
                            <a href="company_profile.html" class="text-primary">
                                <span>Puma Inc. PH</span>
                            </a>
                        </div>

                        <!-- JOB DETAILS -->
                        <div class="d-flex flex-wrap text-secondary mt-2">
                            
                            <!-- OFFERED SALARY -->
                            <div class="mr-3">
                                <i class="fas fa-money-bill-wave mr-1 text-danger"></i>
                                <span>P23k - P35k</span>
                            </div>

                            <!-- LOCATION -->
                            <div class="mr-3">
                                <i class="fas fa-map-marker-alt mr-1 text-danger"></i>
                                <span>Quezon City</span>
                            </div>
                            
                        </div>


                    </div>

                    <!-- JOB SUB-DETAILS -->
                    <div class="text-right">
                        <span class="badge badge-success p-2 text-uppercase">Full Time</span>
                        <p class="text-secondary font-italic mt-1">Jan. 27</p>
                    </div>

                </div>

                <!-- USER-ACTIONS -->
                <div class="text-right">
                    <button class="btn btn-outline-warning" data-toggle="tooltip" data-placement="top" title="Add to bookmark">
                        <i class="fas fa-bookmark"></i>
                    </button>
                    <a href="job_details.html" class="btn btn-outline-secondary">View More</a>
                </div>

            </div>
        </div>
        <!-- END OF JOB LIST DATA -->

        <!-- JOB LIST DATA -->
        <div class="col-lg-6 my-1">
            <div class="bg-white p-3 border">
                
                <div class="d-flex mb-3">

                    <!-- COMPANY LOGO -->
                    <div class="company-logo mr-3 d-none d-sm-block">
                        <img class="border" src="assets\job_logo_5.jpg" alt="">
                    </div>

                    <!-- JOB DETAILS -->
                    <div class="flex-grow-1">
                        <!-- JOB TITLE -->
                        <p class="h5 text-uppercase m-0">Product Designer</p>
                        <div class="mr-3 text-primary mt-1">
                            <a href="company_profile.html" class="text-primary">
                                <span>Puma Inc. PH</span>
                            </a>
                        </div>

                        <!-- JOB DETAILS -->
                        <div class="d-flex flex-wrap text-secondary mt-2">
                            
                            <!-- OFFERED SALARY -->
                            <div class="mr-3">
                                <i class="fas fa-money-bill-wave mr-1 text-danger"></i>
                                <span>P23k - P35k</span>
                            </div>

                            <!-- LOCATION -->
                            <div class="mr-3">
                                <i class="fas fa-map-marker-alt mr-1 text-danger"></i>
                                <span>Quezon City</span>
                            </div>
                            
                        </div>


                    </div>

                    <!-- JOB SUB-DETAILS -->
                    <div class="text-right">
                        <span class="badge badge-success p-2 text-uppercase">Full Time</span>
                        <p class="text-secondary font-italic mt-1">Jan. 27</p>
                    </div>

                </div>

                <!-- USER-ACTIONS -->
                <div class="text-right">
                    <button class="btn btn-outline-warning" data-toggle="tooltip" data-placement="top" title="Add to bookmark">
                        <i class="fas fa-bookmark"></i>
                    </button>
                    <a href="job_details.html" class="btn btn-outline-secondary">View More</a>
                </div>

            </div>
        </div>
        <!-- END OF JOB LIST DATA -->

        

    </div>
    <!-- END OF JOB LIST -->

    <div class="d-flex justify-content-center">
        <a href="job_list.html" class="btn btn-primary btn-lg">View More Recent Jobs</a>
    </div>
    
    </div>
</div>
<!-- END OF RECENT JOB SECTION -->

<!-- CONTACT SECTION -->
<div class="container-fluid parallax-window image-overlay py-5" data-parallax="scroll" data-image-src="<?php echo base_url() ?>public/img/pexels-andrea-piacquadio-840996.jpg">
    <div class="container-md text-center text-light my-5">
        <h1 class="display-4">Want to post a new job?</h1>
        <p class="h5 font-weight-normal">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
        <a href="#" class="btn btn-light btn-lg px-4 py-2 mt-5">Post a job now!</a>
    </div>
</div>
<!-- END CONTACT SECTION -->