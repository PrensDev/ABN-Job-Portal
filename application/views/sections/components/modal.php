<div class="modal fade user-select-none" id="<?php echo $id ?>" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content">

    <div class="modal-header align-items-center py-3">
        <h5 class="modal-title text-<?php echo $theme ?>">
            <i class="fas fa-<?php echo $icon ?> mr-1"></i>
            <span><?php echo $title ?></span>
        </h5>
        <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
            <i class="fas fa-times text-secondary"></i>
        </button>
    </div>

    <div class="modal-body">
        <div class="d-flex">
            <div class="mr-2">
                <i class="fas fa-exclamation-triangle text-warning mr-2"></i>
            </div>
            <div><?php echo $message ?></div>
        </div>
    </div>

    <div class="modal-footer">
        <?php 
            $icon = isset($actionIcon) ? '<i class="fas fa-' . $actionIcon . '"></i>' : '';
            echo '
                <a href="' . base_url() . $actionPath . '" class="btn btn-' . $theme . '" draggable="false">
                    ' . $icon. '
                    <span>' . $actionLabel . '</span>
                </a>
            ';
        ?>
        
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
            <i class="fas fa-times"></i>
            <span>Cancel</span>
        </button>
    </div>

</div>
</div>
</div>