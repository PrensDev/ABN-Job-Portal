<!-- NAVIGATION TABS -->
<ul class="nav nav-tabs">
    <li class="nav-item">
        <a 
            class = "btn nav-link<?php echo $statusPage == 'Pending' ? ' active' : '' ?>" 
            id    = "pendingTab"
        >
            <span class="mr-1">Pending</span>
            <?php if ($pendingJobsNum > 0) { ?>
                <span 
                    class           = "badge badge-primary"
                    data-toggle     = "tooltip"
                    data-placement  = "top"
                    title           = "You have <?php echo $pendingJobsNum . ' pending ' . toPlural('application', $pendingJobsNum)?>"
                ><?php echo $pendingJobsNum ?></span>
            <?php } ?>
        </a>
    </li>
    <li class="nav-item">
        <a 
            class = "btn nav-link<?php echo $statusPage == 'Hired' ? ' active' : '' ?>" 
            id    = "hiredTab"
        >
            <span class="mr-1">Hired</span>
            <?php if ($hiredJobsNum > 0) { ?>
                <span 
                    class           = "badge badge-primary"
                    data-toggle     = "tooltip"
                    data-placement  = "top"
                    title           = "You are hired to <?php echo $hiredJobsNum . ' ' . toPlural('job', $hiredJobsNum)?>"
                ><?php echo $hiredJobsNum ?></span>
            <?php } ?>
        </a>
    </li>
    <li class="nav-item">
        <a 
            class = "btn nav-link<?php echo $statusPage == 'Rejected' ? ' active' : '' ?>" 
            id    = "rejectedTab"
        >
            <span class="mr-1">Rejected</span>
            <?php if ($rejectedJobsNum > 0) { ?>
                <span 
                    class           = "badge badge-primary"
                    data-toggle     = "tooltip"
                    data-placement  = "top"
                    title           = "You have been rejected for <?php echo $rejectedJobsNum . ' ' . toPlural('job', $rejectedJobsNum)?>"
                ><?php echo $rejectedJobsNum ?></span>
            <?php } ?>
        </a>
    </li>
</ul>