<div id="main" role="main">
	<div id="content">
		<div class="content-wrapper has-header">
			<?php include_once('../apps/site_admin/layout/messaging.php'); ?>
			<div class="content-header clearfix">
				<h2 class="pull-left">View User</h2>
				<div class="actions pull-right">
					<a href="/site_admin/user/edit/id/<?php echo $user->getId(); ?>" class="btn btn-primary">Edit User</a>
				</div>
			</div>
			<div class="content-body">
				<div class="column-left">
					<div class="block">
						<div class="pad">
							<div class="block-header form-header">
								<h4>Information</h4>
							</div>
							<form class="form-horizontal">
								<div class="control-group">
									<label for="created_at" class="control-label">Created</label>
									<div class="controls">
										<input type="text" disabled="disabled" class="input-block-level" id="created" name="created" value="<?php echo $user->getCreatedAt(); ?>">
									</div>
								</div>
								<div class="control-group">
									<label for="updated_at" class="control-label">Updated</label>
									<div class="controls">
										<input type="text" disabled="disabled" class="input-block-level" id="updated_at" name="updated_at" value="<?php echo $user->getUpdatedAt(); ?>">
									</div>
								</div>
								<div class="control-group">
								</div>
								<div class="control-group">
									<label for="username" class="control-label">Username</label>
									<div class="controls">
										<input type="text" disabled="disabled" class="input-block-level" id="username" value="<?php echo $user->getUsername(); ?>">
									</div>
								</div>
								<div class="control-group">
									<label for="first_name" class="control-label">First Name</label>
									<div class="controls">
										<input type="text" disabled="disabled" class="input-block-level" id="first_name" value="<?php echo $user->getFirstName(); ?>">
									</div>
								</div>
								<div class="control-group">
									<label for="last_name" class="control-label">Last Name</label>
									<div class="controls">
										<input type="text" disabled="disabled" class="input-block-level" id="last_name" value="<?php echo $user->getLastName(); ?>">
									</div>
								</div>
								<div class="control-group">
									<label for="title" class="control-label">Title</label>
									<div class="controls">
										<input type="text" disabled="disabled" class="input-block-level" id="title" value="<?php echo $user->getTitle(); ?>">
									</div>
								</div>
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