<?php

$headline    = set_value( 'headline'    ) == '' ? $headline    : set_value( 'headline'    );
$description = set_value( 'description' ) == '' ? $description : set_value( 'description' );
$education   = set_value( 'education'   ) == '' ? $education   : set_value( 'education'   );
$skiils      = set_value( 'skiils'      ) == '' ? $education   : set_value( 'skiils'      );
$experiences = set_value( 'experiences' ) == '' ? $experiences : set_value( 'experiences' );
$experiences = set_value( 'experiences' ) == '' ? $experiences : set_value( 'experiences' );

?>

<form method="POST" id="editResumeForm">

<div class="container-fluid py-5 user-select-none">
<div class="container">

    <h1 class="font-weight-light">Edit <span class="text-primary">resume</span></h1>
    <p class="text-secondary">Modify your resume and save your changes.</p>

    <p class="text-danger"><small>* Required</small></p>

    <!-- BASIC INFORMATION FIELD -->
    <div class="card border-0">
        <div class="card-header h6 bg-white border-primary">
            <i class="fas fa-info-circle text-primary mr-2"></i>
            <span>Basic Information</span>
        </div>
        
        <div class="card-body">

            <!-- HEADLINE -->
            <div class="form-group">
                <label for="firstName">Headline</label>
                <span class="text-danger">*</span>
                <input 
                    type        = "text" 
                    class       = "form-control<?php echo form_error('headline') ? ' is-invalid' : '' ;?>" 
                    id          = "headline" 
                    name        = "headline"
                    placeholder = "Headline"
                    value       = "<?php echo $headline?>"    
                >
                <small class="invalid-feedback"><?php echo form_error('headline')?></small>
            </div>

            <!-- DESCRIPTION -->
            <div class="form-group">
                <label for="firstName">Description</label>
                <span class="text-danger">*</span>
                <textarea 
                    type        = "text" 
                    class       = "form-control<?php echo form_error('description') ? ' is-invalid' : '' ;?>" 
                    id          = "description" 
                    name        = "description"
                    rows        = 5
                    placeholder = "Type your description here . . ."
                ><?php echo $description ?></textarea>
                <small class="invalid-feedback"><?php echo form_error('description')?></small>
            </div>
        </div>
    </div>

    <!-- EDUCATION FIELD -->
    <div class="card border-0">
        <div class="card-header h6 bg-white border-primary">
            <i class="fas fa-book text-primary mr-2"></i>
            <span>Education</span>
        </div>
        
        <div class="card-body">

            <!-- EDUCATION -->
            <div class="form-group">
                <label for="firstName">Education</label>
                <span class="text-danger">*</span>
                <textarea 
                    type        = "text" 
                    class       = "form-control<?php echo form_error('education') ? ' is-invalid' : '' ;?>" 
                    id          = "education" 
                    name        = "education"
                    rows        = 5
                    placeholder = "Type about your educational attainments here . . ."
                ><?php echo $education ?></textarea>
                <small class="invalid-feedback"><?php echo form_error('education')?></small>
            </div>
        </div>
    </div>

    <!-- SKILLS FIELD -->
    <div class="card border-0">
        <div class="card-header h6 bg-white border-primary">
            <i class="fas fa-cogs text-primary mr-2"></i>
            <span>Skills</span>
        </div>
        
        <div class="card-body">

            <!-- SKILLS -->
            <div class="form-group">
                <label for="firstName">Skills</label>
                <span class="text-danger">*</span>
                <textarea 
                    type        = "text" 
                    class       = "form-control<?php echo form_error('skills') ? ' is-invalid' : '' ;?>" 
                    id          = "skills" 
                    name        = "skills"
                    rows        = 5
                    placeholder = "Type all your skills here . . ."
                ><?php echo $skills ?></textarea>
                <small class="invalid-feedback"><?php echo form_error('skills')?></small>
            </div>
        </div>
    </div>

    <!-- EXPERIENCES FIELD -->
    <div class="card border-0">
        <div class="card-header h6 bg-white border-primary">
            <i class="fas fa-chart-line text-primary mr-2"></i>
            <span>Experiences</span>
        </div>
        
        <div class="card-body">

            <!-- SKILLS -->
            <div class="form-group">
                <label for="firstName">Experiences</label>
                <span class="text-danger">*</span>
                <textarea 
                    type        = "text" 
                    class       = "form-control<?php echo form_error('experiences') ? ' is-invalid' : '' ;?>" 
                    id          = "experiences" 
                    name        = "experiences"
                    rows        = 5
                    placeholder = "Type all your job experiences here . . ."
                ><?php echo $experiences ?></textarea>
                <small class="invalid-feedback"><?php echo form_error('experiences')?></small>
            </div>
        </div>
    </div>

    <!-- RESUME PRIVACY SETTINGS FIELD -->
    <div class="card border-0">
        <div class="card-header h6 bg-white border-primary">
            <i class="fas fa-circle text-primary mr-2"></i>
            <span>Resume Privacy Settings</span>
        </div>
        
        <div class="card-body">

            <!-- RESUME PRIVACY SETTINGS -->
            <div class="form-group">
                <div class="custom-control custom-switch">
                    <input 
                        type    = "checkbox" 
                        class   = "custom-control-input" 
                        id      = "resumeFlag"
                        name    = "resumeFlag"
                        value   = "1"
                        <?php echo $resumeFlag == 1 ? 'checked' : '' ?>
                    >
                    <label class="custom-control-label text-success font-weight-bold" for="resumeFlag">ACTIVE</label>
                    <p class="text-secondary">Note: If status is not active, you cannot apply to any available job but you can still view and edit your resume.</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- USER CONTROLS -->
    <div class="d-flex justify-content-center my-4">
        <button 
            type  = "submit" 
            class = "mx-1 btn btn-primary"
            id    = "saveBtn"
        >Save</button>
        <a href="<?php echo base_url() ?>auth/profile" class="mx-1 btn btn-secondary">Cancel</a>
    </div>
</div>
</div>
</form>

<script>
$(document).ready(function () {
    $("#editResumeForm").submit(function () {
        var saveBtn = $("#saveBtn");
        saveBtn.attr("disabled", true);
        saveBtn.prepend('<span class="spinner-border spinner-border-sm mr-1" role="status" aria-hidden="true"></span>');
        return true;
    });
});
</script>
