<!-- NAVIGATION BAR -->
<nav class="navbar navbar-expand-md navbar-light bg-white fixed-top shadow" id="navbarTop">
    <div class="container-fluid">
        <div class="container-md">

            <!-- NAVBAR BRAND -->
            <a class="navbar-brand" href="<?php echo base_url() ?>" title="ABN Job Portal">
                <img src="<?php echo base_url() ?>public/img/brand/brand-01.png" height="30" class="d-inline-block align-top" alt="ABN Job Portal Website"1>
            </a>

            <!-- NAVBAR TOGGLER -->
            <button class="btn btn-light navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false">
                <i class="fas fa-bars" id="navbarTogglerIcon"></i>
            </button>

            <!-- NAVBAR LINKS -->
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-md-center">

                    <!-- HOME LINK -->
                    <li class="nav-item mx-md-2">
                        <a class="nav-link" href="<?php echo base_url() ?>">Home</a>
                    </li>

                    <!-- JOBS LINK -->
                    <li class="nav-item mx-md-2">
                        <a class="nav-link" href="<?php echo base_url() ?>home/job_list">Jobs</a>
                    </li>

                    <!-- COMPANIES LINK -->
                    <li class="nav-item mx-md-2">
                        <a class="nav-link" href="<?php echo base_url() ?>home/companies">Companies</a>
                    </li>

                    <!-- ABOUT US LINK -->
                    <li class="nav-item mx-md-2">
                        <a class="nav-link" href="<?php echo base_url() ?>home/about_us">About Us</a>
                    </li>

                    <div class="dropdown-divider"></div>

                    <!-- SIGN IN LINK -->
                    <li class="nav-item mx-md-2">
                        <a href="login.html" class="btn btn-primary btn-block">LogIn</a>
                    </li>

                    <!-- JOB SEEKER USER CONTROL -->
                    <li class="nav-link mx-md-2 nav-item dropdown">

                        <span class="d-flex align-items-center" role="button" data-toggle="dropdown">
                            <img class="rounded-pill border mr-1" src="assets/97.jpg" alt="" height="30" width="30">
                            <span>Juan Dela Cruz</span>
                        </span>

                        <div class="dropdown-menu dropdown-menu-right mt-3 mt-lg-0">

                            <a class="dropdown-item" href="jobseeker_information.html">
                                <span class="pr-4">
                                    <div class="user-nav-icon">
                                        <i class="fas fa-list"></i>
                                    </div>
                                    <span class="pl-1">Information</span>
                                </span>
                            </a>

                            <a class="dropdown-item d-flex justify-content-between align-items-center" href="applications.html">
                                <span class="pr-5">
                                    <div class="user-nav-icon">
                                        <i class="fas fa-file-contract"></i>
                                    </div>
                                    <span class="pl-1">Applications</span>
                                </span>
                                <span class="badge badge-primary">12</span>
                            </a>

                            <a class="dropdown-item d-flex justify-content-between align-items-center" href="bookmarks.html">
                                <span class="pr-5">
                                    <div class="user-nav-icon">
                                        <i class="fas fa-bookmark"></i>
                                    </div>
                                    <span class="pl-1">Bookmarks</span>
                                </span>
                                <span class="badge badge-primary">12</span>
                            </a>

                            <a class="dropdown-item d-flex justify-content-between align-items-center" href="jobseeker_notifications.html">
                                <span class="pr-5">
                                    <div class="user-nav-icon">
                                        <i class="fas fa-bell"></i>
                                    </div>
                                    <span class="pl-1">Notifications</span>
                                </span>
                                <span class="badge badge-primary">12</span>
                            </a>

                            <a class="dropdown-item" href="jobseeker_settings.html">
                                <span class="pr-5">
                                    <div class="user-nav-icon">
                                        <i class="fas fa-cogs"></i>
                                    </div>
                                    <span class="pl-1">Settings</span>
                                </span>
                            </a>

                            <div class="dropdown-divider"></div>

                            <div class="px-3">
                                <button type="submit" class="btn btn-danger btn-block btn-sm"  data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span>Log out</span>
                                </button>
                            </div>

                        </div>

                    </li>
                    <!-- END OF JOB SEEKER USER CONTROL -->

                    <!-- EMPLOYER USER CONTROL -->
                    <li class="nav-link mx-md-2 nav-item dropdown">

                        <span class="d-flex align-items-center" role="button" data-toggle="dropdown">
                            <img class="rounded-pill border mr-1" src="assets/job_logo_5.jpg" alt="" height="30" width="30">
                            <span>Puma Inc. PH</span>
                        </span>

                        <div class="dropdown-menu dropdown-menu-right mt-3 mt-lg-0">

                            <a class="dropdown-item" href="employer_information.html">
                                <span class="pr-4">
                                    <div class="user-nav-icon">
                                        <i class="fas fa-list"></i>
                                    </div>
                                    <span class="pl-1">Information</span>
                                </span>
                            </a>

                            <a class="dropdown-item d-flex justify-content-between align-items-center" href="posted_jobs.html">
                                <span class="pr-5">
                                    <div class="user-nav-icon">
                                        <i class="fas fa-file-contract"></i>
                                    </div>
                                    <span class="pl-1">Posted Jobs</span>
                                </span>
                                <span class="badge badge-primary">12</span>
                            </a>

                            <a class="dropdown-item d-flex justify-content-between align-items-center" href="employer_notifications.html">
                                <span class="pr-5">
                                    <div class="user-nav-icon">
                                        <i class="fas fa-bell"></i>
                                    </div>
                                    <span class="pl-1">Notifications</span>
                                </span>
                                <span class="badge badge-primary">12</span>
                            </a>

                            <a class="dropdown-item" href="employer_settings.html">
                                <span class="pr-5">
                                    <div class="user-nav-icon">
                                        <i class="fas fa-cogs"></i>
                                    </div>
                                    <span class="pl-1">Settings</span>
                                </span>
                            </a>

                            <div class="dropdown-divider"></div>

                            <div class="px-3">
                                <button type="submit" class="btn btn-danger btn-block btn-sm"  data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span>Log out</span>
                                </button>
                            </div>

                        </div>

                    </li>
                    <!-- END OF EMPLOYER USER CONTROL -->


                </ul>
            </div>
            <!-- END OF NAVBAR LINKS -->

        </div>
    </div>
</nav>