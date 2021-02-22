<!-- NOTIFICATIONS SECTION -->
<div class="container-fluid">
<div class="container-md py-5">
    
    <div class="mb-4">
        <h1 class="font-weight-light mb-2">Notifications</h1>
        <div class="text-secondary d-sm-flex justify-content-between">
            <p class="m-0">You have <strong></strong> unread notifications.</p>
            <?php if ($totalPages > 1) {  ?>
                <p class="m-0">Showing page <?php echo $currentPage ?> of <?php echo $totalPages ?>.</p>
            <?php } ?>
        </div>
    </div>

    <!-- JOB LIST -->
    <div class="list-group my-3 animate__animated animate__fadeIn animate__faster">
        <?php foreach ( $notifications as $notification ) { $this->load->view('auth_sections/jobseeker/components/notification_bar', $notification); } ?>
    </div>

    <?php echo $this->pagination->create_links(); ?>

</div>
</div>


<script>
    // ON VIEW BUTTON IS CLICKED
    $(document).on('click','#viewNotificationBtn', function(e) {
        e.preventDefault();
        var notificationID = $(this).attr('value');
        var link = $(this).attr('href');
        $.ajax({
            url:        "<?php echo base_url() ?>auth/set_notification_readflag",
            type:       "post",
            dataType:   "json",
            data: {
                notificationID: notificationID,
                readFlag: 1
            },
            success:    function(data) {
                window.location = link
            } 
        });
    });
</script>

<script>
    // MARK AS READ
    $(document).on('click','#readNotificationBtn', function(e) {
        e.preventDefault();
        var notificationID = $(this).attr('value');
        $.ajax({
            url:        "<?php echo base_url() ?>auth/set_notification_readflag",
            type:       "post",
            dataType:   "json",
            data: {
                notificationID: notificationID,
                readFlag: 1
            },
            success:    function(data) {
                location.reload();
            } 
        });
    });
</script>

<script>
    // MARK AS UNREAD
    $(document).on('click','#unreadNotificationBtn', function(e) {
        e.preventDefault();
        var notificationID = $(this).attr('value');
        $.ajax({
            url:        "<?php echo base_url() ?>auth/set_notification_readflag",
            type:       "post",
            dataType:   "json",
            data: {
                notificationID: notificationID,
                readFlag: 0
            },
            success:    function(data) {
                location.reload();
            } 
        });
    });
</script>