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
						<!-- Analytics -->
						<div class="tab-pane" id="tracking">
							<form class="editor-form form-horizontal" action="/cms_admin/settings/save_settings/" method="post">
								<h4>Tracking &amp; Analytics</h4>
								<div class="control-group">
									<label class="control-label" for="google_analytics_id">Google Analytics ID</label>
									<div class="controls">
										<input value="<?php echo isset($setting_values['google_analytics_id']) ? $setting_values['google_analytics_id'] : ''; ?>" maxlength="<?php echo $setting_values['google_analytics_id'] ? $setting_keys['google_analytics_id']['length'] : ''; ?>" name="settings[google_analytics_id]" type="text" class="input-block-level" id="google_analytics_id">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="custom_tracking_code">Custom Tracking Code</label>
									<div class="controls">
										<textarea name="settings[custom_tracking_code]" class="input-block-level" id="custom_tracking_code" rows="5"><?php echo isset($setting_values['custom_tracking_code']) ? $setting_values['custom_tracking_code'] : ''; ?></textarea>
									</div>
								</div>
								<div class="form-actions">
									<button onclick="form.submit();" class="btn btn-primary save-button" data-loading-text="Saving...">Save Changes</button>
								</div>
								<input type="hidden" name="source" value="analytics" />
								<input type="hidden" name="posted" value="true" />
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>