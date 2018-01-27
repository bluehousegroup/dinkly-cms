<div class="container">
	<?php include($_SERVER['APPLICATION_ROOT'] . 'apps/cms_admin/layout/messaging.php'); ?>
	<form action="" method="post">
		<div class="page-header mt-4">
			<h2>
				Design
				<button type="submit" class="btn btn-info float-right">Save Design</button>
			</h2>	
		</div>
		<hr>
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
											<input type="radio" class="theme-toggle" value="<?php echo $theme->getCode(); ?>" name="themes[]" <?php echo ($theme_code == $theme->getCode()) ? 'checked="checked"' : ''; ?>> Active
										</label>
									</div>
									<button type="button" class="btn btn-secondary">Preview</button>
								</div>
							</div>
						<?php endforeach; ?>
						<div class="card m-3">
							<img class="card-img-top" src="" data-holder-rendered="true">
							<div class="card-body">
								<h5>Test</h5>
								<p class="text-muted">Description</p>
								<div class="btn-group btn-group-toggle pr-2" data-toggle="buttons">
									<label class="btn btn-primary ">
										<input type="radio" class="theme-toggle" value="test" name="themes[]"> Active
									</label>
								</div>
								<button type="button" class="btn btn-secondary">Preview</button>
							</div>
						</div>
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
									<img src="" class="filedrag-preview" <?php echo ($settings['logo_background'] == 'light') ? 'style="background-color: #e9ecef"' : 'style="background-color: #808080"';?>>
								</div>
								<div class="background-toggle pb-3" style="display: none;">
									Background: &nbsp;
									<div class="btn-group btn-group-toggle" data-toggle="buttons">
										<label class="btn btn-secondary disabled <?php echo ($settings['logo_background'] == 'light') ? 'active focus' : '';?>">
											<input class="background-toggle" type="radio" name="background_color[]" value="light" <?php echo ($settings['logo_background'] == 'light') ? 'checked="checked"' : '';?>> Light
										</label>
										<label class="btn btn-secondary <?php echo ($settings['logo_background'] == 'dark') ? 'active focus' : '';?>">
											<input class="background-toggle" type="radio" name="background_color[]" value="dark <?php echo ($settings['logo_background'] == 'dark') ? 'checked="checked"' : '';?>"> Dark
										</label>
									</div>
								</div>
								<div class="filedrag-droparea">
									<div class="filedrag-display-filename"></div>
									<div class="filedrag-remove-button">(<button type="button" class="btn btn-xs btn-link filedrag-remove-file">remove</button>)</div>
								</div>
								<div class="filedrag-progress"></div>
								<input type="file" class="filedrag-input" id="file-input" name="file-input">
								<input type="hidden" id="logo-image-id" name="logo_image_id" value="<?php echo $settings['logo_image_id']; ?>">
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
	function uploadComplete(response) {
		$('.background-toggle').show();
		$('#logo-image-id').val(response.original_id);
	}

	$(function() {

		$('.background-toggle').on('click', function () {
			if($(this).val()) {
				$.ajax({
					type: "POST",
					url: '/cms_admin/design/update_logo_background/', 
					data: { background: $(this).val() }
				});

				if($(this).val() == 'light') {
					$('.filedrag-preview').css({"background-color": "#e9ecef" });	
				}
				else {
					$('.filedrag-preview').css({"background-color": "#808080" });
				}
			}
		});

		initUploader('uploader-logo', '/cms_admin/pages/image_upload', 'uploadComplete');
	});
</script>