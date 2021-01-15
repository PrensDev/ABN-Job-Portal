<!--SETTINGS SECTION -->
<div class="container-fluid pb-5">
<div class="container-md py-5">
    
    <h1 class="font-weight-light mb-4">Settings</h1>
    
    <?php $this->load->view('auth_sections/components/alert') ?>

    <!-- SETTINGS MENU -->
    <div class="card mb-4">
        <div class="card-header">
            <span>Profile Settings</span>
        </div>
        <div class="card-body p-0">
            <div class="list-group list-group-flush">

                <a class="btn list-group-item list-group-item-action" data-toggle="modal" data-target="#editImageModal">
                    <div class="user-nav-icon mr-1 text-primary">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <span>Edit profile picture</span>
                </a>

                <a class="btn list-group-item list-group-item-action" href="<?php echo base_url() ?>auth/edit_information">
                    <div class="user-nav-icon mr-1 text-primary">
                        <i class="fas fa-pen"></i>
                    </div>
                    <span>Edit information</span>
                </a>

            </div>
        </div>
    </div>

    <!-- SETTINGS MENU -->
    <div class="card mb-4">
        <div class="card-header">
            <span>Account Settings</span>
        </div>
        <div class="card-body p-0">
            <div class="list-group list-group-flush">

            <a class="btn list-group-item list-group-item-action" href="<?php echo base_url() ?>auth/login_sessions">
                    <div class="user-nav-icon mr-1 text-primary">
                        <i class="fas fa-dot-circle"></i>
                    </div>
                    <span>View login sessions</span>
                </a>
                
                <a class="btn list-group-item list-group-item-action" href="<?php echo base_url() ?>auth/change_email">
                    <div class="user-nav-icon mr-1 text-primary">
                        <i class="fas fa-at"></i>
                    </div>
                    <span>Change email</span>
                </a>

                <a class="btn list-group-item list-group-item-action" href="<?php echo base_url() ?>auth/change_password">
                    <div class="user-nav-icon mr-1 text-primary">
                        <i class="fas fa-lock"></i>
                    </div>
                    <span>Change password</span>
                </a>

                <a class="btn list-group-item list-group-item-action" data-toggle="modal" data-target="#deactivateModal">
                    <div class="user-nav-icon mr-1 text-primary">
                        <i class="fas fa-user-times"></i>
                    </div>
                    <span>Deactivate my account</span>
                </a>

                <a class="btn list-group-item list-group-item-action" data-toggle="modal" data-target="#logoutModal">
                    <div class="user-nav-icon mr-1 text-primary">
                        <i class="fas fa-sign-out-alt"></i>
                    </div>
                    <span>Log out</span>
                </a>

            </div>
        </div>
    </div>

    <!-- USER CONTROLS -->
    <div class="d-flex justify-content-center my-4">
        <button onclick="history.back()" type="button" class="mx-1 btn btn-secondary">
            <i class="fas fa-arrow-left mr-1"></i>
            <span>Back</span>
        </button>
    </div>
    
</div>
</div>

<?php
    $this->load->view('sections/components/modal', [
        'id'            => 'deactivateModal',
        'centered'      => TRUE,
        'nofade'        => TRUE,
        'theme'         => 'warning',
        'title'         => 'Deactivate Account',
        'modalIcon'     => 'WARNING',
        'message'       => '
            <p class="m-1">Are you sure you want to deactivate your account?</p>
            <p class="m-1"><strong>Note: You can reactivate your account by just logging in again.</strong></p>
        ',
        'actionPath'    => NULL,
        'actionID'      => 'deactivateBtn',
        'actionValue'   => NULL,
        'actionIcon'    => 'user-times',
        'actionLabel'   => 'Deactivate',
    ]);
?>

<script>
    $(document).on('click','#deactivateBtn', function(e) {
        e.preventDefault();
        $.ajax({
            url:  '<?php echo base_url() ?>auth/deactivate',
            type: 'post',
            data: {
                request: 'deactivate'
            },
            success: function() {
                location.assign('<?php echo base_url() ?>');
            } 
        });
    });
</script>