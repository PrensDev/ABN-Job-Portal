<!-- NAVIGATION TABS -->
<ul class="nav nav-tabs">
    <li class="nav-item">
        <a 
            class = "btn nav-link<?php echo $statusPage == 'Pending' ? ' active' : '' ?>" 
            id    = "pendingTab"
        >
            <span class="mr-1">Pending</span>
            <?php if ($pendingApplicantsNum > 0) { ?>
                <span class="badge badge-primary"><?php echo $pendingApplicantsNum ?></span>
            <?php } ?>
        </a>
    </li>
    <li class="nav-item">
        <a 
            class = "btn nav-link<?php echo $statusPage == 'Interviewing' ? ' active' : '' ?>" 
            id    = "interviewingTab"
        >
            <span class="mr-1">Interviewing</span>
            <?php if ($interviewingApplicantsNum > 0) { ?>
                <span class="badge badge-primary"><?php echo $interviewingApplicantsNum ?></span>
            <?php } ?>
        </a>
    </li>
    <li class="nav-item">
        <a 
            class = "btn nav-link<?php echo $statusPage == 'Hired' ? ' active' : '' ?>" 
            id    = "hiredTab"
        >
            <span class="mr-1">Hired</span>
            <?php if ($hiredApplicantsNum > 0) { ?>
                <span class="badge badge-primary"><?php echo $hiredApplicantsNum ?></span>
            <?php } ?>
        </a>
    </li>
    <li class="nav-item">
        <a 
            class = "btn nav-link<?php echo $statusPage == 'Rejected' ? ' active' : '' ?>" 
            id    = "rejectedTab"
        >
            <span class="mr-1">Rejected</span>
            <?php if ($rejectedApplicantsNum > 0) { ?>
                <span class="badge badge-primary"><?php echo $rejectedApplicantsNum ?></span>
            <?php } ?>
        </a>
    </li>
</ul>