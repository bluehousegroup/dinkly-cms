<div class="container">
	<?php include($_SERVER['APPLICATION_ROOT'] . 'apps/cms_admin/layout/messaging.php'); ?>
	<div class="page-header mt-4">
		<h2>
			Users <a href="/cms_admin/user/new/" class="btn btn-primary float-right">Create User</a>
		</h2>
		<hr>
	</div>
	<div class="row">
		<div class="col-md-12">
			<?php if($users != array()): ?>
				<table cellpadding="0" cellspacing="0" border="0"  class="table table-striped table-bordered dinkly-datatable" id="user-list">
					<thead>
						<tr>
							<th>Username</th>
							<th>Created</th>
							<th>Last Login</th>
							<th>Login Count</th>
							<th class="no-sort">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($users as $pos => $user): ?>
							<tr class="<?php echo ($pos % 2 == 0) ? 'odd' : 'even'; ?>">
								<td><?php echo $user->getUsername(); ?></td>
								<td><?php echo $user->getCreatedAt(); ?></td>
								<td><?php echo $user->getLastLoginAt(); ?></td>
								<td><?php echo $user->getLoginCount(); ?></td>
								<td><a href="/cms_admin/user/detail/id/<?php echo $user->getId(); ?>">view</a></td>
							</tr> 
						<?php endforeach; ?>
					</tbody>
				</table>
			<?php else: ?>
				No users to display
			<?php endif; ?>
		</div>
	</div>
</div>