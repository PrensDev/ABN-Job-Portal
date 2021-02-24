<?php 

// ALERT FOR ACCOUNT AUTHENTICATION
if ($this->session->flashdata('account_authentication') == 'no existing account') { 
    $flashdata  = 'success';
    $theme      = 'danger';
    $content    = 'This account does <strong>not exist</strong>.';
} else if ($this->session->flashdata('account_authentication') == 'incorrect password') {
    $flashdata  = 'success';
    $theme      = 'danger';
    $content    = 'Incorrect password.';
} 

// ALERT FOR UPDATE
if ($this->session->flashdata('updated') == 'success') { 
    $flashdata  = 'success';
    $theme      = 'success';
    $content    = 'The changes you made has been <strong>saved</strong>.';
} else if ($this->session->flashdata('updated') == 'failed') {
    $flashdata  = 'failed';
}

// ALERT FOR AN ADDED COMPONENT 
if ($this->session->flashdata('added') == 'success') { 
    if ($this->session->flashdata('component') == 'resume') {
        $flashdata  = 'success';
        $theme      = 'success';
        $content    = 'Your resume has been successfully <strong>added</strong>.';
    } else if ($this->session->flashdata('component') == 'job post') { 
        $flashdata  = 'success';
        $theme      = 'success';
        $content    = 'A job post has been successfully <strong>added</strong>.';
    } 
} else if ($this->session->flashdata('added') == 'failed') { 
    $flashdata  = 'failed';
}

// ALERT FOR A REMOVED COMPONENT
if ($this->session->flashdata('removed') == 'success') { 
    if ($this->session->flashdata('component') == 'resume') {
        $flashdata  = 'success';
        $theme      = 'primary';
        $content    = 'Your resume has been successfully <strong>removed</strong>.';
    } else if ($this->session->flashdata('component') == 'job post') {
        $flashdata  = 'success';
        $theme      = 'primary';
        $content    = 'A job post has been <strong>deleted</strong>.';
    } else if ($this->session->flashdata('removed') == 'failed') { 
        $flashdata  = 'failed';
    }
}

// INVALID AGE
if ($this->session->flashdata('invalid') == 'age') { 
    $flashdata  = 'success';
    $theme      = 'danger';
    $content    = 'You must be <strong>18 and above</strong>.';
} 
?>

<!-- ALERT DISPLAY -->
<?php if(isset($flashdata) && $flashdata == 'success') { ?>
    <div class="alert alert-<?php echo $theme ?> alert-dismissible fade show my-4 mb-4" role="alert">
        <span><?php echo $content ?></span>
        <button type="button" class="btn close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } else if(isset($flashdata) && $flashdata == 'failed') { ?>
    <div class="alert alert-danger alert-dismissible fade show my-4 mb-4" role="alert">
        <span>Something <strong>wrong</strong> is happened.</span>
        <button type="button" class="btn close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>