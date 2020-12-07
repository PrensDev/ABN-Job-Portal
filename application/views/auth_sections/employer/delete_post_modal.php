<!-- LOG OUT MODAL -->
<div class="modal fade" id="deletePostModal" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content">

    <div class="modal-header">
        <h5 class="modal-title text-danger">
            <i class="fas fa-trash mr-2"></i>
            <span>Delete this post</span>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="modal-body">
        <i class="fas fa-exclamation-triangle text-warning mr-2"></i>
        <span>Are you sure you want to delete this post?</span>
    </div>

    <div class="modal-footer">
        <a href="<?php echo base_url() ?>auth/delete_post/<?php echo $jobPostID ?>" class="btn btn-danger">
            <i class="fas fa-trash"></i>
            <span>Delete</span>
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