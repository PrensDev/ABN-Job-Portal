<!-- HEADER SECTION -->
<div class="container-fluid py-3 bg-light">
<div class="container-md py-lg-3">

    <!-- SEARCH BAR -->
    <div class="search-bar bg-white border border-secondary p-1">
        <form action="<?php echo base_url() ?>jobs/" method="GET">
            <div class="row">

                <div class="col-md-6">
                    <div class="input-group">
                        <input 
                            type        = "text" 
                            class       = "form-control border-0 shadow-none" 
                            placeholder = "Keyword..." 
                            name        = "keyword"
                            value       = "<?php echo $this->input->get('keyword') != NULL ? $this->input->get('keyword') : ''; ?>"
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
                            placeholder = "Location..." 
                            name        = "place"
                            value       = "<?php echo $this->input->get('place') != NULL ? $this->input->get('place') : ''; ?>"
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

</div>
</div>