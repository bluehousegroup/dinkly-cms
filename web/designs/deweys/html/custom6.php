<section id="about" class="section section-custom">
	<div class="container-fluid">
		<div class="section-header">
			<h1><?php echo $settings['page_title']; ?></h1>
		</div>
		<div class="section-content clearfix">
			<?php if($custom6_content1 != ''): ?>
			<div class="content-block">
				<?php echo $custom6_content1->getHtml(); ?>
			</div>
			<?php endif; ?>
			<div class="content-column-wrap">
				<div class="column first">
					<?php if($custom6_image_left->getOriginalSource()): ?>
					<div class="image-block">
						<img src="<?php echo $custom6_image_left->getOriginalSource(); ?>" />
					</div>
					<?php endif; ?>
					<?php if($custom6_content_left != ''): ?>
					<div class="content-block">
						<?php echo $custom6_content_left->getHtml(); ?>
					</div>
					<?php endif; ?>
				</div>
				<div class="column last">
					<?php if($custom6_content_right != ''): ?>
					<div class="content-block">
						<?php echo $custom6_content_right->getHtml(); ?>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>