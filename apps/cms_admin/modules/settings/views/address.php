<div id="main" role="main">
	<div id="content">
		<div class="content-wrapper has-header">
			<?php include_once('../apps/cms_admin/layout/messaging.php'); ?>
			<div class="content-header clearfix">
				<h2 class="pull-left">Site Settings</h2>
				<div class="pull-right">
					<a target="_blank" href="/site/<?php echo $site->getDomain(); ?>" class="btn">View Draft Site</a>
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
						<!-- Address/Map -->
						<div class="tab-pane" id="address">
							<form class="editor-form form-horizontal" action="/cms_admin/settings/save_settings/" method="post">
								<h4>Address &amp; Mapping</h4>
								<div class="control-group">
									<label class="control-label" for="street_address">Street Address</label>
									<div class="controls">
										<input value="<?php echo $setting_values['address']; ?>" maxlength="<?php echo $setting_keys['address']['length']; ?>" name="settings[address]" type="text" class="input-block-level" id="street_address">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="city">City</label>
									<div class="controls">
										<input value="<?php echo $setting_values['city']; ?>" maxlength="<?php echo $setting_keys['city']['length']; ?>" name="settings[city]" type="text" class="input-block-level" id="city">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="state">State</label>
									<div class="controls">
										<input value="<?php echo $setting_values['state']; ?>" maxlength="<?php echo $setting_keys['state']['length']; ?>" name="settings[state]" type="text" class="input-block-level" id="state">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="zip_code">Zip Code</label>
									<div class="controls">
										<input value="<?php echo $setting_values['zipcode']; ?>" maxlength="<?php echo $setting_keys['zipcode']['length']; ?>" name="settings[zipcode]" type="text" class="input-block-level" id="zip_code">
									</div>
								</div>
								<div class="form-actions">
									<button onclick="form.submit();" class="btn btn-primary save-button" data-loading-text="Saving...">Save Changes</button>
								</div>
								<input type="hidden" name="source" value="address" />
								<input type="hidden" name="posted" value="true" />
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>