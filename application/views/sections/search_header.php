<!-- HEADER SECTION -->
<div class="container-fluid parallax-window image-overlay py-5 text-white" data-parallax="scroll" data-image-src="<?php echo base_url() ?>public/img/header.jpg">
<div class="container-md py-lg-3">

    <h1 class="display-4 text-white mb-3">Search the job you want here!</h1>
    
    <!-- SEARCH BAR -->
    <div class="search-bar bg-white p-1">
        <form action="<?php echo base_url() ?>jobs/" method="GET">
            <div class="row">

                <div class="col-md-6">
                    <div class="input-group">
                        <input 
                            type        = "text" 
                            class       = "form-control border-0 shadow-none" 
                            placeholder = "Keyword..." 
                            name        = "keyword"
                        >
                        <div class="input-group-append">
                            <span class="input-group-text bg-white border-0"><i class="fas fa-search"></i></span>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="input-group">
                        <input 
                            type        = "text" 
                            class       = "form-control border-0 shadow-none" 
                            placeholder = "Keyword..." 
                            name        = "place"
                        >
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

    <p class="mt-1">
        <p>Type the job keywords you are finding and the place where you want to.</p>
    </p>

</div>
</div>
<!-- END OF HEADER SECTION -->