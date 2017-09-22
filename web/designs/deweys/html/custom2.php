<section id="about" class="section section-custom">
	<div class="container-fluid">
		<div class="section-header">
			<h1><?php echo $settings['page_title']; ?></h1>
		</div>
		<div class="section-content clearfix">
			<?php if($custom2_image1->getOriginalSource() || $custom2_image2->getOriginalSource()): ?>
			<div class="image-block twocolumn clearfix">
				<?php if($custom2_image1->getOriginalSource()): ?>
				<img class="pull-left" src="<?php echo $custom2_image1->getOriginalSource(); ?>" />
				<?php endif; ?>
				<?php if($custom2_image2->getOriginalSource()): ?>
				<img class="pull-right" src="<?php echo $custom2_image2->getOriginalSource(); ?>" />
				<?php endif; ?>
			</div>
			<?php endif; ?>
			<?php if($custom2_content1 != ''): ?>
			<div class="content-block">
				<?php echo $custom2_content1->getHtml(); ?>
			</div>
			<?php endif; ?>
		</div>
	</div>
</section>