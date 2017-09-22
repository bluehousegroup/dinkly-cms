<section class="banner custom">
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">
				<div class="content-block">
					<img src="<?php echo $custom1_image->getOriginalSource(); ?>" />
				</div>
			</div>
		</div>
	</div>
</section>
<section class="custom-content">
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="content-block">
				<?php echo $custom1_content1->getHtml(); ?>
			</div>
			<div class="content-block">
				<?php echo $custom1_content2->getHtml(); ?>
			</div>
		</div>
	</div>
</section>