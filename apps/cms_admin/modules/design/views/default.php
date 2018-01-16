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
				<div class="card-body">
					<?php foreach($designs as $design): ?>
						<li>
							<a id="<?php echo $design->getCode(); ?>" class="design-select <?php echo ($design->getCode() == $design_code ? 'selected' : ''); ?>" href="#">
								<img src="<?php echo $design->getPreviewImage(); ?>">
								<h4><?php echo $design->getTitle(); ?></h4>
								<p><?php echo $design->getDesc(); ?></p>
							</a>
						</li>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="card mt-4">
				<div class="card-header">Custom CSS</div>
				<div class="card-body">
					<form>
						<div class="block-header form-header">
							<h4>Add Custom CSS <button onclick="saveCss(); return false;" class="btn btn-primary save-button pull-right" data-loading-text="Saving...">Save Custom CSS</button></h4>
						</div>
						<div class="control-group">
							<label class="control-label">Custom CSS</label>
							<div class="controls">
								<textarea id="site_custom_css" name="site_custom_css" class="input-block-level" rows="8"><?php echo $settings['site_custom_css']; ?></textarea>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-5">
			<div class="card">
				<div class="card-header">Logo</div>
				<div class="card-body">
					<form class="logo-form" method="post" action="/cms_admin/design/saveLogo" enctype="multipart/form-data">
						<div class="block-header form-header">
							<h4>Upload a Logo <button type="submit" class="btn btn-primary save-logo pull-right">Save Logo</button></h4>
						</div>
						<div class="control-group controls">
							<img class="image-content-image" src="<?php echo ($settings['logo_image_thumb_id'] > 0) ? '/cms_admin/pages/display_image/image_id/'.$settings['logo_image_thumb_id'] : 'http://placehold.it/148x148/&amp;text=IMAGE';?>">
							<label class="image-filename"></label>
							<span class="btn fileinput-button">
								<i class="icon-plus icon-white"></i>
								<span>Select image</span>
								<input type="file" class="input-image" name="logo">
							</span>
							<?php if($settings['logo_image_thumb_id'] > 0): ?>
								<a href="#" class="remove-image btn btn-danger">Remove Image</a>
							<?php endif; ?>
							<input type="hidden" class="hidden-remove-image" name="" value="">
							<input type="hidden" name="posted" value="true">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- <div class="block">
	<div class="pad">
		<form>
			<div class="block-header form-header">
				<h4>Add Custom CSS <button onclick="saveCss(); return false;" class="btn btn-primary save-button pull-right" data-loading-text="Saving...">Save Custom CSS</button></h4>
			</div>
			<div class="control-group">
				<label class="control-label">Custom CSS</label>
				<div class="controls">
					<textarea id="site_custom_css" name="site_custom_css" class="input-block-level" rows="8"><?php echo $settings['site_custom_css']; ?></textarea>
				</div>
			</div>
		</form>
	</div>
</div> -->


<script>

	/******************************************************************************** HELPER FUNCTIONS */

//CSS Form - AJAX post of the custom css form
function saveCss() {
	css = $('#site_custom_css').val();
	$.post("/cms_admin/design/save_css/", { site_custom_css: css }, function(msg) {
		$message = $('#hidden-good-message').val(msg);
		displayGoodMessages();
	});
}

//Theme Form - AJAX post of the theme selection form
function saveDesign() {
	code = $('.design-picker').find('.selected').attr('id');
	$.post("/cms_admin/design/save_design/", { design_code: code }, function(msg) {
		$message = $('#hidden-good-message').val(msg);
		displayGoodMessages();
	});
}

$(function() {
	/******************************************************************************** INITIALIZATION */

	//nothing to initialize yet

	/******************************************************************************** EVENTS */

	//Theme Form - changes which design is selected
	$(".design-select").click(function(e) {
		e.preventDefault();
		$(".design-select").removeClass("selected");
		$(this).addClass("selected");
	});

	//Remove image
	$('.remove-image').click(function() {
		$(this).siblings('.hidden-remove-image').val('true');
		$(this).parents('.controls').find('img').fadeOut(function() {
			$(this).remove();
		});

		$(this).fadeOut();

		$(this).parents('.controls').find('.image-filename').html('');

		$('.logo-form').submit();

		return false;
	});


	//Filename handling and validation for image content
	$('.input-image').change(function(){
		var filename = $(this).val();
		//Grab the filename, remove fakepath bs if it's there
		filename = filename.replace("C:\\fakepath\\", "");

		//...and the extension
		var ext = filename.substring(filename.lastIndexOf('.') + 1).toLowerCase();

		//Basic validation
		if(ext != 'jpg' && ext != 'png') {
			$('#hidden-bad-message').val('Valid image formats: JPG, PNG');
			displayBadMessages();
		}
		else {
			//Hide the previous image, if there was one
			$(this).parents('.controls').find('.image-content-image').hide();

			//Good to go, pop the filename into the label
			$(this).parents('.fileinput-button').siblings('.image-filename').html(filename);

			//Display remove button
			$(this).parents('.controls').find('.remove-image').fadeIn();
		}
	});
	
});
</script>