<!-- HERO -->
<div class="container-fluid parallax-window image-overlay text-light py-5" data-parallax="scroll" data-image-src="<?php echo base_url() ?>public/img/hero-bg.jpg">
<div class="container-md my-lg-5 py-lg-5">
    
    <h1 class="display-3 mt-0 animate__animated animate__fadeInDown animate__slow">Find your <span class="font-weight-bold">dream job</span> here.</h1>
    <p class="px-1 m-0 h5 font-weight-light animate__animated animate__fadeInDown animate__slow">Search over thousands of our available jobs posted here.</p>

    <!-- SEARCH BAR -->
    <div class="search-bar bg-white mt-5 p-1">
        <form action="" method="POST">
        <div class="row">
            
            <!-- KEYWORD FIELD -->
            <div class="col-lg">
            <div class="input-group">
                <input type="text" class="form-control border-0 shadow-none" placeholder="Keyword..." name="jobKeyword">
                <div class="input-group-append">
                    <span class="input-group-text bg-white border-0"><i class="fas fa-search"></i></span>
                </div>
            </div>
            </div>

            <!-- LOCATION FIELD -->
            <div class="col-lg">
            <div class="input-group">
                <input type="text" class="form-control border-0 shadow-none" placeholder="Location..." name="jobKeyword">
                <div class="input-group-append">
                    <span class="input-group-text bg-white border-0"><i class="fas fa-map-marker-alt"></i></span>
                </div>
            </div>
            </div>

            <!-- JOB TYPE FIELD -->
            <div class="col-lg">
            <select class="selectpicker show-tick border-0 shadow-none form-control bg-white" data-style="btn bg-white text-dark" title="Job Type...">
                <option value="Full Time">Full Time</option>
                <option value="Part Time">Part Time</option>
                <option value="Internship/OJT">Internship/OJT</option>
                <option value="Temporary">Temporary</option>
            </select>
            </div>

            <div class="col-lg">
            <button type="submit" class="btn btn-primary btn-block">
                <i class="fas fa-search"></i> Search Now
            </button>
            </div>
            
        </div>
        </form>
    </div>
    <!-- END OF SEARCH BAR -->

    <p class="mt-1">
        <span class="font-weight-bold">Suggestions: </span>
        <a href="#" class="text-white">Software Developer</a>, 
        <a href="#" class="text-white">Mobile Developer</a>, 
        <a href="#" class="text-white">Programmer</a>, 
        <a href="#" class="text-white">more...</a>
    </p>

</div>
</div>

<?php

    if (! $this->session->has_userdata( 'userType' ) ) {
        $this->load->view('sections/create_account');
    }

    if ($posts != NULL) {
        $this->load->view('sections/recent_posts');
    }

    if ( $this->session->userType != 'Job Seeker' ) {
        $this->load->view('sections/post_a_job');
    }

?>
