<!-- EDIT IMAGE MODAL -->
<div class="modal fade user-select-none" id="editImageModal" tabindex="-1" data-backdrop="static" data-keyboard="false" >
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">

    <div class="modal-header align-items-center">
        <h5 class="modal-title text-primary">
            <i class="fas fa-crop mr-2"></i>
            <span>Edit image</span>
        </h5>
    </div>

    <div class="modal-body">
        <p>Please select an image</p>
        <div class="d-flex justify-content-center" id="profilePic">
            <?php 
                if ($this->session->userType == 'Jobseeker') {
                    if ($profilePic != NULL) {
            ?>
                        <img 
                            class       = "border"
                            src         = "<?php echo base_url() . 'public/img/jobseekers/' . $profilePic ?>" 
                            alt         = "<?php echo $userName ?>" 
                            height      = "350" 
                            class       = "rounded" 
                            draggable   = "false"
                        >
            <?php   } else { ?>
                        <img 
                            class       = "border"
                            src         = "<?php echo base_url() ?>public/img/jobseekers/blank_dp.png" 
                            alt         = "<?php echo $userName ?>" 
                            height      = "350" 
                            class       = "rounded" 
                            draggable   = "false"
                        >
            <?php 
                    }
                } else if ($this->session->userType == 'Employer') {
                    if ($profilePic != NULL) {
            ?>
                        <img 
                            class       = "border"
                            src         = "<?php echo base_url() . 'public/img/employers/' . $profilePic ?>" 
                            alt         = "<?php echo $userName ?>" 
                            height      = "350" 
                            class       = "rounded" 
                            draggable   = "false"
                        >
            <?php   } else { ?>
                        <img 
                            class       = "border"
                            src         = "<?php echo base_url() ?>public/img/employers/blank_dp.png" 
                            alt         = "<?php echo $userName ?>" 
                            height      = "350" 
                            class       = "rounded" 
                            draggable   = "false"
                        >
            <?php
                    }
                }
            ?>
        </div>
        <div class="d-none" id="imageCrop"></div>
        <div class="custom-file mt-2">
            <input 
                type           = "file" 
                class          = "custom-file-input" 
                id             = "selectImgBtn"
                data-toggle    = "tooltip"
                data-placement = "top"
                title          = "Click here to select an image"
            >
            <label class="custom-file-label" for="selectImgBtn">Choose file</label>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="saveCroppedImgBtn" disabled>
            <i class="fas fa-check"></i>
            <span>Save</span>
        </button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close" id="cropImgModalCloseBtn">
            <i class="fas fa-times"></i>
            <span>Close</span>
        </button>
    </div>

</div>
</div>
</div>

<script>
    $(document).ready(function () {

        // INITIALIZE CROPPIE
        bsCustomFileInput.init();
        var imageCrop = $('#imageCrop').croppie({
            enableExif  : true,
            viewport    : {
                width       : 275,
                height      : 275,
                type        : 'square'
            },
            boundary    : {
                width       : 325,
                height      : 325,
            },
            showZoomer: false,
        });

        // ON IMAGE FILE SELECT
        $('#selectImgBtn').on('change', function() {
            var reader = new FileReader();
            reader.onload = function(e) {
                imageCrop.croppie('bind', {
                    url: e.target.result
                }).then(function() {
                    $('#profilePic').removeClass('d-flex justify-content-center');
                    $('#profilePic').addClass('d-none');
                    $('#imageCrop').removeClass('d-none');
                    $('#saveCroppedImgBtn').removeAttr('disabled');
                });
            };
            reader.readAsDataURL(this.files[0]);
        });
        
        // ON SAVE IMAGE
        $('#saveCroppedImgBtn').click(function() {
            $(this).attr("disabled", true);
            $(this).prepend('<span class="spinner-border spinner-border-sm mr-1" role="status" aria-hidden="true"></span>');
            
            imageCrop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function(res) {
                $.ajax({
                    url      : '<?php echo base_url() ?>auth/upload_img',
                    type     : 'post',
                    data     : {'img' : res},
                    success  : function(data) {
                        $('#editImageModal').modal('hide');
                        location.reload();
                    }
                })
            })
        });

    });

    // ON CLOSE BUTTON CLICK
    $('#cropImgModalCloseBtn').click(function() {
        location.reload();
    });
</script>