<?php
    $lastUpdated = 'Your resume was last updated <strong>' . dateFormat($lastUpdated,"F d, Y") . '</strong> at <strong>' . dateFormat($lastUpdated,"h:i a.") . '</strong>';
    $statusLabel = $resumeFlag == 1 ? 'ACTIVE' : 'NOT ACTIVE';
    $statusClass = $resumeFlag == 1 ? 'success' : 'danger';
    $statusTitle = 'You ' . ($resumeFlag == 1 ? 'can' : 'can\'t') . ' apply to many jobs.';
?>

<div class="border border-primary p-3 mb-3">
    <p class="mb-0"><?php echo $lastUpdated ?></p>
    <p class="mb-0">This is <strong class="text-<?php echo $statusClass ?>" data-toggle="tooltip" data-placement="top" title="<?php echo $statusTitle ?>"><?php echo $statusLabel ?></strong>.</p>
</div>

<div class="mb-3 mb-lg-0 shadow p-md-5 p-3 border">

    <!-- NASIC INFORMATION -->
    <div class="mb-5">
        <h2 class="font-weight-normal"><?php echo $fullName ?></h2>
        <hr class="border-primary">
        <h5 class="mb-2"><?php echo $headline ?></h5>

        <div class="mb-3">
            <p class="mb-0"><?php echo $age . ' years old, ' . $gender ?></p>
            <p class="mb-0"><?php echo $cityProvince ?></p>
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