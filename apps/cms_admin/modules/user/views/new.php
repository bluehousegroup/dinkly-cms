<div class="container">
	<?php include($_SERVER['APPLICATION_ROOT'] . 'apps/cms_admin/layout/messaging.php'); ?>
	<div class="page-header mt-4">
		<h2>New User</h2>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="/cms_admin/user/">Users</a></li>
				<li class="breadcrumb-item active" aria-current="page">Create User</li>
			</ol>
		</nav>
	</div>
	<hr>

	<div class="row">
		<div class="col-md-8">
			<?php include('form_user.php'); ?>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('.btn-cancel-user').click(function() {
			window.location = "/cms_admin/user/";
		});
	});
</script>