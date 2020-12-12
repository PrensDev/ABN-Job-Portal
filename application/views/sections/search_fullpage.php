<!-- HEADER SECTION -->
<div class="container-fluid py-5">
<div class="container-md my-5 py-5">

    <h1 class="display-4 mb-3"><span class="text-primary">Search</span> the job you want here!</h1>
    
    <!-- SEARCH BAR -->
    <div class="search-bar border border-secondary p-1">
        <form method="POST">
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
        <a href="#" class="text-secondary">Software Developer</a>, 
        <a href="#" class="text-secondary">Mobile Developer</a>, 
        <a href="#" class="text-secondary">Programmer</a>, 
        <a href="#" class="text-secondary">more...</a>
    </p>

</div>
</div>
<!-- END OF HEADER SECTION -->