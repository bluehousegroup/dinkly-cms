<div class="container">
	<?php include($_SERVER['APPLICATION_ROOT'] . 'apps/cms_admin/layout/messaging.php'); ?>
	<div class="page-header mt-4">
		<h2>
			Design
			<button class="btn btn-info float-right">Save Design</button>
		</h2>	
	</div>
	<hr>
	<form action="" method="post">
		<div class="row">
			<div class="col-md-7">
				<div class="card">
					<div class="card-header">Select a theme</div>
					<div class="card-body d-flex flex-wrap">
						<?php foreach($themes as $theme): ?>
							<div class="card m-3">
								<img class="card-img-top" src="<?php echo $theme->getPreviewImage(); ?>" data-holder-rendered="true">
								<div class="card-body">
									<h5><?php echo $theme->getTitle(); ?></h5>
									<p class="text-muted"><?php echo $theme->getDesc(); ?></p>
									<div class="btn-group btn-group-toggle pr-2" data-toggle="buttons">
										<label class="btn btn-primary <?php echo ($theme_code == $theme->getCode()) ? 'active focus' : ''; ?>">
											<input type="radio" name="themes[]" <?php echo ($theme_code == $theme->getCode()) ? 'checked="checked"' : ''; ?>> Active
										</label>
									</div>
									<button type="button" class="btn btn-secondary">Preview</button>
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
						<div class="form-group">
							<div class="filedrag neat-little-uploader" id="uploader-logo">
								<div class="filedrag-preview-container" style="display: none;">
									<img src="" class="filedrag-preview">
								</div>
								<div class="filedrag-droparea">
									<div class="filedrag-display-filename"></div>
									<div class="filedrag-remove-button">(<button type="button" class="btn btn-xs btn-link filedrag-remove-file">remove</button>)</div>
								</div>
								<div class="filedrag-progress"></div>
								<input type="file" class="filedrag-input" id="file-input" name="file-input">
								<input class="filedrag-input hidden-original" type="hidden" name="logo_original" value="">
								<input class="filedrag-input hidden-new" type="hidden" name="logo_new" value="">
							</div>
						</div>
					</div>
				</div>
				<div class="card mt-4">
					<div class="card-header">Custom CSS</div>
					<div class="card-body">
						<div class="form-group">
							<textarea name="custom_css" class="form-control" rows="8"><?php echo $settings['custom_css']; ?></textarea>
						</div>
					</div>
				</div>
			</div>
		</div>
		<input type="hidden" name="source" value="design">
	</form>
</div>

<script type="text/javascript">
$(function() {	
	initUploader('uploader-logo', '/cms_admin/pages/image_upload');
});
</script>