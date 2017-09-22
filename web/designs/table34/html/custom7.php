<div class="banner">
	<div class="banner-wrap">
		<h1><?php echo $settings['page_title']; ?></h1>
	</div>
</div>
<section id="main" class="custom-content">
	<div class="main-content">
		<div class="inner-wrap">
			<?php if($custom7_content != ''): ?>
			<div class="content-block">
				<?php echo $custom7_content->getHtml(); ?>
			</div>
			<?php endif; ?>
		</div>
	</div>
</section>