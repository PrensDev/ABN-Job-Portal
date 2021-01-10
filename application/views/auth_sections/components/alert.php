
<!-- ALERT FOR ACCOUNT AUTHENTICATION -->
<?php if ($this->session->flashdata('account_authentication') == 'no existing account') { ?>
    <div class="alert alert-danger alert-dismissible fade show my-4 mb-4" role="alert">
        <span>This account does <strong>not exist</strong>.</span>
        <button type="button" class="btn close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } else if ($this->session->flashdata('account_authentication') == 'incorrect password') { ?>
    <div class="alert alert-danger alert-dismissible fade show my-4 mb-4" role="alert">
        <span>Incorrect password.</span>
        <button type="button" class="btn close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>


<!-- ALERT FOR UPDATE -->
<?php if ($this->session->flashdata('updated') == 'success') { ?>
    <div class="alert alert-success alert-dismissible fade show my-4 mb-4" role="alert">
        <span>The changes you made has been <strong>saved</strong>.</span>
        <button type="button" class="btn close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } else if ($this->session->flashdata('updated') == 'failed') { ?>
    <div class="alert alert-danger alert-dismissible fade show my-4 mb-4" role="alert">
        <span>Something <strong>wrong</strong> is happened.</span>
        <button type="button" class="btn close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>


<!-- ALERT FOR A ADDED COMPONENT -->
<?php 
    if ($this->session->flashdata('added') == 'success') { 
        if ($this->session->flashdata('component') == 'resume') {
?>
            <div class="alert alert-success alert-dismissible fade show my-4 mb-4" role="alert">
                <span>Your resume has been successfully <strong>added</strong>.</span>
                <button type="button" class="btn close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
<?php   } else if ($this->session->flashdata('component') == 'job post') { ?>
            <div class="alert alert-success alert-dismissible fade show my-4 mb-4" role="alert">
                <span>A job post has been successfully <strong>added</strong>.</span>
                <button type="button" class="btn close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
<?php   
        } 
    } else if ($this->session->flashdata('added') == 'failed') { 
?>
    <div class="alert alert-danger alert-dismissible fade show my-4 mb-4" role="alert">
        <span>Something <strong>wrong</strong> is happened.</span>
        <button type="button" class="btn close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>


<!-- ALERT FOR A REMOVED COMPONENT -->
<?php 
    if ($this->session->flashdata('removed') == 'success') { 
        if ($this->session->flashdata('component') == 'resume') {
?>
            <div class="alert alert-primary alert-dismissible fade show my-4 mb-4" role="alert">
                <span>Your resume has been successfully <strong>removed</strong>.</span>
                <button type="button" class="btn close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
<?php   } else if ($this->session->flashdata('component') == 'job post') { ?>
            <div class="alert alert-primary alert-dismissible fade show my-4 mb-4" role="alert">
                <span>A job post has been <strong>deleted</strong>.</span>
                <button type="button" class="btn close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
<?php   
        } 
    } else if ($this->session->flashdata('removed') == 'failed') { 
?>
    <div class="alert alert-danger alert-dismissible fade show my-4 mb-4" role="alert">
        <span>Something <strong>wrong</strong> is happened.</span>
        <button type="button" class="btn close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>