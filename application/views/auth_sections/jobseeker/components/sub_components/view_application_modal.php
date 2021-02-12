<?php $dateApplied = dateFormat($dateApplied,"F d, Y") . ' at ' . dateFormat($dateApplied,"h:i a."); ?>

<div class="modal fade" id="viewApplicationModal" tabindex="-1">
<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
<div class="modal-content">

    <div class="modal-header">
        <div class="mr-1">
            <h3 class="font-weight-normal text-uppercase my-0"><?php echo $jobTitle ?></h3>
            <p class="text-secondary m-0 font-italic my-0">
                <small>You submitted this resume <?php echo $dateApplied ?></small>
            </p>
        </div>
        <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
            <i class="fas fa-times text-secondary"></i>
        </button>
    </div>
    
    <div class="modal-body">
    <div class="mb-3 mb-lg-0 shadow p-md-5 p-3 border">

        <!-- BASIC INFORMATION -->
        <div class="mb-5">
            <h4 class="font-weight-normal"><?php echo $fullName ?></h4>
            <hr class="border-primary">
            <h5 class="mb-2"><?php echo $headline ?></h5>

            <div class="mb-3">
                <p class="mb-0"><?php echo $age . ' years old, ' . $gender ?></p>
                <p class="mb-0"><?php echo $location ?></p>
                <p class="mb-0"><?php echo $contactNumber ?></p>
                <p class="mb-0"><?php echo $email ?></p>
            </div>
            <p><?php echo $description ?></p>
        </div>

        <?php
            $resumeElements = [
                [
                    'icon'      => 'cogs',
                    'element'   => 'Skills',
                    'content'   => $skills,
                ],
                [
                    'icon'      => 'book',
                    'element'   => 'Education',
                    'content'   => $education,
                ],
                [
                    'icon'      => 'chart-line',
                    'element'   => 'Experiences',
                    'content'   => $experiences,
                ],
            ];
        
            foreach ($resumeElements as $resumeElement) {
        ?>
            <div class="mb-5">
                <h6 class="text-primary">
                    <i class="fas fa-<?php echo $resumeElement['icon'] ?> mr-1"></i>  
                    <span><?php echo $resumeElement['element'] ?></span> 
                </h6>
                <hr class="my-2">
                <p><?php echo $resumeElement['content'] ?></p>
            </div>
        <?php } ?>

    </div>
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