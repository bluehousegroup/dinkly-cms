<div id="content">
	<div class="content-wrapper no-nav">
		<div class="content-body">
			<div id="login" class="loginform">
				<div class="pad">
					<div  class="block-header form-header" style="text-align: center;">
						<h4><?php echo (!$site->isNew()) ? $site->getName() . ' Site Admin' : Dinkly::getConfigValue('app_name', 'site_admin'); ?></h4>
					</div>
					<?php include_once('../apps/site_admin/layout/messaging.php'); ?>
					<form method="post" action="" class="form-vertical">
						<div class="control-group">
							<label for="domain" class="control-label"></label>
							<div class="controls">
								<input type="text" class="input-block-level" id="domain" name="domain" placeholder="domain.com" value="">
							</div>
						</div>
						<div class="control-group">
							<label for="username" class="control-label"></label>
							<div class="controls">
								<input type="text" class="input-block-level" id="username" name="username" placeholder="Username" value="">
							</div>
						</div>
						<div class="control-group">
							<label for="password" class="control-label"></label>
							<div class="controls">
								<input type="password" class="input-block-level" id="password" name="password" placeholder="Password">
							</div>
						</div>
						<div class="form-actions">
							<button type="submit" class="btn btn-primary">Login</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>