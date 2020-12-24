<?php

    $appliedJobsNumContent = $appliedJobsNum > 0 ? '<span class="badge badge-primary">' . $appliedJobsNum . '</span>' : '';

?>

<li class="nav-link mx-md-2 nav-item dropdown">
                                
    <span class="d-flex align-items-center" role="button" data-toggle="dropdown">
        <img class="rounded-pill border mr-1" src="<?php echo base_url() ?>public/img/97.jpg" alt="" height="30" width="30">
        <span><?php echo $username ?></span>
    </span>
    
    <div class="dropdown-menu dropdown-menu-right mt-3 mt-lg-0">

        <a class="dropdown-item" href="<?php echo base_url() ?>auth/information">
            <span class="pr-4">
                <div class="user-nav-icon text-secondary">
                    <i class="fas fa-list"></i>
                </div>
                <span class="pl-1">Information</span>
            </span>
        </a>

        <a class="dropdown-item d-flex justify-content-between align-items-center" href="<?php echo base_url() ?>auth/applications">
            <div class="pr-5">
                <div class="user-nav-icon text-secondary">
                    <i class="fas fa-file-contract"></i>
                </div>
                <span class="pl-1">Applications</span>
            </div>
            <?php echo $appliedJobsNumContent ?>
        </a>

        <a class="dropdown-item d-flex justify-content-between align-items-center" href="<?php echo base_url() ?>auth/bookmarks">
            <div class="pr-5">
                <div class="user-nav-icon text-secondary">
                    <i class="fas fa-bookmark"></i>
                </div>
                <span class="pl-1">Bookmarks</span>
            </div>
            <?php echo $appliedJobsNumContent ?>
        </a>

        <a class="dropdown-item" href="jobseeker_notifications.html">
            <div class="user-nav-icon text-secondary">
                <i class="fas fa-bell"></i>
            </div>
            <span class="pl-1">Notifications</span>
        </a>

        <a class="dropdown-item" href="<?php echo base_url() ?>auth/settings">
            <div class="user-nav-icon text-secondary">
                <i class="fas fa-cogs"></i>
            </div>
            <span class="pl-1">Settings</span>
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