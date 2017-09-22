<section id="about" class="section section-custom">
	<div class="container-fluid">
		<div class="section-header">
			<h1><?php echo $settings['page_title']; ?></h1>
		</div>
		<div class="section-content clearfix">
			<div class="content-column-wrap">
				<div class="column first">
					<?php if($custom4_left_content1 != ''): ?>
					<div class="content-block">
						<?php echo $custom4_left_content1->getHtml(); ?>
					</div>
					<?php endif; ?>
				</div>
				<div class="column last">
					<?php if($custom4_right_image->getOriginalSource()): ?>
					<div class="image-block">
						<img src="<?php echo $custom4_right_image->getOriginalSource(); ?>" />
					</div>
					<?php endif; ?>
					<?php if($custom4_right_content1 != ''): ?>
					<div class="content-block">
						<?php echo $custom4_right_content1->getHtml(); ?>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>