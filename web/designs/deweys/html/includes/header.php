<!DOCTYPE html>
<html>
	<head>
		<title><?php echo ($settings['meta_title']) ? $settings['meta_title'] : $settings['page_title']; ?></title>
		<meta name="keywords" content="<?php echo $settings['meta_keywords']; ?>">
		<meta name="description" content="<?php echo $settings['meta_description']; ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="/designs/deweys/css/deweys.css">
		<script type="text/javascript" src="/designs/deweys/js/lib/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="/designs/deweys/js/lib/twitter/bootstrap.min.js"></script>
		<script type="text/javascript" src="/designs/deweys/js/jquery-smooth-scroll/jquery.smooth-scroll.js"></script>
		<script type="text/javascript" src="/designs/deweys/js/menu.js"></script>
		<script type="text/javascript" src="/designs/deweys/js/behavior.js"></script>
		<?php if($is_draft): ?>
		<link rel="stylesheet" type="text/css" href="/css/draft.css">
		<?php endif; ?>
		<style><?php echo $settings['site_custom_css']; ?></style>
		<!--[if lt IE 9]>
		<script type="text/javascript" src="/designs/deweys/js/lib/html5shiv.js"></script>
		<link rel="stylesheet" href="/designs/deweys/css/deweys-ie.css">
		<![endif]-->
		<!--[if IE 9]>
		<link rel="stylesheet" href="/designs/deweys/css/deweys-ie9.css">
		<![endif]-->
	</head>
	<body>
		<?php if($is_draft): ?>
			<div id="draft-message" class="draft-label">Viewing Draft Site</div>
			<?php endif; ?>
		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container-fluid">
					<ul class="nav">
						<?php if($nav_items != array()): ?>
							<?php foreach($nav_items as $nav): ?>
							<?php if($nav->getSlug() == 'menu'): ?>
							<?php if($menu->getMenus() != array()): ?>
							<?php foreach($menu->getMenus() as $pos => $m): ?>
							<li><a href="#menu-<?php echo $m->getSlug(); ?>"><?php echo $m->getTitle(); ?></a></li>
							<?php endforeach; ?>
							<?php endif; ?>
							<?php else: ?>
							<li><a href="#<?php echo $nav->getSlug(); ?>"><?php echo $nav->getLabel(); ?></a></li>
							<?php endif; ?>
							<?php endforeach; ?>
							<?php if($settings['social_twitter']): ?>
								<li><a href="<?php echo $settings['social_twitter']; ?>" target="_blank"><i class="icon icon-large icon-twitter"></i></a></li>
							<?php endif; ?>
							<?php if($settings['social_facebook']): ?>
								<li><a href="<?php echo $settings['social_facebook']; ?>" target="_blank"><i class="icon icon-large icon-facebook-sign"></i></a></li>
							<?php endif; ?>
						<?php endif; ?>
					</ul>
				</div>
			</div>
		</div>