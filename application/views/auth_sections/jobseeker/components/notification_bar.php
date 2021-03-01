<!-- NOTIFICATION BAR -->
<div class="list-group-item text-dark text-decoration-none d-flex justify-content-between<?php echo $readFlag == 0 ? ' bg-light' : '' ?>">
    <div>
        <img 
            src       = "<?php echo base_url() ?>public/img/employers/<?php echo $profilePic ?>" 
            class     = "mr-3 border rounded-pill" 
            draggable = "false" 
            height    = "50" 
            width     = "50"
        >
    </div>
    <div class="flex-grow-1 d-block d-md-flex justify-content-between">
        <div>
            <div class="d-flex align-items-center">
                
                <?php if ($readFlag == 0) { ?>
                    <div class="text-primary mr-1">
                        <span data-toggle="tooltip" title="Unread">&#9679;</span>
                    </div>
                <?php } ?>                
                
                <h6 class="mb-0 mr-1"><?php echo $companyName ?></h6>
                <?php $this->load->view('auth_sections/jobseeker/components/sub_components/application_status_badge') ?>
            </div>
            
            <?php 
                switch ($status) {
                    case 'Hired':
                        $message = 'You are hired for a job as ' . $jobTitle . '.';
                        break;
                    case 'Rejected':
                        $message = 'Your application is not approved.';
                        break;
                    default:
                        $message = 'This notification is an error. Please report this bug.';
                        break;
                }
            ?>
            <p class="m-0"><?php echo $message ?></p>
            
            <div class="mt-2">
                <small>January 4, 2020; 5:43 p.m.</small>
            </div>
        </div>
        <div class="mt-2 mt-md-0">
            <a 
                href  = "<?php echo base_url() ?>jobs/details/<?php echo $jobPostID ?>" 
                class = "btn btn-sm btn-primary"
                id    = "viewNotificationBtn"
                value = "<?php echo $notificationID ?>"
            >View</a>

            <?php if ($readFlag == 0) { ?>
                <button 
                    class = "btn btn-sm btn-secondary"
                    id    = "readNotificationBtn"
                    value = "<?php echo $notificationID ?>"
                >Mark as read</button>
            <?php } else { ?>
                <button 
                    class = "btn btn-sm btn-secondary"
                    id    = "unreadNotificationBtn"
                    value = "<?php echo $notificationID ?>"
                >Mark as unread</button>
            <?php } ?>
        </div>
    </div>
</div>

