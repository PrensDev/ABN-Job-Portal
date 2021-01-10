<!-- HERO -->
<div 
    class="container-fluid parallax-window image-overlay text-light py-5" 
    data-parallax="scroll" 
    data-image-src="<?php echo base_url() ?>public/img/hero-bg.jpg"
>
<div class="container-md my-lg-5 py-lg-5">
    
    <h1 class="display-3 mt-0 animate__animated animate__fadeInDown animate__slow">Find your <span class="font-weight-bold">dream job</span> here.</h1>
    <p class="px-1 m-0 h5 font-weight-light animate__animated animate__fadeInDown animate__slow">Search over thousands of our available jobs posted here.</p>

    <!-- SEARCH BAR -->
    <div class="search-bar bg-white mt-5 p-1">
        <form action="<?php echo base_url() . 'jobs/' ?>" method="GET">
        <div class="row">
            
            <!-- KEYWORD FIELD -->
            <div class="col-md-6">
            <div class="input-group">
                <input 
                    class       = "form-control border-0 shadow-none" 
                    type        = "text" 
                    placeholder = "Keyword..." 
                    name        = "keyword">
                <div class="input-group-append">
                    <span class="input-group-text bg-white border-0"><i class="fas fa-search"></i></span>
                </div>
            </div>
            </div>

            <!-- LOCATION FIELD -->
            <div class="col-md-3">
            <div class="input-group">
                <input 
                    type        = "text" 
                    class       = "form-control border-0 shadow-none" 
                    placeholder = "Location..." 
                    name        = "place">
                <div class="input-group-append">
                    <span class="input-group-text bg-white border-0"><i class="fas fa-map-marker-alt"></i></span>
                </div>
            </div>
            </div>

            <!-- SEARCH BUTTON -->
            <div class="col-md-3">
            <button type="submit" class="btn btn-primary btn-block">
                <i class="fas fa-search"></i> 
                <span>Search Now</span>
            </button>
            </div>
            
        </div>
        </form>
    </div>

    <p class="mt-1">
        <p>Type the job keywords you are finding and the place where you want to.</p>
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

    if ($this->session->userType != 'Job Seeker') {
        $this->load->view('sections/post_a_job');
    }

    if ($this->session->userType == 'Job Seeker') {
?>
<script>
    $(document).on('click','#addBookmarkBtn', function(e) {
        e.preventDefault();
        var jobPostID = $(this).attr('value');
        $.ajax({
            url:        "<?php echo base_url() ?>auth/add_bookmark",
            type:       "post",
            dataType:   "json",
            data: {
                jobPostID: jobPostID
            },
            success:    function(data) {
                location.reload();
            } 
        });
    });

    $(document).on('click','#removeBookmarkBtn', function(e) {
        e.preventDefault();
        var bookmarkID = $(this).attr('value');
        $.ajax({
            url:        "<?php echo base_url() ?>auth/remove_bookmark",
            type:       "post",
            dataType:   "json",
            data: {
                bookmarkID: bookmarkID
            },
            success:    function(data) {
                location.reload();
            } 
        });
    });
</script>
<?php } ?>