<?php 
    $customContent = isset($infoElement['customContent']) && $infoElement['customContent'] == true; 
?>

<div class="card mb-3">
    <div 
        class="card-header btn text-left"
        data-toggle = "collapse"
        data-target = "#<?php echo $infoID ?>"
    >
        <strong><?php echo $title ?></strong>
    </div>

    <div class="card-body p-0 collapse show" id="<?php echo $infoID ?>">
    <div class="list-group list-group-flush">
        <?php foreach($infoElements as $infoElement) { ?>
            <div class="list-group-item d-flex border-0">
                <div class="list-group-item-icon h5 text-<?php echo $theme ?>">
                    <i class="fas fa-<?php echo $infoElement['icon'] ?>"></i>
                </div>

                <div>
                    <p class="m-0 font-weight-bold"><?php echo $infoElement['element'] ?></p>
                    
                    <?php if ($customContent) { ?>
                        <?php echo $infoElement['content'] ?>
                    <?php } else { ?>
                        <p class="m-0 text-secondary"><?php echo $infoElement['content'] ?></p>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
    </div>
</div>