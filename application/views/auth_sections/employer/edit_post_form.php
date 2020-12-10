<?php

$jobTitle         = set_value( 'jobTitle'         ) == '' ? $jobTitle         : set_value( 'jobTitle'         );
$jobType          = set_value( 'jobType'          ) == '' ? $jobType          : set_value( 'jobType'          );
$industryType     = set_value( 'industryType'     ) == '' ? $industryType     : set_value( 'industryType'     );
$minSalary        = set_value( 'minSalary'        ) == '' ? $minSalary        : set_value( 'minSalary'        );
$maxSalary        = set_value( 'maxSalary'        ) == '' ? $maxSalary        : set_value( 'maxSalary'        );
$description      = set_value( 'description'      ) == '' ? $description      : set_value( 'description'      );
$responsibilities = set_value( 'responsibilities' ) == '' ? $responsibilities : set_value( 'responsibilities' );
$skills           = set_value( 'skills'           ) == '' ? $skills           : set_value( 'skills'           );
$experiences      = set_value( 'experiences'      ) == '' ? $experiences      : set_value( 'experiences'      );
$education        = set_value( 'education'        ) == '' ? $education        : set_value( 'education'        );

?>

<!-- POST NEW JOB FORM SECTION -->
<form method="POST">
<div class="container-fluid">
<div class="container-md py-5">
    

    <!-- FORM SECTION HEADER -->
    <div class="mb-4">
        <h1 class="font-weight-normal">Edit job post</h1>
    </div>
    

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
                    value       = "<?php echo $jobTitle ?>"
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
                            <?php echo $jobType == "Full Time" ? 'selected' : ''?>
                        ></option>
                        <option 
                            value="Part Time" 
                            data-content="<i class='fas fa-circle mr-2 text-info'></i>Part Time" 
                            <?php echo $jobType == "Part Time" ? 'selected' : ''?>
                        ></option>
                        <option 
                            value="Internship/OJT" 
                            data-content="<i class='fas fa-circle mr-2 text-warning'></i>Internship/OJT"
                            <?php echo $jobType == "Internship/OJT" ? 'selected' : ''?>
                        ></option>
                        <option 
                            value="Temporary" 
                            data-content="<i class='fas fa-circle mr-2 text-secondary'></i>Temporary" 
                            <?php echo $jobType == "Temporary" ? 'selected' : ''?>
                        ></option>
                    </select>
                    <small class="invalid-feedback"><?php echo $jobType ?></small>
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
                        value       = "<?php echo $industryType ?>"
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
                            value       = "<?php echo $minSalary ?>"
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
                            value       = "<?php echo $maxSalary ?>"
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
                        <?php echo $status == 1 ? 'checked' : ''?>
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
                ><?php echo $description ?></textarea>
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
                ><?php echo $responsibilities ?></textarea>
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
                ><?php echo $skills ?></textarea>
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
                ><?php echo $experiences ?></textarea>
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
                ><?php echo $education ?></textarea>
                <small class="invalid-feedback"><?php echo form_error('education') ?></small>
            </div>

        </div>

    </div>

    <!-- USER CONTROLS -->
    <div class="d-flex justify-content-center my-4">
        <button type="button" class="mx-1 btn btn-primary" data-toggle="modal" data-target="#saveChangesModal">Save Changes</button>
        <button onclick="history.back()" type="button" class="mx-1 btn btn-secondary">Cancel</button>
    </div>
    
</div>
</div>

<!-- SAVE CHANGES MODAL -->
<div class="modal fade user-select-none" id="saveChangesModal" tabindex="-1">
<div class="modal-dialog">
<div class="modal-content">

    <div class="modal-header">
        <h5 class="modal-title text-primary">
            <i class="fas fa-pen mr-2"></i>
            <span>Save changes</span>
        </h5>
        <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <div class="modal-body">
    <div class="d-flex">
            <div class="mr-2">
                <i class="fas fa-exclamation-triangle text-warning mr-2"></i>
            </div>
            <div>
                <span>Are you sure you want to save this changes?</span>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="sumbit" class="btn btn-primary">
            <i class="fas fa-check"></i>
            <span>Submit</span>
        </button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
            <i class="fas fa-times"></i>
            <span>Cancel</span>
        </button>
    </div>

</div>
</div>
</div>
</form>