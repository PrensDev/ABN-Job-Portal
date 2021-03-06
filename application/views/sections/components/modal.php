<?php
    $element     = isset($actionPath)  ? 'a' : 'button';
    $actionPath  = isset($actionPath)  ? ' href="' . base_url() . $actionPath . '"' : '';
    $actionID    = isset($actionID)    ? ' id="' . $actionID . '"' : '';
    $actionValue = isset($actionValue) ? ' value="' . $actionValue . '"' : '';
    $actionIcon  = isset($actionIcon)  ? '<i class="fas fa-' . $actionIcon . ' mr-1"></i>' : '';
?>

<div class="modal<?php echo isset($nofade) ? '' : ' fade' ?> user-select-none" id="<?php echo $id ?>"<?php echo isset($static) ? ' data-backdrop="static" data-keyboard="false"' : '' ?> tabindex="-1">
<div class="modal-dialog<?php echo isset($centered) ? ' modal-dialog-centered' : ''?>">
<div class="modal-content">

    <div class="modal-header align-items-center">
        <h5 class="modal-title text-<?php echo $theme ?>">
            <?php echo $actionIcon ?>
            <span><?php echo $title ?></span>
        </h5>
        <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
            <i class="fas fa-times text-secondary"></i>
        </button>
    </div>

    <div class="modal-body">
    <div class="d-flex">
        <div class="display-4 mr-2">
            <?php if ($modalIcon == 'INFO') { ?>
                <i class="fas fa-exclamation-circle text-primary mr-2"></i>
            <?php } else if ($modalIcon == 'WARNING') { ?>
                <i class="fas fa-exclamation-triangle text-warning mr-2"></i>
            <?php } ?>
        </div>
        <div><?php echo $message ?></div>
    </div>
    </div>

    <div class="modal-footer border-0">
        <button type="button" class="btn text-secondary" data-dismiss="modal">
            <i class="fas fa-times mr-1"></i>
            <span>Cancel</span>
        </button>
        <?php echo '
            <' . $element . $actionPath . $actionID . $actionValue . ' class="btn btn-' . $theme . '" draggable="false">
                ' . $actionIcon. '
                <span>' . $actionLabel . '</span>
            </' . $element .'>
        '; ?>
    </div>

</div>
</div>
</div>