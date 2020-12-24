<?php
    $element     = isset($actionPath)  ? 'a' : 'button';
    $actionPath  = isset($actionPath)  ? ' href="' . base_url() . $actionPath . '"' : '';
    $actionID    = isset($actionID)    ? ' id="' . $actionID . '"' : '';
    $actionValue = isset($actionValue) ? ' value="' . $actionValue . '"' : '';
    $actionIcon  = isset($actionIcon)  ? '<i class="fas fa-' . $actionIcon . ' mr-1"></i>' : '';
?>

<div class="modal fade user-select-none" id="<?php echo $id ?>" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content">

    <div class="modal-header align-items-center">
        <h5 class="modal-title text-<?php echo $theme ?>">
            <?php echo $actionIcon ?>
            <span><?php echo $title ?></span>
        </h5>
        <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
            <i class="fas fa-times text-dark"></i>
        </button>
    </div>

    <div class="modal-body">
        <div class="d-flex">
            <div class="display-4 mr-2">
                <?php
                    if ($modalIcon == 'INFO') {
                        echo '<i class="fas fa-exclamation-circle text-primary mr-2"></i>';
                    } else if ($modalIcon == 'WARNING') {
                        echo '<i class="fas fa-exclamation-triangle text-warning mr-2"></i>';
                    }
                ?>
                
            </div>
            <div><?php echo $message ?></div>
        </div>
    </div>

    <div class="modal-footer">
        <?php 
            echo '
                <' . $element . $actionPath . $actionID . $actionValue . ' class="btn btn-' . $theme . '" draggable="false">
                    ' . $actionIcon. '
                    <span>' . $actionLabel . '</span>
                </' . $element .'>
            ';
        ?>
        
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
            <i class="fas fa-times mr-1"></i>
            <span>Cancel</span>
        </button>
    </div>

</div>
</div>
</div>