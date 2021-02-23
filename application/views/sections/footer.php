
<!-- FOOTER SECTION -->
<footer class="bg-dark text-white">

<!-- MAIN FOOTER CONTENT -->
<div class="container-md py-3">
    <div class="container-fluid">
        <div class="row">

            <!-- NEWSLETTER AND SOCIAL MEDIA LINKS-->
            <div class="col-md py-3">
                <h3 class="font-weight-normal">Newsletter</h3>
                <p>Subscribe to our newsletter to become updated in our events everyday!</p>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Enter your email here...">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button" id="button-addon2">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </div>

                <h3 class="font-weight-normal my-3">Social Links</h3>
                <?php
                    $linkElements = [
                        [
                            'link'  => 'https://www.facebook.com/abn-job-portal',
                            'icon'  => 'facebook-f',
                            'title' => 'Like us on Facebook',
                        ],
                        [
                            'link'  => 'https://www.twitter.com/abn-job-portal',
                            'icon'  => 'twitter',
                            'title' => 'Follow us on Twitter',
                        ],
                        [
                            'link'  => 'https://www.pinterest.com/abn-job-portal',
                            'icon'  => 'pinterest-p',
                            'title' => 'See us on Pinterest',
                        ],
                        [
                            'link'  => 'https://www.linkedin.com/abn-job-portal',
                            'icon'  => 'linkedin-in',
                            'title' => 'Seearch us on LinkedIn',
                        ],
                        [
                            'link'  => 'https://www.gmail.com/abn-job-portal',
                            'icon'  => 'google-plus-g',
                            'title' => 'Email us via Gmail',
                        ],
                    ];

                    foreach ($linkElements as $linkElement) {
                ?>
                    <a 
                        href            = "<?php echo $linkElement['link'] ?>" 
                        target          = "_blank" 
                        class           = "btn btn-brand btn-outline-light" 
                        data-toggle     = "tooltip" 
                        data-placement  = "top" 
                        title           = "<?php echo $linkElement['title'] ?>">
                        <i class="fab fa-<?php echo $linkElement['icon'] ?>"></i>
                    </a>
                <?php } ?>
            </div>

            <!-- "WHO ARE WE?" -->
            <div class="col-md py-3">
                <h3 class=font-weight-normal>Who are we?</h3>

                <div class="d-flex justify-content-center py-3">
                    <img src="<?php echo base_url() ?>public\img\brand\brand-01.png" alt="ABN Job Portal" class="w-75" draggable="false">
                </div>

                <p class="text-justify">We are the ABN team and our goal is to provide a convinient portal for job seekers and employers.</p>

                <a href="<?php echo base_url() ?>home/about_us" class="btn btn-outline-light btn-sm btn-block">
                    <i class="fas fa-plus-circle"></i>
                    <span>Read More...</span>
                </a>

            </div>
            
            <div class="col-md py-3">
                <h3 class="font-weight-normal">Contact Information</h3>

                <ul class="list-unstyled">
                    <?php
                        $contactElements = [
                            [
                                'icon'      => 'phone-alt',
                                'element'   => 'Contact Number',
                                'content'   => '(+63) 987-654-3210'
                            ],
                            [
                                'icon'      => 'map-marker-alt',
                                'element'   => 'Location',
                                'content'   => 'Don Fabian Street, Commonwealth, Quezon City, Philippines'
                            ],
                            [
                                'icon'      => 'envelope',
                                'element'   => 'Email',
                                'content'   => 'abn@job-portal.com'
                            ],
                        ];

                        foreach($contactElements as $contactElement) {
                    ?>
                        <li class="py-1 d-flex">
                            <div class="list-group-item-icon text-success">
                                <i class="fas fa-<?php echo $contactElement['icon'] ?>"></i>
                            </div>
                            <div>
                                <span class="d-block font-weight-bold"><?php echo $contactElement['element'] ?></span>
                                <span class="text-light"><?php echo $contactElement['content'] ?></span>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>

        </div>
    </div>
</div>

<!-- BOTTOM FOOTER CONTENT -->
<div class="text-center image-overlay py-3">
<div class="container-md">
<div class="container-fluid">
    <div class="d-sm-flex justify-content-center">
        <p class="m-0 mr-sm-1">Copyright &copy; <strong>ABN Job Portal</strong>.</p>
        <p class="m-0">All Rights Reserved. <?php echo date('Y') ?></p>
    </div>
    <small>
        <a href="<?php echo base_url() ?>home/terms_and_conditions" class="text-light" title="Read our Terms and Conditions">Terms and Conditions</a>
    </small>
</div>
</div>
</div>

</footer>