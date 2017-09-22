<!DOCTYPE html>
<html>
<head>
	<title><?php echo ($settings['meta_title']) ? $settings['meta_title'] : $settings['page_title']; ?></title>
	<meta name="keywords" content="<?php echo $settings['meta_keywords']; ?>">
	<meta name="description" content="<?php echo $settings['meta_description']; ?>">
	<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" type="text/css" href="/designs/pizza/js/thirdparty/flexslider/flexslider.css">
	<link rel="stylesheet" type="text/css" href="/designs/pizza/css/pizza.css">
	<?php if($is_draft): ?>
		<link rel="stylesheet" type="text/css" href="/css/draft.css">
		<?php endif; ?>

	<style><?php echo $settings['site_custom_css']; ?></style>

	<script type="text/javascript" src="/designs/pizza/js/lib/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="/designs/pizza/js/lib/twitter/bootstrap.min.js"></script>
	<script type="text/javascript" src="/designs/pizza/js/thirdparty/flexslider/jquery.flexslider-min.js"></script>
	<script type="text/javascript" src="/designs/pizza/js/behavior.js"></script>
	</head>
	<body>

	<?php if($is_draft): ?>
		<div id="draft-message" class="draft-label">Viewing Draft Site</div>
		<?php endif; ?>

		<header>
			<div class="navbar navbar-static-top">
				<div class="container-fluid">
					<div class="header-top">
						<a href="#footer" class="btn-navbar">
							<span class="icon-bar"></span> 
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</a>
						<a href="<?php echo $base_path; ?>" class="brand has-logo">
							<!-- <img src="/designs/pizza/img/sample/logo.png" /> -->
							<img src="<?php echo $logo_path; ?>" alt="<?php echo $settings['restaurant_name']; ?><?php echo ' '.$settings['tagline']; ?>"/>
							<span ><?php echo $settings['restaurant_name']; ?><?php echo ' '.$settings['tagline']; ?></span>
						</a>
						<div class="address">
							<span>
								<?php echo $settings['address']; ?><?php if($settings['address'] AND ($settings['city'] OR $settings['state'])): ?>,<?php endif; ?>
								<?php echo $settings['city']; ?>
								<?php echo $settings['state']; ?>
								<?php echo $settings['zipcode']; ?>
							</span>
							<?php if(($settings['address'] OR $settings['city'] OR $settings['state'] OR $settings['zipcode']) AND $settings['phone']): ?>
								<span class="divider"> | </span>
								<span class="phone"><a href="tel:+<?php echo $settings['phone']; ?>" class="tel"><?php echo $settings['phone']; ?></a></span>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<div class="nav-wrapper">
					<div class="nav-collapse collapse">
						<ul class="nav">
							<?php if($nav_items != array()): ?>
								<?php foreach($nav_items as $nav): ?>
								<li><a href="<?php echo $base_path; ?>/<?php echo $nav->getSlug(); ?>"><?php echo $nav->getLabel(); ?></a></li>
								<?php endforeach; ?>
							<?php endif; ?>
						</ul>
					</div>
				</div>
			</div>
		</header>


		