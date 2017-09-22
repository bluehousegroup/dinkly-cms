<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="author" content="Bluehouse Group" />
	<meta name="keywords" content="<?php echo $settings['meta_keywords']; ?>
	" />
	<meta name="description" content="<?php echo $settings['meta_description']; ?>
	">
	<meta name="viewport" content="initial-scale=1.0, width=device-width" />
	<link href='http://fonts.googleapis.com/css?family=Oleo+Script:400,700' rel='stylesheet' type='text/css'>
	<?php if($is_draft): ?>
	<link rel="stylesheet" type="text/css" href="/css/draft.css">
	<?php endif; ?>
	<link href="/designs/burger/css/default.css" rel="stylesheet" />
	<link href="/designs/burger/css/flexslider.css" rel="stylesheet" />
	<link href="/designs/burger/css/style.css" rel="stylesheet" />
	<style><?php echo $settings['site_custom_css']; ?></style>
	<!--[if lt IE 9]>
	<link href="/designs/burger/css/ie.css" rel="stylesheet" />
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<title><?php echo ($settings['meta_title']) ? $settings['meta_title'] : $settings['page_title']; ?></title>
</head>
<body>
	<?php if($is_draft): ?>
	<div id="draft-message" class="draft-label">Viewing Draft Site</div>
	<?php endif; ?>
	<header id="top">
		<div>
			<div class="inside">
				<div class="logo">
					<a href="<?php echo $base_path; ?>">
						<img src="<?php echo $logo_path; ?>" />
					</a>
					<!--Max size 275x100-->
				</div>
				<div class="nav-collapse">
					<a href="#nav">
						<span></span>
						<span></span>
						<span></span>
					</a>
				</div>
				<div class="contact">
					<?php if($settings['address']):?>
					<span><?= $settings['address']; ?><?= ($settings['city'] || $settings['state']) ? ', ' : ''; ?></span>
					<?php endif; ?>
					<?php if($settings['city']): ?>
					<span><?= $settings['city']; ?></span>
					<?php endif; ?>
					<?php if($settings['state']):?>
					<span><?= $settings['state']; ?></span>
					<?php endif; ?>
					<?php if($settings['phone']): ?>
					<span>
						<a href="tel:+<?= $settings['phone']; ?>" class="tel"><?= $settings['phone']; ?></a>
					</span>
					<?php endif; ?>
				</div>
				<nav>
					<ul class="nav">
						<?php foreach($nav_items as $nav): ?>
						<li>
							<a href="<?php echo $base_path; ?>
								/
								<?php echo $nav->
								getSlug(); ?>">
								<?php echo $nav->getLabel(); ?></a>
						</li>
						<?php endforeach; ?></ul>
				</nav>
			</div>
		</div>
	</header>