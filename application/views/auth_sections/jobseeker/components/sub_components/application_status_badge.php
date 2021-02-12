<?php if ($this->session->userType == 'Jobseeker' && $status != NULL) {?>
    <div>
        <?php 
            if ($status == 'Pending') { 
                $statusTheme = 'warning';
                $statusTitle = 'Your application is on pending.';        
            } else if ($status == 'Hired') { 
                $statusTheme = 'success';
                $statusTitle = 'You are hired for this job';
            } else if ($status == 'Rejected') {
                $statusTheme = 'dark';
                $statusTitle = 'You are rejected for this job';
            } 
        
            if (isset($statusTheme) && isset($statusTitle)) {
        ?>
            <span 
                class          = "badge badge-<?php echo $statusTheme ?> px-2 py-1" 
                data-toggle    = "tooltip"
                data-placement = "right"
                title          = "<?php echo $statusTitle ?>"
            >
                <?php echo $status ?>
            </span>
        <?php } ?>
    </div>
<?php } ?>
