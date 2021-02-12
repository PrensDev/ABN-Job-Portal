<div class="mb-3">
    <a href="<?php echo base_url() ?>auth/edit_resume" class="btn btn-primary btn-block">
        <i class="fas fa-pen mr-1"></i>
        <span>Edit resume</span>
    </a>
    <button class="btn btn-danger btn-block" data-toggle="modal" data-target="#removeResumeModal">
        <i class="fas fa-trash mr-1"></i>
        <span>Remove resume</span>
    </button>
</div>

<?php
    $this->load->view('sections/components/modal', [
        'id'            => 'removeResumeModal',
        'centered'      => TRUE,
        'nofade'        => TRUE,
        'static'        => TRUE,
        'theme'         => 'danger',
        'title'         => 'Delete Resume',
        'modalIcon'     => 'WARNING',
        'message'       => '
            <p class="m-1">Are you sure you want to remove your resume?</p>
            <p class="m-1"><strong>Note: You can\'t retrieve this and you have to start all over again.</strong></p>
        ',
        'actionPath'    => NULL,
        'actionID'      => 'removeResume',
        'actionValue'   => $resumeID,
        'actionIcon'    => 'trash',
        'actionLabel'   => 'Remove',
    ]);
?>

<script>
    $(document).on('click','#removeResume', function(e) {
        e.preventDefault();
        var resumeID = $(this).attr('value');
        $.ajax({
            url:        "<?php echo base_url() ?>auth/remove_resume",
            type:       "post",
            data: {
                resumeID: resumeID
            },
            success:    function(data) {
                location.reload();
            },
            failed:    function(data) {
                alert('Something error happened')
            } 
        });
    });
</script>