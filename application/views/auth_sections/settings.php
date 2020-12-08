<!--SETTINGS SECTION -->
<div class="container-fluid pb-5">
<div class="container-md py-5">
    
    <!-- HEADER OF CONTENT -->
    <div class="mb-4">
        <div>
            <h1 class="font-weight-normal">Settings</h1>
        </div>
    </div>
    <!-- END OF HEADER OF CONTENT -->

    <!-- SUCCESS ALERT BOX -->
    <div class="alert alert-success alert-dismissible fade show my-4" role="alert">
        <span>Your password is successfully <strong>changed</strong>.</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <!-- END OF SUCCESS ALERT BOX -->

    <div class="card border-secondary">
        <div class="card-header h6 bg-secondary text-white">
            <i class="fas fa-user-cog mr-2"></i>
            <span>Account Settings</span>
        </div>
        <div class="card-body p-0">
            <div class="list-group list-group-flush">

                <a class="list-group-item list-group-item-action" href="edit_jobseeker_information.html">
                    <div class="user-nav-icon">
                        <i class="fas fa-pen"></i>
                    </div>
                    <span>Edit information</span>
                </a>

                <a class="list-group-item list-group-item-action" href="<?php echo base_url() ?>auth/change_password">
                    <div class="user-nav-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <span>Change password</span>
                </a>

                <a class="btn list-group-item list-group-item-action" data-toggle="modal" data-target="#deactivateModal">
                    <div class="user-nav-icon">
                        <i class="fas fa-user-times"></i>
                    </div>
                    <span>Deactivate my account</span>
                </a>

                <a class="btn list-group-item list-group-item-action" data-toggle="modal" data-target="#logoutModal">
                    <div class="user-nav-icon">
                        <i class="fas fa-sign-out-alt"></i>
                    </div>
                    <span>Log Out</span>
                </a>

            </div>
        </div>
    </div>

    <!-- USER CONTROLS -->
    <div class="d-flex justify-content-center my-4">
        <button onclick="history.back()" type="button" class="mx-1 btn btn-light">
            <i class="fas fa-arrow-left mr-1"></i>
            <span>Back</span>
        </button>
    </div>
    
</div>
</div>

<?php

$this->load->view('templates/modal', [
    'id'            => 'deactivateModal',
    'theme'         => 'warning',
    'title'         => 'Deactivate account',
    'icon'          => 'user-times',
    'message'       => '
    <p>Are you sure you want to deactivate your account?</p>
        <p><strong>Note: You can reactivate your account by just logging in again.</strong></p>
    ',
    'actionPath'    => 'auth/deactivate',
    'actionLabel'   => 'Deactivate',
    'actionIcon'    => NULL,
]);

?>