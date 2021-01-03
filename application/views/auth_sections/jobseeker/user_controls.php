<div>
    <?php
        if (isset($theme) && isset($modalID) && isset($statusLabel)) {
            echo '
                <button class="btn btn-block btn-' . $theme . '" data-toggle="modal" data-target="#' . $modalID . '">
                    ' . $statusLabel . '
                </button>
            ';
        }

        if (isset($bookmarkID)) {
            echo '
                <button 
                    class       = "btn btn-block border border-warning text-warning" 
                    data-toggle = "tooltip" 
                    title       = "Click to remove bookmark"
                    id          = "removeBookmarkBtn"
                    value       = "' . $bookmarkID . '"
                >
                    <i class="fas fa-bookmark mr-2"></i>
                    <span>Bookmark added</span>
                </button>
            ';
        } else {
            echo '
                <button 
                    class       = "btn btn-block border border-warning text-warning" 
                    data-toggle = "tooltip" 
                    title       = "Click to add bookmark"
                    id          = "addBookmarkBtn"
                    value       = "' . $jobPostID . '"
                >
                    <i class="far fa-bookmark mr-2"></i>
                    <span>Add to bookmark</span>
                </button>
            ';
        }
    ?>
</div>