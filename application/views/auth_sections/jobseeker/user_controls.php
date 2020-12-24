<div>
    <?php
        if (isset($theme) && isset($modalID) && isset($statusLabel)) {
            echo '
                <button class="btn btn-block btn-' . $theme . '" data-toggle="modal" data-target="#' . $modalID . '">
                    ' . $statusLabel . '
                </button>
            ';
        }
    ?>
    <button class="btn btn-block border border-warning text-warning">
        <i class="far fa-bookmark mr-2"></i>
        <span>Add to bookmark</span>
    </button>
</div>