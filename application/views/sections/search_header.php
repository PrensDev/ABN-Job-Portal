<!-- HEADER SECTION -->
<div class="container-fluid parallax-window image-overlay py-5 text-white" data-parallax="scroll" data-image-src="<?php echo base_url() ?>public/img/header.jpg">
<div class="container-md py-lg-3">

    <h1 class="display-4 text-white mb-3">Search the job you want here!</h1>
    
    <!-- SEARCH BAR -->
    <div class="search-bar bg-white p-1">
        <form action="" method="POST">
            <div class="row">

                <div class="col-lg">
                    <div class="input-group">
                        <input type="text" class="form-control border-0 shadow-none" placeholder="Keyword..." name="jobKeyword">
                        <div class="input-group-append">
                            <span class="input-group-text bg-white border-0"><i class="fas fa-search"></i></span>
                        </div>
                    </div>
                </div>

                <div class="col-lg">
                    <div class="input-group">
                        <input type="text" class="form-control border-0 shadow-none" placeholder="Place..." name="jobKeyword">
                        <div class="input-group-append">
                            <span class="input-group-text bg-white border-0"><i class="fas fa-map-marker-alt"></i></span>
                        </div>
                    </div>
                </div>

                <div class="col-lg">
                    <select 
                        class="selectpicker border-0 shadow-none form-control bg-white" 
                        data-style="bg-white text-dark" 
                        title="Job Type...">
                        <option value="">Full Time</option>
                        <option value="">Part Time</option>
                        <option value="">Freelance</option>
                        <option value="">Internship/OJT</option>
                        <option value="">Temporary</option>
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
<!-- END OF HEADER SECTION -->