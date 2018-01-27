<div class="banner">
	<div class="banner-wrap">
		<h1><?php echo $settings['page_title']; ?></h1>
	</div>
</div>
<section id="main" class="custom-content">
	<div class="main-content">
		<div class="inner-wrap">
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