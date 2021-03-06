<!-- POST NEW JOB FORM SECTION -->
<div class="container-fluid">
<div class="container-md py-5">
    
    <!-- FORM SECTION HEADER -->
    <h1 class="font-weight-light">Post new <span class="text-primary">job</span></h1>
    <p class="text-secondary">Compose the job you want to create here.</p>

    <p class="text-danger"><small>* Required</small></p>

    <!-- GENERAL INFORMATION FORM -->
    <form method="POST" id="postJobForm">

        <!-- COMPANY INFORMATION FORM -->
        <div class="card my-4 border-0">

            <div class="card-header h6 bg-white border-primary">
                <i class="fas fa-exclamation-circle text-primary mr-2"></i>
                <span>General Information</span>
            </div>
            
            <div class="card-body">

                <!-- COMPANY NAME -->
                <div class="form-group">
                    <label for="jobTitle">Job Title</label>
                    <span class="text-danger">*</span>
                    <input 
                        type        = "text" 
                        class       = "form-control <?php echo form_error('jobTitle') ? 'is-invalid' : '' ;?>" 
                        id          = "jobTitle"
                        name        = "jobTitle"
                        placeholder = "Job Title" 
                        value       = "<?php echo set_value('jobTitle') ?>"
                    >
                    <small class="invalid-feedback"><?php echo form_error('jobTitle') ?></small>
                </div>

                <!-- JOB TYPE AND FIELD -->
                <div class="form-row">

                    <!-- JOB TYPE -->
                    <div class="form-group col-md">
                        <label for="jobType">Job Type</label>
                        <span class="text-danger">*</span>
                        <select 
                            class       = "selectpicker show-tick form-control border <?php echo form_error('jobType') ? 'is-invalid' : '' ;?>" 
                            title       = "Select job type ..." 
                            data-style  = "btn-white text-dark" 
                            id          = "jobType"
                            name        = "jobType"
                        >
                            <option 
                                value="Full Time" 
                                data-content="<i class='fas fa-user-tie mr-3 text-success'></i>Full Time"
                                <?php echo set_value('jobType') == 'Full Time' ? 'selected' : '' ?>
                            ></option>
                            <option 
                                value="Part Time" 
                                data-content="<i class='fas fa-user-tie mr-3 text-info'></i>Part Time"
                                <?php echo set_value('jobType') == 'Part Time' ? 'selected' : '' ?>
                            ></option>
                            <option 
                                value="Intern/OJT" 
                                data-content="<i class='fas fa-user-tie mr-3 text-warning'></i>Intern/OJT"
                                <?php echo set_value('jobType') == 'Intern/OJT' ? 'selected' : '' ?>
                            ></option>
                            <option 
                                value="Temporary" 
                                data-content="<i class='fas fa-user-tie mr-3 text-secondary'></i>Temporary"
                                <?php echo set_value('jobType') == 'Temporary' ? 'selected' : '' ?>
                            ></option>
                        </select>
                        <small class="invalid-feedback"><?php echo form_error('jobType') ?></small>
                    </div>

                    <!-- FIELD -->
                    <div class="form-group col-md">
                        <label for="field">Field</label>
                        <span class="text-danger">*</span>
                        <input 
                            type        = "text" 
                            class       = "form-control <?php echo form_error('field') ? 'is-invalid' : '' ;?>" 
                            id          = "field"
                            name        = "field"
                            placeholder = "Field"
                            value       = "<?php echo set_value('field') ?>"
                        >
                        <small class="invalid-feedback"><?php echo form_error('field') ?></small>
                    </div>
                    
                </div>

                <!-- OFFERED SALARY FIELD -->
                <div class="form-row">

                    <!-- MINIMUM SALARY -->
                    <div class="form-group col-md">
                        <label for="minSalary">Minimum Offered Salary</label>
                        <span class="text-danger">*</span>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">&#8369;</span>
                            </div>
                            <input 
                                type        = "number" 
                                class       = "form-control <?php echo form_error('minSalary') ? 'is-invalid' : '' ;?>" 
                                id          = "minSalary" 
                                name        = "minSalary" 
                                min         = "1"
                                placeholder = "Minimum Offered Salary"
                                value       = "<?php echo set_value('minSalary') ?>"
                            >
                            <small class="invalid-feedback"><?php echo form_error('minSalary') ?></small>
                        </div>
                    </div>

                    <!-- MAXIMUM SALARY -->
                    <div class="form-group col-md">
                        <label for="maxSalary">Maximum Offered Salary</label>
                        <span class="text-danger">*</span>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">&#8369;</span>
                            </div>
                            <input 
                                type        = "number" 
                                class       = "form-control <?php echo form_error('maxSalary') ? 'is-invalid' : '' ;?>" 
                                id          = "maxSalary" 
                                name        = "maxSalary" 
                                min         = "1"
                                placeholder = "Maximum Offered Salary"
                                value       = "<?php echo set_value('maxSalary') ?>"
                            >
                            <small class="invalid-feedback"><?php echo form_error('maxSalary') ?></small>
                        </div>
                    </div>

                </div>

                <!-- JOB POST FLAG -->
                <div class="form-group">
                    <label>Status</label>
                    <span class="text-danger">*</span>
                    <div class="custom-control custom-switch">
                        <input 
                            type    = "checkbox" 
                            class   = "custom-control-input" 
                            id      = "jobPostFlag"
                            name    = "jobPostFlag"
                            value   = "1"
                            checked
                        >
                        <label class="custom-control-label text-success font-weight-bold" for="jobPostFlag">ACTIVE</label>
                        <p class="text-secondary">Note: If status is not active, this post will never be searched and only you can view this.</p>
                    </div>
                </div>

            </div>

        </div>
        
        <!-- JOB DESCRIPTION FORM -->
        <div class="card my-4 border-0">

            <div class="card-header h6 bg-white border-primary">
                <i class="fas fa-exclamation-circle text-primary mr-2"></i>
                <span>Job Description</span>
            </div>

            <div class="card-body">

                <!-- DESCRIPTION -->
                <div class="form-group">
                    <label for="description">Description</label>
                    <span class="text-danger">*</span>
                    <textarea 
                        class       = "form-control <?php echo form_error('description') ? 'is-invalid' : '' ;?>" 
                        id          = "description" 
                        name        = "description" 
                        rows        = "5"
                        placeholder = "Describe the job you offered here ..."
                    ><?php echo set_value('description') ?></textarea>
                    <small class="invalid-feedback"><?php echo form_error('description') ?></small>
                </div>

                <!-- RESPONSIBILITIES -->
                <div class="form-group">
                    <label for="responsibilities">Responsibilities</label>
                    <span class="text-danger">*</span>
                    <textarea 
                        class       = "form-control <?php echo form_error('responsibilities') ? 'is-invalid' : '' ;?>" 
                        id          = "responsibilities" 
                        name        = "responsibilities" 
                        rows        = "5"
                        placeholder = "List the responsibilities for this job ..."
                    ><?php echo set_value('responsibilities') ?></textarea>
                    <small class="invalid-feedback"><?php echo form_error('responsibilities') ?></small>
                </div>

                <!-- SKILLS SET -->
                <div class="form-group">
                    <label for="skills">Skills Set</label>
                    <span class="text-danger">*</span>
                    <textarea 
                        class       = "form-control <?php echo form_error('skills') ? 'is-invalid' : '' ;?>" 
                        id          = "skills" 
                        name        = "skills" 
                        rows        = "5"
                        placeholder = "List the required skills for this job ..."
                    ><?php echo set_value('skills') ?></textarea>
                    <small class="invalid-feedback"><?php echo form_error('skills') ?></small>
                </div>

                <!-- EXPERIENCES -->
                <div class="form-group">
                    <label for="experiences">Experiences</label>
                    <span class="text-danger">*</span>
                    <textarea 
                        class       = "form-control <?php echo form_error('experiences') ? 'is-invalid' : '' ;?>" 
                        id          = "experiences" 
                        name        = "experiences" 
                        rows        = "5"
                        placeholder = "List the required experiences for this job ..."
                    ><?php echo set_value('experiences') ?></textarea>
                    <small class="invalid-feedback"><?php echo form_error('experiences') ?></small>
                </div>

                <!-- EDUCATION -->
                <div class="form-group">
                    <label for="education">Education</label>
                    <span class="text-danger">*</span>
                    <textarea
                        class       = "form-control <?php echo form_error('education') ? 'is-invalid' : '' ;?>" 
                        id          = "education" 
                        name        = "education" 
                        rows        = "5"
                        placeholder = "List the required education for this job ..."
                    ><?php echo set_value('education') ?></textarea>
                    <small class="invalid-feedback"><?php echo form_error('education') ?></small>
                </div>

            </div>

        </div>

        <!-- USER CONTROLS -->
        <div class="d-flex justify-content-center my-4">
            <button 
                type  = "submit" 
                class = "mx-1 btn btn-primary"
                id    = "postJobBtn"
            >Post This Job</button>
            <button onclick="history.back()" type="button" class="mx-1 btn btn-secondary">Cancel</button>
        </div>

    </form>
    
</div>
</div>

<script>
$(document).ready(function () {
    $("#postJobForm").submit(function () {
        var postJobBtn = $("#postJobBtn");
        postJobBtn.attr("disabled", true);
        postJobBtn.prepend('<span class="spinner-border spinner-border-sm mr-1" role="status" aria-hidden="true"></span>');
        return true;
    });
});
</script>
