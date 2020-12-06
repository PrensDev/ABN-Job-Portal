<!-- LOG OUT MODAL -->
<div class="modal fade" id="logoutModal" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content">

    <div class="modal-header">
        <h5 class="modal-title text-danger">
            <i class="fas fa-sign-out-alt"></i>
            <span>Log out</span>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="modal-body">
        <i class="fas fa-exclamation-triangle text-warning mr-2"></i>
        <span>Are you sure you want to log out?</span>
    </div>

    <div class="modal-footer">
        <a href="<?php echo base_url() ?>auth/logout" class="btn btn-danger">
            <i class="fas fa-sign-out-alt"></i>
            <span>Log out</span>
        </a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
            <i class="fas fa-times"></i>
            <span>Cancel</span>
        </button>
    </div>

</div>
</div>
</div>
<!-- LOG OUT MODAL -->