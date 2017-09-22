<section id="about" class="section section-custom">
	<div class="container-fluid">
		<div class="section-header">
			<h1><?php echo $settings['page_title']; ?></h1>
		</div>
		<div class="section-content clearfix">
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