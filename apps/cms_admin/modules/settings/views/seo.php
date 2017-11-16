<div id="main" role="main">
	<div id="content">
		<div class="content-wrapper has-header">
			<?php include_once('../apps/cms_admin/layout/messaging.php'); ?>
			<div class="content-header clearfix">
				<h2 class="pull-left">Site Settings</h2>
				<div class="pull-right">
					<a target="_blank" href="/home/draft" class="btn">View Draft Site</a>
				</div>
			</div>
			<div class="body-loader"></div>
			<div class="content-body scrollable">
				<div class="sidebar-left">
					<div class="pad active scrollable">
						<?php include_once('../apps/cms_admin/modules/settings/views/sidebar_nav.php'); ?>
					</div>
				</div>
				<div class="content-editor has-top-actions scrollable">
					<div class="pad">
						<!-- Default SEO -->
						<div class="tab-pane" id="seo">
							<form class="editor-form form-horizontal" action="/cms_admin/settings/save_settings/" method="post">
								<h4>Default Page SEO</h4>
								<div class="control-group">
									<label class="control-label" for="meta_title">Meta Title</label>
									<div class="controls">
										<input value="<?php echo isset($setting_values['meta_title']) ? $setting_values['meta_title'] : ''; ?>" maxlength="<?php echo isset($setting_values['meta_title']) ? $setting_keys['meta_title']['length'] : ''; ?>" name="settings[meta_title]" type="text" class="input-block-level" id="meta_title">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="meta_keywords">Meta Keywords</label>
									<div class="controls">
										<input value="<?php echo isset($setting_keys['meta_keywords']['length']) ? $setting_values['meta_keywords'] : ''; ?>" maxlength="<?php echo isset($setting_keys['meta_keywords']['length']) ? $setting_keys['meta_keywords']['length'] : ''; ?>" name="settings[meta_keywords]" type="text" class="input-block-level" id="meta_keywords">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="meta_description">Meta Description</label>
									<div class="controls">
										<textarea name="settings[meta_description]" class="input-block-level" id="meta_description" rows="5"><?php echo isset($setting_values['meta_description']) ? $setting_values['meta_description'] : ''; ?></textarea>
									</div>
								</div>
								<div class="form-actions">
									<button onclick="form.submit();" class="btn btn-primary save-button" data-loading-text="Saving...">Save Changes</button>
								</div>
								<input type="hidden" name="source" value="seo" />
								<input type="hidden" name="posted" value="true" />
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>