<div class="modal user-select-none" id="emptyResumeModal" tabindex="-1">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">

    <div class="modal-body text-center py-5">            
        <div class="mb-5">
            <h1>
                <i class="fas fa-exclamation-triangle text-warning"></i>
                <span>Oops!</span>
            </h1>
            <p class="text-danger m-0">You don't have build your resume yet.</p>
            <p class="text-secondary">Click the button below to start creating your resume!</p>
        </div>

        <a href="<?php echo base_url() ?>auth/create_resume" class="btn btn-success" target="_blank">
            <i class="fas fa-pen mr-1"></i>
            <span>Create my resume</span>
        </a>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
            <i class="fas fa-times mr-1"></i>
            <span>Close</span>
        </button>
    </div>

</div>
</div>
</div>