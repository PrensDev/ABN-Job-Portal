<?php
    $path = $this->session->has_userdata('userType') ? 'auth/post_new_job' : 'home/login';
    $link = base_url() . $path;
?>

<!-- POST A JOB SECTION -->
<div 
    class           = "container-fluid parallax-window image-overlay py-5" 
    data-parallax   = "scroll" 
    data-image-src  = "<?php echo base_url() ?>public/img/pexels-andrea-piacquadio-840996.jpg"
>
<div class="container-md text-center text-light my-5">
    <h1 class="display-4">Want to post a new job?</h1>
    <p class="h5 font-weight-normal">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
    <a href="<?php echo $link ?>" class="btn btn-light btn-lg px-4 py-2 mt-5">Post a job now!</a>
</div>
</div>