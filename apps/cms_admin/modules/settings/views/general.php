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
						<!-- General -->
						<div class="tab-pane active" id="general">
							<form class="editor-form form-horizontal" action="/cms_admin/settings/save_settings/" method="post">
								<h4>General Information</h4>
								<div class="control-group">
									<label class="control-label" for="site_name">Site Name</label>
									<div class="controls">
										<input value="<?php echo isset($setting_values['site_name']) ? $setting_values['site_name'] : ''; ?>" maxlength="<?php echo isset($setting_values['site_name']) ? $setting_keys['site_name']['length'] : ''; ?>" name="settings[site_name]" type="text" class="input-block-level" id="site_name">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="tagline">Tagline</label>
									<div class="controls">
										<input value="<?php echo isset($setting_values['tagline']) ? $setting_values['tagline'] : ''; ?>" maxlength="<?php echo isset($setting_values['tagline']) ? $setting_keys['tagline']['length'] : ''; ?>" name="settings[tagline]" type="text" class="input-block-level" id="tagline">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="phone_number">Phone Number</label>
									<div class="controls">
										<input value="<?php echo isset($setting_values['phone']) ? $setting_values['phone'] : ''; ?>" maxlength="<?php echo isset($setting_values['phone']) ? $setting_keys['phone']['length'] : ''; ?>" name="settings[phone]" type="text" class="input-block-level" id="phone_number">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="public_email">Public Email</label>
									<div class="controls">
										<input value="<?php echo isset($setting_values['email']) ? $setting_values['email'] : ''; ?>" maxlength="<?php echo isset($setting_values['email']) ? $setting_keys['email']['length'] : ''; ?>" name="settings[email]" type="email" class="input-block-level" id="public_email">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="copyright_info">Copyright Information</label>
									<div class="controls">
										<input value="<?php echo isset($setting_values['copyright']) ? $setting_values['copyright'] : ''; ?>" maxlength="<?php echo isset($setting_values['copyright']) ? $setting_keys['copyright']['length'] : ''; ?>" name="settings[copyright]" type="text" class="input-block-level" id="copyright_info">
									</div>
								</div>
								<div class="form-actions">
									<button onclick="form.submit();" class="btn btn-primary save-button" data-loading-text="Saving...">Save Changes</button>
								</div>
								<input type="hidden" name="source" value="general" />
								<input type="hidden" name="posted" value="true" />
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>