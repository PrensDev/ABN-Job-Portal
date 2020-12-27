<!-- HEADER -->
<div 
    class="container-fluid py-3 parallax-window image-overlay py-5 user-select-none" 
    data-parallax="scroll" 
    data-image-src="<?php echo base_url() ?>public/img/employer_header.jpg"
>
<div class="container-md text-white">   
<div class="row">

    <!-- COMPANY IMAGE/LOGO -->
    <div class="col-md-auto d-flex justify-content-center">
        <?php 
            if ($profilePic != NULL) {
                echo '
                    <img 
                        src         = "' . base_url() . 'public/img/employers/' . $profilePic . '" 
                        alt         = "" 
                        height      = "125" 
                        class       = "rounded" 
                        draggable   = "false"
                    >
                ';
            } else {
                echo '
                    <img 
                        src         = "' . base_url() . 'public/img/employers/blank_dp.png" 
                        alt         = "" 
                        height      = "125" 
                        class       = "rounded" 
                        draggable   = "false"
                    >
                ';
            }
        ?>
    </div>
    
    <!-- COMPANY INFORMATION -->
    <div class="col-md text-center text-md-left px-0 mt-3 mt-md-0">
        <h1 class="font-weight-light"><?php echo $username ?></h1>
        
        <div class="d-block d-md-flex flex-wrap">
            
            <div class="mr-3">
                <i class="fas fa-map-marker-alt mr-1"></i>
                <span><?php echo $location ?></span>
            </div>

            <div class="mr-3">
                <i class="fas fa-phone-alt mr-1"></i>
                <span><?php echo $contactNumber ?></span>
            </div>

            <div class="mr-3">
                <i class="fas fa-envelope mr-1"></i>
                <span><?php echo $email ?></span>
            </div>

        </div>
        
        <!-- EDIT INFORMATION USER CONTROL -->
        <div class="mt-3">
            <div class="mr-3">
                <small>
                    <a class="text-light" data-toggle="modal" data-target="#editImageModal" id="editInfoBtn">
                        <i class="fas fa-pen mr-1"></i>
                        <span>Edit profile picture</span>
                    </a>
                </small>
            </div>
        </div>
        <!-- END OF EDIT INFORMATION USER CONTROL -->

    </div>
    <!-- END OF COMPANY INFORMATION -->

</div>
</div>
</div>


<!-- CROP IMAGE MODAL -->
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
                if ($profilePic != NULL) {
                    echo '
                        <img 
                            class       = "border"
                            src         = "' . base_url() . 'public/img/employers/' . $profilePic . '" 
                            alt         = "" 
                            height      = "350" 
                            class       = "rounded" 
                            draggable   = "false"
                        >
                    ';
                } else {
                    echo '
                        <img 
                            class       = "border"
                            src         = "' . base_url() . 'public/img/employers/blank_dp.png" 
                            alt         = "" 
                            height      = "350" 
                            class       = "rounded" 
                            draggable   = "false"
                        >
                    ';
                }
            ?>
        </div>
        <div class="d-none" id="imageCrop"></div>
        <div class="custom-file mt-2">
            <input type="file" class="custom-file-input" id="selectImgBtn">
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

        $('#saveCroppedImgBtn').click(function() {
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

    $('#cropImgModalCloseBtn').click(function() {
        location.reload();
    });
</script>