<?php
    if ($appliedJobsNum > 0) {
        $appliedJobsNumContent = '
            <span 
                class          = "badge badge-primary" 
                data-toggle    = "tooltip" 
                data-placement = "left" 
                title          = "You submit applications to ' . $appliedJobsNum . ' ' . toPlural('job', $appliedJobsNum) . '."
            >' . $appliedJobsNum . '</span>';
    } else {
        $appliedJobsNumContent = '';
    }

    if ($bookmarksNum > 0) {
        $bookmarksNumContent = '
            <span 
                class          = "badge badge-primary" 
                data-toggle    = "tooltip" 
                data-placement = "left" 
                title          = "You have ' . $bookmarksNum . ' ' . toPlural('bookmark', $bookmarksNum) .'."
            >' . $bookmarksNum . '</span>';
    } else {
        $bookmarksNumContent = '';
    }

    if ($unreadStatusNotificationsNum > 0) {
        $unreadStatusNotificationsNumContent = '
            <span 
                class          = "badge badge-danger" 
                data-toggle    = "tooltip" 
                data-placement = "left" 
                title          = "You have ' . $unreadStatusNotificationsNum . ' ' . toPlural('unread notification', $unreadStatusNotificationsNum) .'."
            >' . $unreadStatusNotificationsNum . '</span>';
    } else {
        $unreadStatusNotificationsNumContent = '';
    }
?>

<li class="nav-link mx-md-2 nav-item dropdown">

    <span class="d-flex align-items-center" role="button" data-toggle="dropdown">
        <?php if (isset($profilePic)) { ?>
            <img 
                class       = "rounded-pill border mr-1" 
                src         = "<?php echo base_url() . 'public/img/jobseekers/' . $profilePic ?>" 
                height      = "30" 
                width       = "30" 
                draggable   = "false"
            >
        <?php } else { ?>
            <img 
                class       = "rounded-pill border mr-1" 
                src         = "<?php echo base_url() ?>public/img/jobseekers/blank_dp.png" 
                height      = "30" 
                width       = "30" 
                draggable   = "false"
            >
        <?php } ?>
        <span class="ml-1"><?php echo $userName ?></span>
    </span>
    
    <div class="dropdown-menu dropdown-menu-right mt-3 mt-lg-0">

        <a class="dropdown-item" href="<?php echo base_url() ?>auth/profile">
            <span class="pr-4">
                <div class="user-nav-icon text-secondary">
                    <i class="fas fa-user-tie"></i>
                </div>
                <span class="pl-1">My Profile</span>
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
            <?php echo $bookmarksNumContent ?>
        </a>

        <a class="dropdown-item d-flex justify-content-between align-items-center" href="<?php echo base_url() ?>auth/notifications">
            <div class="pr-5">
                <div class="user-nav-icon text-secondary">
                    <i class="fas fa-bell"></i>
                </div>
                <span class="pl-1">Notifications</span>
            </div>
            <?php echo $unreadStatusNotificationsNumContent ?>
        </a>

        <a class="dropdown-item" href="<?php echo base_url() ?>auth/settings">
            <div class="user-nav-icon text-secondary">
                <i class="fas fa-cog"></i>
            </div>
            <span class="pl-1">Settings</span>
        </a>

        <div class="dropdown-divider"></div>

        <div class="px-3">
            <button 
                type        = "submit" 
                class       = "btn btn-danger btn-block btn-sm" 
                data-toggle = "modal" 
                data-target = "#logoutModal"
            >
                <i class="fas fa-sign-out-alt"></i>
                <span>Log out</span>
            </button>
        </div>

    </div>

</li>

<?php if ($unreadStatusNotificationsNum > 0) { ?>
    <li class="nav-link-item mx-md-2 nav-item dropdown">
        <a 
            class="nav-link d-flex justify-content-between align-items-center" 
            href="<?php echo base_url() ?>auth/notifications"
            data-toggle     = "tooltip"
            data-placement  = "bottom"
            title           = "You have <?php echo $unreadStatusNotificationsNum ?> unread notifications"
        >
            <i class="fas fa-bell text-secondary"></i>
            <span class="badge badge-danger ml-1"><?php echo $unreadStatusNotificationsNum ?></span>
        </a>
    </li>
<?php } ?>