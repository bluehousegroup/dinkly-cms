<!DOCTYPE html>
<html>
<head>
	<title>Dinkly CMS Admin</title>

	<link href="/css/bootswatch-united-4.0.0-beta.3.css" rel="stylesheet">
	<link href="/css/fontawesome-all.5.0.3.min.css" rel="stylesheet">
	<link href="/css/datatables.1.10.16.combined.min.css" rel="stylesheet">
	<link href="/css/dinkly.3.29.css" rel="stylesheet">
	<link href="/css/dinkly-cms.css" rel="stylesheet">

	<script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="/js/bootstrap.4.0.0-beta.3.min.js"></script>
	<script type="text/javascript" src="/js/datatables.1.10.16.combined.min.js"></script>
	<script type="text/javascript" src="/js/dinkly.3.29.js"></script>

	<!-- Session Keepalive -->
	<script type="text/javascript">
		$.get('/cms_admin/user/keep_alive');
		setInterval(function(){
			$.get('/cms_admin/user/keep_alive');
		}, 300000); // 5 mins * 60 * 1000
	</script>

	<!-- Module Header -->
	<?php echo $this->getModuleHeader(); ?>
</head>
<body>
	<?php if($this->getCurrentModule() != 'login'): ?>
		<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
			<a class="navbar-brand" href="/cms_admin/home">Dinkly CMS</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<?php if(CmsAdminUser::isLoggedIn('cms_admin')): ?>
				<div class="collapse navbar-collapse" id="navbar">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item <?php echo (Dinkly::getCurrentModule() == 'pages') ? 'active' : ''; ?>">
							<a class="nav-link" href="/cms_admin/pages">Pages</a>
						</li>
						<li class="nav-item<?php echo (Dinkly::getCurrentModule() == 'settings') ? 'active' : ''; ?>">
							<a class="nav-link" href="/cms_admin/settings">Settings</a>
						</li>
						<li class="nav-item <?php echo (Dinkly::getCurrentModule() == 'user') ? 'active' : ''; ?>">
							<a class="nav-link" href="/cms_admin/user">Users</a>
						</li>
						<li class="nav-item <?php echo (Dinkly::getCurrentModule() == 'design') ? 'active' : ''; ?>">
							<a class="nav-link" href="/cms_admin/design ">Design</a>
						</li>
					</ul>
					<ul class="navbar-nav">
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="download" aria-expanded="false"><?php echo CmsAdminUser::getLoggedUsername('cms_admin'); ?></a>
							<div class="dropdown-menu" aria-labelledby="download">
								<a class="dropdown-item" href="/cms_admin/login/logout">Logout</a>
							</div>
						</li>
					</ul>
				</div>
			<?php endif; ?>
		</nav>
	<?php endif; ?>