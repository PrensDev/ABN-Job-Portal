<div class="container-fluid">
<div class="container-md py-5">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="font-weight-normal">Information</h1>
        </div>
        <div>
            <a href="<?php echo base_url() ?>auth/edit_information" class="btn btn-primary" data-toggle="tooltip" data-placement="left" title="Edit information">
                <i class="fas fa-pen mr-1"></i>
                <span class="d-none d-sm-inline">Edit information</span>
            </a>
        </div>
    </div>

    <div class="row">
        
        <div class="col-lg-8">
            <div class="mb-3 mb-lg-0">

                <div class="mb-5">
                    <h5 class="text-primary mb-3">
                        <i class="fas fa-book-reader mr-2"></i>  
                        <span>About Me</span> 
                    </h5>
                    <p class="text-justify"><?php echo $description ?></p>
                </div>
    
                <div class="mb-5">
                    <h5 class="text-primary mb-3">
                        <i class="fas fa-chart-line mr-2"></i>  
                        <span>My Experiences</span> 
                    </h5>
                    <p class="text-justify"><?php echo $experiences ?></p>
                </div>

                <div class="mb-5">
                    <h5 class="text-primary mb-3">
                        <i class="fas fa-cogs mr-2"></i>  
                        <span>My Skills</span> 
                    </h5>
                    <p class="text-justify"><?php echo $skills ?></p>

                </div>

                <div class="mb-5">
                    <h5 class="text-primary mb-3">
                        <i class="fas fa-book-reader mr-2"></i>  
                        <span>My Education</span> 
                    </h5>
                    <p class="text-justify"><?php echo $education ?></p>

                </div>

            </div>
        </div>
        
        <div class="col-lg-4">
            
            <!-- GENERAL INFORMATION CARD -->
            <div class="card mb-3">
                <div class="card-header">
                    <strong>
                        <i class="fas fa-user-circle mr-2"></i>
                        <span>Personal Information</span>    
                    </strong>
                </div>
                <div class="card-body p-0">
                    
                    <div class="list-group list-group-flush">

                        <div class="list-group-item d-flex">
                            <div class="list-group-item-icon h4 text-info">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <div>
                                <p class="m-0 font-weight-bold">Gender</p>
                                <p class="m-0 text-secondary"><?php echo $gender ?></p>
                            </div>
                        </div>

                        <div class="list-group-item d-flex">
                            <div class="list-group-item-icon h4 text-info">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div>
                                <p class="m-0 font-weight-bold">Age</p>
                                <p class="m-0 text-secondary"><?php echo $age ?></p>
                            </div>
                        </div>

                        <div class="list-group-item d-flex">
                            <div class="list-group-item-icon h4 text-info">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <p class="m-0 font-weight-bold">Location</p>
                                <p class="m-0 text-secondary"><?php echo $location ?></p>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
            <!-- END OF GENERAL INFORMATION CARD -->

            <!-- CONTACT INFORMATION CARD -->
            <div class="card mb-3">
                <div class="card-header">
                    <strong>
                        <i class="fas fa-phone-square-alt mr-2"></i>
                        <span>Contact Information</span>    
                    </strong>
                </div>
                <div class="card-body p-0">
                    
                    <div class="list-group list-group-flush">

                        <div class="list-group-item d-flex">
                            <div class="list-group-item-icon h4 text-danger">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div>
                                <p class="m-0 font-weight-bold">Contact Number</p>
                                <p class="m-0 text-secondary"><?php echo $contactNumber ?></p>
                            </div>
                        </div>

                        <div class="list-group-item d-flex">
                            <div class="list-group-item-icon h4 text-danger">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div>
                                <p class="m-0 font-weight-bold">Email</p>
                                <p class="m-0 text-secondary"><?php echo $email ?></p>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
            <!-- END OF CONTACT INFORMATION CARD -->

            <!-- USER CONTROLS -->
            <div>
                <button class="btn btn-warning btn-block" data-toggle="modal" data-target="#messageForm">
                    <i class="fas fa-file-contract"></i>
                    <span>View Resume/CV</span>
                </button>
            </div>
            <!-- END OF USER CONTROLS -->

            <!-- MESSAGE FORM MODAL -->
            <div class="modal fade" id="messageForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <form action="">
                            <!-- MODAL HEADER -->
                            <div class="modal-header">
                                <h5 class="modal-title text-primary" id="exampleModalLabel">
                                    <i class="fas fa-envelope"></i>
                                    <span>Send a message to Juan</span>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <!-- MODAL BODY -->
                            <div class="modal-body">

                                <div class="form-group">
                                    <label for="message">Compose a message here:</label>
                                    <textarea name="message" id="message" class="form-control" rows="8" required></textarea>
                                </div>

                            </div>

                            <!-- MODAL FOOTER -->
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">
                                    <span>Send</span>
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- END OF MESSAGE FORM MODAL -->

        </div>

    </div>
    
</div>
</div>