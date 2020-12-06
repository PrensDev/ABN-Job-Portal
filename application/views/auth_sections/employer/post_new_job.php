<!-- APPLICANT PROFILE DETAILS SECTION -->
<div class="container-fluid">
<div class="container-md py-5">
    
    <!-- HEADER OF CONTENT -->
    <div class="mb-4">
        <h1 class="font-weight-normal">Post new job</h1>
    </div>
    <!-- END OF HEADER OF CONTENT -->

    <!-- ERROR ALERT BOX -->
    <div class="alert alert-danger alert-dismissible fade show my-4" role="alert">
        <span>You entered some <strong>invalid</strong> input.</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <!-- END OF ERROR ALERT BOX -->

    <!-- GENERAL INFORMATION FORM -->
    <form method="POST">

        <!-- COMPANY INFORMATION FORM -->
        <div class="card border-secondary my-4">

            <div class="card-header h6 bg-secondary text-white">
                <i class="fas fa-exclamation-circle mr-2"></i>
                <span>General Information</span>
            </div>
            
            <div class="card-body">

                <!-- COMPANY NAME -->
                <div class="form-group">
                    <label for="jobTitle">Job Title</label>
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

                <!-- JOB AND INDUSTRY TYPE FIELD -->
                <div class="form-row">

                    <!-- JOB TYPE -->
                    <div class="form-group col-md">
                        <label for="jobType">Job Type</label>
                        <select 
                            class       = "selectpicker show-tick form-control border <?php echo form_error('industryType') ? 'is-invalid' : '' ;?>" 
                            title       = "Select job type ..." 
                            data-style  = "btn-white text-dark" 
                            id          = "jobType"
                            name        = "jobType"
                        >
                            <option 
                                value="Full Time" 
                                data-content="<i class='fas fa-circle mr-2 text-success'></i>Full Time"
                            ></option>
                            <option 
                                value="Part Time" 
                                data-content="<i class='fas fa-circle mr-2 text-info'></i>Part Time"
                            ></option>
                            <option 
                                value="Internship/OJT" 
                                data-content="<i class='fas fa-circle mr-2 text-warning'></i>Internship/OJT"
                            ></option>
                            <option 
                                value="Temporary" 
                                data-content="<i class='fas fa-circle mr-2 text-secondary'></i>Temporary"
                            ></option>
                        </select>
                        <small class="invalid-feedback"><?php echo form_error('jobType') ?></small>
                    </div>

                    <!-- INDUSTRY TYPE -->
                    <div class="form-group col-md">
                        <label for="industryType">Industry Type</label>
                        <input 
                            type        = "text" 
                            class       = "form-control <?php echo form_error('industryType') ? 'is-invalid' : '' ;?>" 
                            id          = "industryType"
                            name        = "industryType"
                            placeholder = "Industry Type"
                            value       = "<?php echo set_value('industryType') ?>"
                        >
                        <small class="invalid-feedback"><?php echo form_error('industryType') ?></small>
                    </div>
                    
                </div>
                <!-- END OF JOB AND INDUSTRY TYPE FIELD -->

                <!-- OFFERED SALARY FIELD -->
                <div class="form-row">

                    <!-- MINIMUM SALARY -->
                    <div class="form-group col-md">
                        <label for="minSalary">Minimum Offered Salary</label>
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
                        </div>
                        <small class="invalid-feedback"><?php echo form_error('minSalary') ?></small>
                    </div>

                    <!-- MAXIMUM SALARY -->
                    <div class="form-group col-md">
                        <label for="maxSalary">Maximum Offered Salary</label>
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
                        </div>
                        <small class="invalid-feedback"><?php echo form_error('maxSalary') ?></small>
                    </div>

                </div>
                <!-- END OF JOB AND INDUSTRY TYPE FIELD -->


                <!-- STATUS -->
                <div class="form-group">
                    <label>Status</label>
                    <div class="custom-control custom-switch">
                        <input 
                            type    = "checkbox" 
                            class   = "custom-control-input" 
                            id      = "status"
                            name    = "status"
                            value   = "1"
                            checked
                        >
                        <label class="custom-control-label text-success font-weight-bold" for="status">ACTIVE</label>
                    </div>
                </div>


            </div>

        </div>
        <!-- END OF GENERAL INFORMATION FORM -->
        
        <!-- JOB DESCRIPTION FORM -->
        <div class="card border-secondary my-4">

            <div class="card-header h6 bg-secondary text-white">
                <i class="fas fa-exclamation-circle mr-2"></i>
                <span>Job Description</span>
            </div>

            <div class="card-body">

                <!-- DESCRIPTION -->
                <div class="form-group">
                    <label for="description">Description</label>
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
            <button type="submit" class="mx-1 btn btn-primary">Post This Job</button>
            <button onclick="history.back()" type="button" class="mx-1 btn btn-secondary">Cancel</button>
        </div>

    </form>
    
</div>
</div>