<div id="main" role="main">
	<div id="content">
		<div class="content-wrapper has-header">
			<?php include_once('../apps/cms_admin/layout/messaging.php'); ?>
			<div class="content-header clearfix">
				<h2 class="pull-left">Design</h2>
				<div class="pull-right">
					<a target="_blank" href="/site/<?php echo $site->getDomain(); ?>" class="btn">View Draft Site</a>
					<a class="btn btn-danger" data-reveal-id="consultform">Request a Custom Design Consultation</a>
				</div>
			</div>
			<div class="content-body scrollable">
				<div class="dashboard-left">
					<div class="block">
						<div class="pad">
							<div class="block-header form-header">
								<?php if(isset($_SESSION['is_super_admin']) || $site->getAllowDesignSwitching()): ?>
								<h4>Pick a Design <button onclick="saveDesign(); return false;" class="btn btn-primary save-button pull-right" data-loading-text="Saving...">Save Choice</button></h4>
								<?php else: ?>
								<h4>Preview Design <a class="btn btn-primary save-button pull-right" data-reveal-id="changeform">Request a Design Change</a></h4>
								<?php endif; ?>
							</div>
							<div class="block-content">
								<ul class="design-picker clearfix">
									<?php foreach($designs as $design): ?>
										<?php if($site->getDomain() == 'fourtopper.com' || $design->getIsPublic() == true): ?>
											<li>
												<a id="<?php echo $design->getCode(); ?>" class="design-select <?php echo ($design->getCode() == $design_code ? 'selected' : ''); ?>" href="#">
													<img src="<?= $design->getPreviewImage(); ?>">
													<h4><?php echo $design->getTitle(); ?></h4>
													<p><?php echo $design->getDesc(); ?></p>
												</a>
											</li>
										<?php endif; ?>
									<?php endforeach; ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="dashboard-right">
					<?php if(isset($_SESSION['is_super_admin'])): ?>
					<div class="block">
						<div class="pad">
							<form action="/cms_admin/design/default_content" method="post">
								<div class="block-header just-header">
									<h4>Default Content <button type="submit" class="btn btn-primary save-logo pull-right">Load Content</button></h4>
								</div>
							</form>
						</div>
					</div>
					<?php endif; ?>
					<div class="block">
						<div class="pad">
							<form class="logo-form" method="post" action="/cms_admin/design/saveLogo" enctype="multipart/form-data">
								<div class="block-header form-header">
									<h4>Upload a Logo <button type="submit" class="btn btn-primary save-logo pull-right">Save Logo</button></h4>
								</div>
								<div class="control-group controls">
									<img class="image-content-image" src="<?php echo ($setting_values['logo_image_thumb_id'] > 0) ? '/cms_admin/pages/display_image/image_id/'.$setting_values['logo_image_thumb_id'] : 'http://placehold.it/148x148/&amp;text=IMAGE';?>">
									<label class="image-filename"></label>
									<span class="btn fileinput-button">
										<i class="icon-plus icon-white"></i>
										<span>Select image</span>
										<input type="file" class="input-image" name="logo">
									</span>
									<?php if($setting_values['logo_image_thumb_id'] > 0): ?>
									<a href="#" class="remove-image btn btn-danger">Remove Image</a>
									<?php endif; ?>
									<input type="hidden" class="hidden-remove-image" name="" value="">
									<input type="hidden" name="posted" value="true">
								</div>
							</form>
						</div>
					</div>
					<div class="block">
						<div class="pad">
							<form>
								<div class="block-header form-header">
									<h4>Add Custom CSS <button onclick="saveCss(); return false;" class="btn btn-primary save-button pull-right" data-loading-text="Saving...">Save Custom CSS</button></h4>
								</div>
								<div class="control-group">
									<label class="control-label">Custom CSS</label>
									<div class="controls">
										<textarea id="site_custom_css" name="site_custom_css" class="input-block-level" rows="8"><?php echo $setting_values['site_custom_css']; ?></textarea>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- New Design Request -->
<div id="changeform" class="reveal-modal">
	<h3>Request a Design Change</h3>
	<p>Your ticket is handled by our well trained staff.</p> 
	<form class="form-vertical"  method="post">
		<div class="control-group">
			<div class="controls">
				<input value="Change my design!" class="input-block-level ticket_subject" type="hidden" id="ticket_subject" placeholder="Subject"/>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<textarea class="input-block-level ticket_message" rows="5" id="ticket_message" placeholder="What design would you like? Any special requests?"></textarea>
			</div>
		</div>
		<a href="#" class="ticket_submit btn" id="ticket_submit">Submit</a>
	</form>
	<a class="close-reveal-modal"><i class="icon icon-remove"></i></a>
</div>

<!-- Consultation Request -->
<div id="consultform" class="reveal-modal">
	<h3>Request a Custom Design Consultation</h3>
	<p>Your ticket is handled by our well trained staff.</p> 
	<form class="form-vertical"  method="post">
		<div class="control-group">
			<div class="controls">
				<input value="Request for Design Consultation" class="ticket_subject input-block-level" type="hidden" id="ticket_subject" placeholder="Subject"/>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<textarea class="input-block-level ticket_message" rows="5" id="ticket_message" placeholder="What sort of design would you like? Any special requests?"></textarea>
			</div>
		</div>
		<a href="#" class="ticket_submit btn" id="ticket_submit">Submit</a>
	</form>
	<a class="close-reveal-modal"><i class="icon icon-remove"></i></a>
</div>
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