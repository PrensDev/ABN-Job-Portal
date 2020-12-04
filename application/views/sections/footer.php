<!-- FOOTER SECTION -->
<footer class="bg-dark text-white user-select-none">

<!-- MAIN FOOTER CONTENT -->
<div class="container-md py-3">
    <div class="container-fluid">
        <div class="row">

            <!-- NEWSLETTER AND SOCIAL MEDIA LINKS-->
            <div class="col-md py-3">
                <h3 class="font-weight-normal">Newsletter</h3>

                <p>Subscribe to our newsletter to become updated in our events everyday!</p>

                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Enter your email here..." aria-label="Enter your email here..." aria-describedby="button-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button" id="button-addon2">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                </div>

                <h3 class="font-weight-normal my-3">Social Links</h3>

                <a href="https://www.facebook.com/abn" target="_blank" type="button" class="btn btn-brand btn-outline-light" data-toggle="tooltip" data-placement="top" title="Like us on Facebook">
                    <i class="fab fa-facebook-f"></i>
                </a>

                <a href="https://www.twitter.com/abn" target="_blank" type="button" class="btn btn-brand btn-outline-light" data-toggle="tooltip" data-placement="top" title="Follow us on Twitter">
                    <i class="fab fa-twitter"></i>
                </a>

                <a href="https://www.pinterest.com/abn" target="_blank" type="button" class="btn btn-brand btn-outline-light" data-toggle="tooltip" data-placement="top" title="See us at Pinterest">
                    <i class="fab fa-pinterest-p"></i>
                </a>

                <a href="https://www.linkedin.com/abn" target="_blank" type="button" class="btn btn-brand btn-outline-light" data-toggle="tooltip" data-placement="top" title="Search us on LinkedIn">
                    <i class="fab fa-linkedin-in"></i>
                </a>

                <a href="https://www.gmail.com/abn" target="_blank" type="button" class="btn btn-brand btn-outline-light" data-toggle="tooltip" data-placement="top" title="Email us on Google">
                    <i class="fab fa-google-plus-g"></i>
                </a>

            </div>
            <!-- END OF NEWSLETTER AND SOCIAL MEDIA LINKS -->

            <!-- "WHO ARE WE?" -->
            <div class="col-md py-3">
                <h3 class=font-weight-normal>Who are we?</h3>

                <div class="d-flex justify-content-center py-3">
                    <img src="<?php echo base_url() ?>public\img\brand\brand-01.png" alt="ABN Job Portal" class="w-75" draggable="false">
                </div>

                <p class="text-justify">We are ABN teams and our goal is to provide a convinient portal for job seekers and employers.</p>

                <a href="<?php echo base_url() ?>home/about_us" class="btn btn-outline-light btn-sm btn-block">
                    <i class="fas fa-plus-circle"></i>
                    <span>Read More...</span>
                </a>

            </div>
            <!-- END OF "WHO ARE WE?" -->

            <!-- CONTACT INFORMATION -->
            <div class="col-md py-3">
                <h3 class="font-weight-normal">Contact Information</h3>

                <ul class="list-unstyled">

                    <li class="py-1">
                        <div class="d-flex">
                            <div class="list-group-item-icon text-success">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div>
                                <span class="d-block font-weight-bold">Contact Number</span>
                                <span>(+63) 987-654-3210</span>
                            </div>
                        </div>
                    </li>

                    <li class="py-1">
                        <div class="d-flex">
                            <div class="list-group-item-icon text-success">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <span class="d-block font-weight-bold">Location</span>
                                <span>Don Fabian Street, Commonwealth, Quezon City, Philippines</span>
                            </div>
                        </div>
                    </li>

                    <li class="py-1">
                        <div class="d-flex">
                            <div class="list-group-item-icon text-success">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div>
                                <span class="d-block font-weight-bold">Email</span>
                                <span>abn@job-portal.com</span>
                            </div>
                        </div>
                    </li>

                </ul>
            </div>
            <!-- END OF CONTACT INFORMATION -->

        </div>
    </div>
</div>
<!-- END OF MAIN FOOTER CONTENT -->

<!-- BOTTOM FOOTER CONTENT -->
<div class="text-center image-overlay py-3">
    <div class="container-md">
        <div class="container-fluid">
            <div class="d-sm-flex justify-content-center">
                <p class="m-0 mr-sm-1">Copyright &copy; <strong>ABN Job Portal</strong>.</p>
                <p class="m-0">All Rights Received. <?php echo date('Y') ?></p>
            </div>
            <small>
                <a href="<?php echo base_url() ?>home/terms_and_conditions" class="text-light" title="Read our Terms and Conditions">Terms and Conditions</a>
            </small>
        </div>
    </div>
</div>
<!-- END OF BOTTOM FOOTER CONTENT -->

</footer>
<!-- END OF FOOTER SECTION -->