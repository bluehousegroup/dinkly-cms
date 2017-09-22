<section id="about" class="section section-custom">
	<div class="container-fluid">
		<div class="section-header">
			<h1><?php echo $settings['page_title']; ?></h1>
		</div>
		<div class="section-content clearfix">
			<?php if($custom1_image->getOriginalSource()): ?>
			<div class="image-block">
				<img src="<?php echo $custom1_image->getOriginalSource(); ?>" />
			</div>
			<?php endif; ?>
			<?php if($custom1_content1 != ''): ?>
			<div class="content-block">
				<?php echo $custom1_content1->getHtml(); ?>
			</div>
			<?php endif; ?>
		</div>
	</div>
</section>