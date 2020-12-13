<!-- JOB LIST SECTION -->
<div class="container-fluid py-5 bg-light">
<div class="container-md">

    <h1 class="font-weight-normal"><?php echo $bodyTitle ?></h1>
    <p class="text-secondary"><?php echo $bodySubtitle ?></p>

    <div class="d-flex justify-content-between">
        <p><?php echo $totalRows ?> match found.</p>
        <p>Showing page <?php echo $currentPage ?> of <?php echo $totalPages ?>.</p>
    </div>

    <div class="row mb-5">
        <?php foreach ($posts as $post) { $this->load->view('sections/components/job_post_card', $post); } ?>
    </div>

    <?php echo $this->pagination->create_links(); ?>

</div>
</div>
<!-- END OF JOB LIST SECTION -->