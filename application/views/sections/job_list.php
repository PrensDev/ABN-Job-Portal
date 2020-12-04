<!-- JOB LIST SECTION -->
<div class="container-fluid py-5 bg-light">
<div class="container-md">
    <h1 class="font-weight-normal">Search result of "Project Designer"</h1>
    <p class="text-secondary">in "Quezon City", "Full-Time".</p>
    <p>176 match found.</p>

    <!-- JOB LIST -->
    <div class="row my-5">

        <?php

        $i = 0;

        while ($i < 10) {
            echo '
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
                        <a href="' . base_url() . '/home/jobs" class="btn btn-outline-secondary">View More</a>
                    </div>
    
                </div>
            </div>
            <!-- END OF JOB LIST DATA -->
            ';
            $i++;
        } 
        
        ?>

    </div>
    <!-- END OF JOB LIST -->

    <!-- PAGINATION -->
    <nav>
        <ul class="pagination justify-content-end">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                    <i class="fas fa-caret-left"></i>
                </a>
            </li>
            <li class="page-item active">
                <a class="page-link" href="#">1</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#">2</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#">3</a>
            </li>
            <li class="page-item disabled">
                <a class="page-link" href="#">...</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#">18</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#">
                    <i class="fas fa-caret-right"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- END OF PAGINATION -->

</div>
</div>
<!-- END OF JOB LIST SECTION -->