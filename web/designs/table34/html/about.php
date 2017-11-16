<div class="banner">
	<div class="banner-wrap">
		<h1><?php echo $settings['page_title']; ?></h1>
	</div>
</div>
<section id="main" class="custom-content">
	<div class="main-content">
		<div class="inner-wrap">
			<?php if($about_image->getOriginalSource()): ?>
			<div class="image-block">
				<img src="<?php echo $about_image->getOriginalSource(); ?>" />
			</div>
			<?php endif; ?>
			<?php if($about_text != ''): ?>
			<div class="content-block">
				<?php echo $about_text->getHtml(); ?>
			</div>
			<?php endif; ?>
		</div>
	</div>
</section>