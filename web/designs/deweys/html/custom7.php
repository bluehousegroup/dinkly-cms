<section id="about" class="section section-custom">
	<div class="container-fluid">
		<div class="section-header">
			<h1><?php echo $settings['page_title']; ?></h1>
		</div>
		<div class="section-content clearfix">
			<?php if($custom7_content != ''): ?>
			<div class="content-block">
				<?php echo $custom7_content->getHtml(); ?>
			</div>
			<?php endif; ?>
		</div>
	</div>
</section>