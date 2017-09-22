<div id="main" role="main">
	<div id="content">
		<div class="content-wrapper has-header">
			<?php include_once('../apps/site_admin/layout/messaging.php'); ?>
			<div class="content-header clearfix">
				<h2 class="pull-left">Users</h2>
				<div class="btn-group pull-right">
					<a class="btn btn-primary" href="/site_admin/user/new">Create New User</a>
				</div>
			</div>
			<div class="content-body">
				<div class="results-actions">
					<div class="pad">
						<?php include_once('../apps/site_admin/layout/filters.php'); ?>
					</div>
				</div>
				<div class="results-list scrollable">
					<div class="pad">
						<!-- DATA TABLE -->
						<table class="table dataTables table-striped table-bordered" id="user-list">
							<thead>
								<tr>
									<th><i></i>Username</th>
									<th><i></i>First Name</th>
									<th><i></i>Last Name</th>
									<th><i></i>Created</th>
									<th><i></i>Last Login</th>
									<th><i></i>Login Count</th>
								</tr>
							</thead>
							<tbody>
								<?php if($users): ?>
									<?php foreach($users as $pos => $user): ?>
									<tr>
										<td><a href="/site_admin/user/view/id/<?php echo $user->getId(); ?>"><?php echo $user->getUsername(); ?></a></td>
										<td><?php echo $user->getFirstName(); ?></td>
										<td><?php echo $user->getLastName(); ?></td>
										<td><?php echo $user->getCreatedAt(); ?></td>
										<td><?php echo $user->getLastLoginAt(); ?></td>
										<td><?php echo $user->getLoginCount(); ?></td>
									</tr> 
									<?php endforeach; ?>
								<?php endif; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>