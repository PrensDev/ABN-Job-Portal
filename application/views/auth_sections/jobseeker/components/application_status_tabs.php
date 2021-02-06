<!-- NAVIGATION TABS -->
<ul class="nav nav-tabs">
    <li class="nav-item">
        <a 
            class = "btn nav-link<?php echo $statusPage == 'Pending' ? ' active' : '' ?>" 
            id    = "pendingTab"
        >
            <span class="mr-1">Pending</span>
            <?php if ($pendingJobsNum > 0) { ?>
                <span class="badge badge-primary"><?php echo $pendingJobsNum ?></span>
            <?php } ?>
        </a>
    </li>
    <li class="nav-item">
        <a 
            class = "btn nav-link<?php echo $statusPage == 'Interviewing' ? ' active' : '' ?>" 
            id    = "interviewingTab"
        >
            <span class="mr-1">Interviewing</span>
            <?php if ($interviewingJobsNum > 0) { ?>
                <span class="badge badge-primary"><?php echo $interviewingJobsNum ?></span>
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
                <span class="badge badge-primary"><?php echo $hiredJobsNum ?></span>
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
                <span class="badge badge-primary"><?php echo $rejectedJobsNum ?></span>
            <?php } ?>
        </a>
    </li>
</ul>