<section class="banner custom">
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">
				<div class="content-block">
					<img src="<?php echo $custom3_image->getOriginalSource(); ?>" />
				</div>
			</div>
		</div>
	</div>
</section>
<section class="custom-content">
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="content-block column">
				<?php echo $custom3_content_left->getHtml(); ?>
			</div>
			<div class="content-block column">
				<img src="<?php echo $custom3_image_right->getOriginalSource(); ?>" />
			</div>
		</div>
	</div>
</section>
<section class="custom-content">
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="content-block">
				<?php echo $custom3_content2->getHtml(); ?>
			</div>
		</div>
	</div>
</section>