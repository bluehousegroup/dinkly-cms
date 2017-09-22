<!DOCTYPE html>
<html>
	<head>
		<title>Site Admin</title>
		<link rel="stylesheet" href="/css/datatables-bootstrap.css">
		<link rel="stylesheet" href="/css/site-admin.css" />
		<link rel="stylesheet" href="/css/mini-ticket.css" />

		<!-- Bootstrap and jQuery -->
		<script type="text/javascript" src="/javascript/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="/javascript/bootstrap/bootstrap.min.js"></script>

		<!-- Site Admin Behaviors -->
		<script type="text/javascript" src="/javascript/behavior.js"></script>

		<!-- Datatables -->
		<script type="text/javascript" src="/javascript/jquery.dataTables.min.js"></script>

		<!-- CKEditor -->
		<script type="text/javascript" src="/javascript/ckeditor/ckeditor.js"></script>

		<!-- jQuery UI (Includes UI Sortable) -->
		<script type="text/javascript" src="/javascript/jquery-ui-1.10.2.custom.min.js"></script>

		<!-- Twitter Bootstrap timepicker http://jdewit.github.io/bootstrap-timepicker/ -->
		<script type="text/javascript" src="/javascript/bootstrap/twitter/bootstrap-timepicker.min.js"></script>

		<!-- Twitter Bootstrap datepicker https://github.com/eternicode/bootstrap-datepicker -->
		<script type="text/javascript" src="/javascript/bootstrap/twitter/bootstrap-datepicker.js"></script>

		<!-- MiniTicket js -->
		<script type="text/javascript" src="/javascript/mini-ticket.js"></script>		
    	<script type="text/javascript" src="/javascript/jquery.foundation.reveal.js"></script>

    	<!-- Chart js -->
		<script type="text/javascript" src="/javascript/Chart.js"></script>

		<!-- HTML5 Uploader js -->
		<script type="text/javascript" src="/javascript/html5_uploader/code.js"></script>
		<link rel="stylesheet" href="/javascript/html5_uploader/style.css" />

		<!-- Session Keepalive -->
		<script type="text/javascript">
		setInterval(function(){
		   $.get('/site_admin/user/keep_alive');
		}, 300000); // 5 mins * 60 * 1000
		</script>

		<!-- jQuery Debounce -->
		<script type="text/javascript" src="/javascript/jquery.ba-throttle-debounce.js"></script>

		<link rel="stylesheet" href="/css/jquery.fileupload-ui.css">

		<!-- Module Header -->
		<?php echo $this->getModuleHeader(); ?>
	</head>
	<body>
		<?php if(CmsAdminUser::isLoggedIn('site_admin')): ?>
		<header id="header" role="banner">
			<div class="navbar navbar-inverse navbar-static-top">
				<div class="navbar-inner">
					<div class="container-fluid">
						<a href="/site_admin" class="brand"><?php echo $site->getName(); ?> Admin</a>
						<ul class="nav pull-left">
							<li <?php echo (Dinkly::getCurrentModule() == 'pages') ? 'class="active"' : ''; ?>><a href="/site_admin/pages/">Content</a></li>
							<li <?php echo (Dinkly::getCurrentModule() == 'menu') ? 'class="active"' : ''; ?>><a href="/site_admin/menu/">Menus</a></li>
							<li <?php echo (Dinkly::getCurrentModule() == 'settings') ? 'class="active"' : ''; ?>><a href="/site_admin/settings/">Settings</a></li>
							<li <?php echo (Dinkly::getCurrentModule() == 'design') ? 'class="active"' : ''; ?>><a href="/site_admin/design/">Design</a></li>
							<li <?php echo (Dinkly::getCurrentModule() == 'user') ? 'class="active"' : ''; ?>><a href="/site_admin/user/">Users</a></li>
							<?php if($site->getDomain() == 'fourtopper.com'): ?>
								<li <?php echo (Dinkly::getCurrentModule() == 'blog') ? 'class="active"' : ''; ?>><a href="/site_admin/blog/">Blog</a></li>
							<?php endif; ?>
							<li <?php echo (Dinkly::getCurrentModule() == 'events') ? 'class="active"' : ''; ?>><a href="/site_admin/events/">Events</a></li>
							<li <?php echo (Dinkly::getCurrentModule() == 'analytics') ? 'class="active"' : ''; ?>><a href="/site_admin/analytics/">Analytics</a></li>
							<li <?php echo (Dinkly::getCurrentModule() == 'email_marketing') ? 'class="active"' : ''; ?>><a href="/site_admin/email_marketing/">Marketing</a></li>
							<li <?php echo (Dinkly::getCurrentModule() == 'reviews') ? 'class="active"' : ''; ?>><a href="/site_admin/reviews/dashboard">Reviews</a></li>
						</ul>
						<ul class="util-nav nav pull-right">
							<li><a href="/site_admin/help">Help</a></li>
							<!-- <li><a href="/site_admin/account/upgrade">Upgrade</a></li> -->
							<li class="dropdown">
								<a href="#" class="user dropdown-toggle" title="Logged in as <?php echo CmsAdminUser::getLoggedUsername('site_admin'); ?>" data-toggle="dropdown">
									<span class="username"><?php echo CmsAdminUser::getLoggedUsername('site_admin'); ?> </span><i class="icon-caret-down"></i>
								</a>
								<ul class="dropdown-menu pull-right">
									<li class="user-info">Logged in as <?php echo CmsAdminUser::getLoggedUsername('site_admin'); ?></li>
									<!-- <li><a href="/site_admin/account">Account</a></li> -->
									<!-- <li><a href="/site_admin/account/billing">Billing</a></li> -->
									<li><a href="/site_admin/login/logout">Logout</a></li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</header>
		<?php endif; ?>