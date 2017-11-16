<!DOCTYPE html>
<html>
<head>
	<title><?php echo ($settings['meta_title']) ? $settings['meta_title'] : $settings['page_title']; ?></title>
	<meta name="keywords" content="<?php echo $settings['meta_keywords']; ?>">
	<meta name="description" content="<?php echo $settings['meta_description']; ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="/designs/table34/js/thirdparty/flexslider/flexslider.css">
	<link rel="stylesheet" type="text/css" href="/designs/table34/css/table34.css">
	<?php if($is_draft OR $is_revision): ?>
		<link rel="stylesheet" type="text/css" href="/css/draft.css">
	<?php endif; ?>
	<?php
	if($settings['page_title']=='Directions'):?>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA3KtsW-VipTtJNNpj0jtlYKxY0r_z79Kg&amp;sensor=false">
	</script>
	<?php endif; ?>
	<script type="text/javascript" src="/designs/table34/js/lib/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="/designs/table34/js/lib/twitter/bootstrap.min.js"></script>
	<script type="text/javascript" src="/designs/table34/js/thirdparty/flexslider/jquery.flexslider-min.js"></script>
	<script type="text/javascript" src="/designs/table34/js/behavior.js"></script>
	<style><?php echo $settings['site_custom_css']; ?></style>
	<!--[if lt IE 9]>
	<link rel="stylesheet" type="text/css" href="../css/ie.css">
	<script type="text/javascript" src="./designs/table34/js/lib/html5shiv.js"></script>
	<![endif]-->
	<!--[if lte IE 7]>
	<link rel="stylesheet" type="text/css" href="../css/ie7.css">
	<![endif]-->
	</head>
	<body>
		<?php if($is_draft): ?>
			<div id="draft-message" class="draft-label">Viewing Draft Site</div>
		<?php elseif($is_revision): ?>
			<div id="draft-message" class="draft-label">Viewing Revision #<?php echo $revision_number; ?></div>
		<?php endif; ?>
		<div class="navbar navbar-static-top">
			<div class="navbar-inner">
				<div class="container-fluid">
					<a href="#footer" class="btn-navbar">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>

					<a href="/" class="brand"><img src="<?php echo $logo_path; ?>" alt="<?php echo $settings['meta_title']; ?>"></a>

					<div class="navbar-upper">
						<div class="address">
							<?php if(isset($settings['address']) OR isset($settings['city']) OR isset($settings['state'])): ?>
								<i class="icon icon-map-marker"></i>
								<?php echo $settings['address']; ?><?php if($settings['address'] AND ($settings['city'] OR $settings['state'])): ?>,<?php endif; ?>
								<?php echo $settings['city']; ?>
								<?php echo $settings['state']; ?>
							<?php endif; ?>
							<?php if(isset($settings['phone'])): ?>
								<a href="tel:+<?php echo $settings['phone']; ?>" class="tel"><?php echo $settings['phone']; ?></a>
							<?php endif; ?>
						</div>
					</div>

					<div class="navbar-lower">
						<div class="navbar-collapse">
							<ul class="nav">
								<?php if($nav_items != array()): ?>
									<?php foreach($nav_items as $nav): ?>
										<li><a href="/<?php echo $nav->getSlug(); ?>"><?php echo $nav->getLabel(); ?></a></li>
									<?php endforeach; ?>
								<?php endif; ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>