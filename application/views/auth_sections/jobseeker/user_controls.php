<div>
    <?php if (isset($theme) && isset($modalID) && isset($statusLabel)) { ?>
        <button class="btn btn-block btn-<?php echo $theme ?>" data-toggle="modal" data-target="#<?php echo $modalID ?>">
            <?php echo $statusLabel ?>
        </button>
    <?php } ?>
    
    <?php if (isset($bookmarkID)) { ?>
        <button 
            class       = "btn btn-block border border-warning text-warning" 
            data-toggle = "tooltip" 
            title       = "Click to remove bookmark"
            id          = "removeBookmarkBtn"
        >
            <i class="fas fa-bookmark mr-2"></i>
            <span>Bookmark added</span>
        </button>
    <?php } else { ?>
        <button 
            class       = "btn btn-block border border-warning text-warning" 
            data-toggle = "tooltip" 
            title       = "Click to add bookmark"
            id          = "addBookmarkBtn"
        >
            <i class="far fa-bookmark mr-2"></i>
            <span>Add to bookmark</span>
        </button>
    <?php } ?>
</div>