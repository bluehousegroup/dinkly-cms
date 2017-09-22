<!DOCTYPE html>
<html>
<head>
	<title><?php echo $settings['page_title']; ?></title>
	<meta name="title" content="<?php echo $settings['meta_title']; ?>">
	<meta name="keywords" content="<?php echo $settings['meta_keywords']; ?>">
  <meta name="description" content="<?php echo $settings['meta_description']; ?>">
  <meta name="viewport" content="initial-scale=1.0,width=device-width" />
	<link type="text/css" rel="stylesheet" href="/designs/fourtopper/css/styles.css" />
	<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript" src="/designs/fourtopper/js/jquery.fittext.js"></script>
	<script type="text/javascript" src="/designs/fourtopper/js/bootstrap.js"></script>
	<script type="text/javascript" src="/designs/fourtopper/js/behavior.js"></script>
	<script type="text/javascript" async="" src="http://www.google-analytics.com/ga.js"></script>
	<script type="text/javascript">
		$(function(){
			//responsive headlines

			$("div.footer-center a.email").fitText(1.4, {minFontSize: '12px', maxFontSize: '16px'});
		});
	</script>
</head>
<body>
<div class="page-container">
<header <?php echo ($page_template_code == 'home') ? 'class="home"' : ''; ?>>
	<div class="navbar navbar-static-top">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="/home"><span><img src="/designs/fourtopper/img/logo-main.png" alt="Four Topper" /></span></a>
				<div class="nav-collapse collapse clearfix">
					<ul class="nav main-nav">
						<li><a href="/tour">Tour</a></li>
						<li><a href="/pricing">Pricing</a></li>
						<li><a href="/design">Designs</a></li>
					</ul>
					<ul class="nav utility-nav">
						<li><a href="/meet-us">Meet Us</a></li>
						<li class="get-started"><a href="#beta-signup-modal" role="button" data-toggle="modal">Get Started</a></li>
						<li class="social"><a href="https://www.facebook.com/pages/Fourtopper/176391962498819" target="_blank" title="Find Four Topper of Facebook!"><i class="icon icon-facebook-sign"></i><span class="menu-text">Facebook</span></a></li>
						<li class="social"><a href="https://twitter.com/fourtopper" target="_blank" title="Follow Fourtopper on Twitter!"><i class="icon icon-twitter"></i><span class="menu-text">Twitter</span></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</header>