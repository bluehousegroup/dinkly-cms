<div class="container">
	<?php include($_SERVER['APPLICATION_ROOT'] . 'apps/cms_admin/layout/messaging.php'); ?>
	<div class="page-header mt-4">
		<h2>
			Design
		</h2>	
	</div>
	<hr>
	<div class="row">
		<div class="col-md-7">
			<div class="card">
				<div class="card-header">Select a design</div>
				<div class="card-body d-flex flex-wrap">
					<?php foreach($designs as $design): ?>
						<div class="card m-3">
							<img class="card-img-top" src="<?php echo $design->getPreviewImage(); ?>" data-holder-rendered="true">
							<div class="card-body">
								<h5><?php echo $design->getTitle(); ?></h5>
								<p class="text-muted"><?php echo $design->getDesc(); ?></p>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<div class="col-md-5">
			<div class="card">
				<div class="card-header">Logo</div>
				<div class="card-body">
					<form class="logo-form" method="post" action="/cms_admin/design/saveLogo" enctype="multipart/form-data">
						<div class="block-header form-header">
							<h4>Upload a Logo</h4>
						</div>
						
					</form>
				</div>
			</div>
			<div class="card mt-4">
				<div class="card-header">Custom CSS</div>
				<div class="card-body">
					<form action="" method="post">
						<div class="block-header form-header">
							<h4>Add Custom CSS <button class="btn btn-primary float-right">Save</button></h4>
						</div>
						<div class="form-group pt-4">
							<textarea name="custom_css" class="form-control" rows="8"><?php echo $settings['site_custom_css']; ?></textarea>
						</div>
						<input type="hidden" name="custom_css">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(function() {
	/******************************************************************************** INITIALIZATION */

	

	/******************************************************************************** EVENTS */

	
});
</script>