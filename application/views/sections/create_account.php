<!-- JOB SEEKER AND EMPLOYER REGISTRATION -->
<div class="container-fluid">
<div class="container-md py-5">

    <h1 class="display-4 text-center">Create your account here!</h1>
    <p class="h5 font-weight-normal text-center text-secondary">Register now to seek thousand opportunities</p>
    
    <div class="row pt-3">

        <div class="col-lg p-3">
        <div class="card pb-3 shadow">
            <img 
                src="<?php echo base_url() ?>public/img/job-seeker2.jpg" 
                alt="Job Seeker Image" 
                class="card-img-top" 
                draggable="false"
            >
            <div class="card-body text-center">
                <p class="h2">Are you a Job Seeker?</p>
                <p>Let us help you to find the job that fits to you</p>
                <a href="<?php echo base_url() ?>home/jobseeker_registration" class="btn btn-primary btn-lg mt-3">Register as JOB SEEKER</a>
            </div>
        </div>
        </div>

        <div class="col-lg py-3">
        <div class="card pb-3 shadow">
            <img 
                src="<?php echo base_url() ?>public/img/employer.jpg" 
                alt="Employer Image" 
                class="card-img-top" 
                draggable="false"
            >
            <div class="card-body text-center">
                <p class="h2">Are you an Employer?</p>
                <p>Find your applicants with us conveniently</p>
                <a href="<?php echo base_url() ?>home/employer_registration" class="btn btn-secondary btn-lg mt-3">Register as EMPLOYER</a>
            </div>
        </div>
        </div>

    </div>
</div>
</div>