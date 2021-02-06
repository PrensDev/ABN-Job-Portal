<?php if ($this->session->userType == 'Jobseeker' && $status !== NULL) {?>
    <div>
        <?php if ($status == 'Pending') { ?>
            <span class="badge badge-success px-2 py-1" title="Your application is pending.">Pending</span>
        <?php } else if ($status == 'Hired') { ?>
            <span class="badge badge-primary px-2 py-1" title="You are hired for this job.">Hired</span>
        <?php } else if ($status == 'Rejected') { ?>
            <span class="badge badge-danger px-2 py-1" title="You are rejected for this job.">Rejected</span>
        <?php } ?>
    </div>
<?php } ?>
