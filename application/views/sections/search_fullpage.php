<!-- HEADER SECTION -->
<div class="container-fluid py-5">
<div class="container-md my-5 py-5">

    <h1 class="display-4 mb-3"><span class="text-primary">Search</span> the job you want here!</h1>
    
    <!-- SEARCH BAR -->
    <div class="search-bar border border-secondary p-1">
        <form method="POST">
            <div class="row">

                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" class="form-control border-0 shadow-none" placeholder="Keyword..." name="jobKeyword">
                        <div class="input-group-append">
                            <span class="input-group-text bg-white border-0"><i class="fas fa-search"></i></span>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="input-group">
                        <input type="text" class="form-control border-0 shadow-none" placeholder="Place..." name="jobKeyword">
                        <div class="input-group-append">
                            <span class="input-group-text bg-white border-0"><i class="fas fa-map-marker-alt"></i></span>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fas fa-search"></i> Search Now
                    </button>
                </div>
                
            </div>

            
        </form>
    </div>
    <!-- END OF SEARCH BAR -->

    <p class="mt-1 text-secondary">
        <p>Type the job keywords you are finding and the place where you want to.</p>
    </p>

    <div class="mt-5 text-center">
        <a href="<?php echo base_url() ?>jobs/recent" class="btn btn-primary">Go to Recent Jobs</a>
    </div>

</div>
</div>
<!-- END OF HEADER SECTION -->