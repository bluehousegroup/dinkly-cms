<div class="container">
	<?php include($_SERVER['APPLICATION_ROOT'] . 'apps/cms_admin/layout/messaging.php'); ?>
	<div class="page-header mt-4">
		<h2>
			Site Settings
			<div class="float-md-right">
				<button type="button" class="btn btn-info">Save Settings</button>
			</div>
		</h2>	
	</div>
	<hr>	
	<ul class="nav nav-tabs" id="myTab" role="tablist">
		<li class="nav-item">
			<a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">General</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="seo" aria-selected="false">Contact Info</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" id="analytics-tab" data-toggle="tab" href="#analytics" role="tab" aria-controls="analytics" aria-selected="false">Tracking &amp; Analytics</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" id="seo-tab" data-toggle="tab" href="#seo" role="tab" aria-controls="seo" aria-selected="false">Search Engine Optimization</a>
		</li>
	</ul>
	<div class="container">
		<form action="" method="post" name="settings">
			<div class="tab-content">
				<div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
					<div class="container mt-4">
						<div class="form-row">
							<div class="form-group col-md-5">
								<label>Site Name</label>
								<input value="<?php echo isset($setting_values['site_name']) ? $setting_values['site_name'] : ''; ?>" maxlength="<?php echo isset($setting_values['site_name']) ? $setting_keys['site_name']['length'] : ''; ?>" name="settings[site_name]" type="text" class="form-control" id="site_name">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-8">
								<label>Tagline</label>
								<input value="<?php echo isset($setting_values['tagline']) ? $setting_values['tagline'] : ''; ?>" maxlength="<?php echo isset($setting_values['tagline']) ? $setting_keys['tagline']['length'] : ''; ?>" name="settings[tagline]" type="text" class="form-control" id="tagline">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-5">
								<label>Copyright Information</label>
								<input value="<?php echo isset($setting_values['copyright']) ? $setting_values['copyright'] : ''; ?>" maxlength="<?php echo isset($setting_values['copyright']) ? $setting_keys['copyright']['length'] : ''; ?>" name="settings[copyright]" type="text" class="form-control" id="copyright_info">
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
					<div class="container mt-4">
						<div class="form-row">
							<div class="form-group col-md-3">
								<label>Phone Number</label>
								<input value="<?php echo isset($setting_values['phone']) ? $setting_values['phone'] : ''; ?>" maxlength="<?php echo isset($setting_values['phone']) ? $setting_keys['phone']['length'] : ''; ?>" name="settings[phone]" type="text" class="form-control" id="phone_number">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-4">
								<label>Public Email</label>
								<input value="<?php echo isset($setting_values['email']) ? $setting_values['email'] : ''; ?>" maxlength="<?php echo isset($setting_values['email']) ? $setting_keys['email']['length'] : ''; ?>" name="settings[email]" type="email" class="form-control" id="public_email">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-5">
								<label>Street Address</label>
								<textarea maxlength="<?php echo isset($setting_values['address']) ? $setting_keys['address']['length'] : ''; ?>" name="settings[address]" class="form-control" rows="2"><?php echo isset($setting_values['address']) ? $setting_values['address'] : ''; ?></textarea>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-4">
								<label>City</label>
								<input value="<?php echo isset($setting_values['city']) ? $setting_values['city'] : ''; ?>" maxlength="<?php echo isset($setting_values['city']) ? $setting_keys['city']['length'] : ''; ?>" name="settings[city]" type="text" class="form-control" id="city">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-3">
								<label>State</label>
								<input value="<?php echo isset($setting_values['state']) ? $setting_values['state'] : ''; ?>" maxlength="<?php echo isset($setting_values['state']) ? $setting_keys['state']['length'] : ''; ?>" name="settings[state]" type="text" class="form-control" id="state">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-2">
								<label>Zip Code</label>
								<input value="<?php echo isset($setting_values['zipcode']) ? $setting_values['zipcode'] : ''; ?>" maxlength="<?php echo isset($setting_values['zipcode']) ? $setting_keys['zipcode']['length'] : ''; ?>" name="settings[zipcode]" type="text" class="form-control" id="zip_code">
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="analytics" role="tabpanel" aria-labelledby="analytics-tab">
					<div class="container mt-4">
						<div class="form-row">
							<div class="form-group col-md-4">
								<label>Google Analytics ID</label>
								<input value="<?php echo isset($setting_values['google_analytics_id']) ? $setting_values['google_analytics_id'] : ''; ?>" maxlength="<?php echo $setting_values['google_analytics_id'] ? $setting_keys['google_analytics_id']['length'] : ''; ?>" name="settings[google_analytics_id]" type="text" class="form-control" id="google_analytics_id">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-8">
								<label>Custom Tracking Code</label>
								<textarea name="settings[custom_tracking_code]" class="form-control" id="custom_tracking_code" rows="5"><?php echo isset($setting_values['custom_tracking_code']) ? $setting_values['custom_tracking_code'] : ''; ?></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="seo" role="tabpanel" aria-labelledby="seo-tab">
					<div class="container mt-4">
						<div class="form-row">
							<div class="form-group col-md-5">
								<label>Meta Title</label>
								<input value="<?php echo isset($setting_values['meta_title']) ? $setting_values['meta_title'] : ''; ?>" maxlength="<?php echo isset($setting_values['meta_title']) ? $setting_keys['meta_title']['length'] : ''; ?>" name="settings[meta_title]" type="text" class="form-control" id="meta_title">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-8">
								<label>Meta Keywords</label>
								<textarea maxlength="<?php echo isset($setting_keys['meta_keywords']['length']) ? $setting_keys['meta_keywords']['length'] : ''; ?>" name="settings[meta_description]" class="form-control" id="meta_description" rows="2"><?php echo isset($setting_keys['meta_keywords']['length']) ? $setting_values['meta_keywords'] : ''; ?></textarea>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-8">
								<label>Meta Description</label>
								<textarea name="settings[meta_description]" class="form-control" id="meta_description" rows="5"><?php echo isset($setting_values['meta_description']) ? $setting_values['meta_description'] : ''; ?></textarea>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>