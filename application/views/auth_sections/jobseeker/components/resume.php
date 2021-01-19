<?php
    $lastUpdated = 'Your resume was last updated <strong>' . date_format(date_create($lastUpdated),"F d, Y") . '</strong> at <strong>' . date_format(date_create($lastUpdated),"h:i a.") . '</strong>';
    $statusLabel = $status == 1 ? 'ACTIVE' : 'NOT ACTIVE';
    $statusClass = $status == 1 ? 'success' : 'danger';
?>

<div class="border border-primary p-3 mb-3">
    <p class="mb-0"><?php echo $lastUpdated ?></p>
    <p class="mb-0">This is <strong class="text-<?php echo $statusClass ?>"><?php echo $statusLabel ?></strong>.</p>
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