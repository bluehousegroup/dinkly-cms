<div class="banner">
	<div class="banner-wrap">
		<h1><?php echo $settings['page_title']; ?></h1>
	</div>
</div>
<section id="main" class="custom-content">
	<div class="main-content">
		<div class="inner-wrap">
			<?php if($custom3_image->getOriginalSource()): ?>
			<div class="image-block">
				<img src="<?php echo $custom3_image->getOriginalSource(); ?>" />
			</div>
			<?php endif; ?>
			<?php if($custom3_content != ''): ?>
			<div class="content-block">
				<?php if($custom3_image_right->getOriginalSource()): ?>
				<img class="pull-right" src="<?php echo $custom3_image_right->getOriginalSource(); ?>" />
				<?php endif; ?>
				<?php echo $custom3_content->getHtml(); ?>
			</div>
			<?php endif; ?>
		</div>
	</div>
</section>