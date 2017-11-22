<div class="container-fluid viewport-height">
	<div class="row align-items-center viewport-height">
		<div class="col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-4 offset-lg-4">
			<div class="card">
				<h4 class="card-header">Dinkly CMS Site Admin</h4>
				<div class="card-body">
					<?php include_once('../apps/cms_admin/layout/messaging.php'); ?>
					<form method="post" action="">
						<div class="form-group">
							<label for="username">Email</label>
							<div class="controls">
								<input type="text" class="form-control" id="username" name="username" placeholder="Username" value="">
							</div>
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<div class="controls">
								<input type="password" class="form-control" id="password" name="password" placeholder="Password">
							</div>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary">Login</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>