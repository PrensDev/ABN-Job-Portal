<!-- REGISTER LINK -->
<li class="nav-item mx-md-2 dropdown">
    <button
        class       = "btn btn-success btn-block dropdown-toggle" 
        id          = "navbarDropdown" 
        role        = "button" 
        data-toggle = "dropdown" 
    >Register</button>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
        <a class="dropdown-item pr-4" href="<?php echo base_url() ?>user/jobseeker_registration">
            <div class="user-nav-icon">
                <i class="fas fa-users text-secondary"></i>
            </div>
            <span class="pl-1">Register as Job Seeker</span>
        </a>
        <a class="dropdown-item pr-4" href="<?php echo base_url() ?>user/employer_registration">
            <div class="user-nav-icon">
                <i class="fas fa-user-tie text-secondary"></i>
            </div>
            <span class="pl-1">Regsiter as Employer</span>
        </a>
    </div>
</li>