<div id="main" role="main">
	<div id="content">
		<div class="content-wrapper has-header">
			<?php include_once('../apps/cms_admin/layout/messaging.php'); ?>
			<div class="content-header clearfix">
				<h2 class="pull-left">New User</h2>
				<div class="actions pull-right">
					<div class="btn-group">
						<a href="/super_admin/user/default" class="btn">Cancel</a>
					</div>
				</div>
			</div>
			<div class="content-body scrollable">
				<div class="column-left">
					<div class="block">
						<div class="pad">
							<div class="block-header form-header">
								<h4>Information</h4>
							</div>
							<form class="form-horizontal" method="post">
								<div class="control-group">
									<label for="username" class="control-label">Email*</label>
									<div class="controls">
										<input type="email" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>" maxlength="64" class="input-block-level" name="username" id="username" required>
									</div>
								</div>
								<div class="control-group">
									<label for="password" class="control-label">Password*</label>
									<div class="controls">
										<input type="password" value="<?php echo isset($_POST['password']) ? $_POST['password'] : ''; ?>" maxlength="64" class="input-block-level" name="password" id="password" required>
									</div>
								</div>
								<div class="control-group">
									<label for="first_name" maxlength="24" class="control-label">First Name*</label>
									<div class="controls">
										<input type="text" value="<?php echo isset($_POST['first_name']) ? $_POST['first_name'] : ''; ?>" class="input-block-level" id="first_name" name="first_name" required>
									</div>
								</div>
								<div class="control-group">
									<label for="last_name" maxlength="24" class="control-label">Last Name*</label>
									<div class="controls">
										<input type="text" value="<?php echo isset($_POST['last_name']) ? $_POST['last_name'] : ''; ?>" class="input-block-level" id="last_name" name="last_name" required>
									</div>
								</div>
								<div class="control-group">
									<label for="title" maxlength="24" class="control-label">Title</label>
									<div class="controls">
										<input type="text" value="<?php echo isset($_POST['title']) ? $_POST['title'] : ''; ?>" class="input-block-level" id="title" name="title">
									</div>
								</div>
								<div class="form-actions">
									<button type="submit" class="btn btn-primary">Create User</button>
								</div>
								<input type="hidden" name="posted" value="true" />
							</form>
						</div>
					</div>
				</div>
				<div class="column-right">
				</div>
			</div>
		</div>
	</div>
</div>