<?php

$sessionStatus = $this->session->has_userdata( 'userType' );

if ( $sessionStatus ) {

    $this->load->view('sections/components/modal', [
        'id'            => 'logoutModal',
        'theme'         => 'danger',
        'title'         => 'Log out',
        'modalIcon'     => 'WARNING',
        'message'       => '<p>Are you sure you want to logout?</p>',
        'actionPath'    => 'auth/logout',
        'actionID'      => NULL,
        'actionValue'   => NULL,
        'actionIcon'    => 'sign-out-alt',
        'actionLabel'   => 'Log out',
    ]);
}

?>

<!-- NAVIGATION BAR -->
<nav class="navbar navbar-expand-md navbar-light bg-white fixed-top shadow" id="navbarTop">
<div class="container-fluid">
<div class="container-md">

    <!-- NAVBAR BRAND -->
    <a class="navbar-brand" href="<?php echo base_url() ?>" title="ABN Job Portal">
        <img src="<?php echo base_url() ?>public/img/brand/brand-01.png" height="30" class="d-inline-block align-top" alt="ABN Job Portal Website"1>
    </a>

    <!-- NAVBAR TOGGLER -->
    <button class="btn btn-light border-0 navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false">
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
                <a class="nav-link" href="<?php echo base_url() ?>jobs">Jobs</a>
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

            <?php 
            
            if ( $sessionStatus ) {
                if( $this->session->userType == 'Job Seeker' ) {
                    $navbarData = [
                        'username'          => $username,
                        'appliedJobsNum'    => $this->Jobseeker_model->applied_jobs_num(),
                    ];

                    $this->load->view('auth_sections/jobseeker/navbar_control', $navbarData);
                } else if( $this->session->userType == 'Employer' ) {
                    $navbarData = [
                        'username' => $username,
                        'postsNum' => $this->Employer_model->posts_num(),
                    ];

                    $this->load->view('auth_sections/employer/navbar_control', $navbarData);
                }
            } else {
                $this->load->view('sections/navbar_components/login_link');
                $this->load->view('sections/navbar_components/register_link');
            }

            ?>
            
        </ul>
    </div>

</div>
</div>
</nav>