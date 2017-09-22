<section class="page-title">
	<div class="container-fluid">
		<div class="row-fluid">
			<h2><?php echo $settings['page_title']; ?></h2>
		</div>
	</div>
</section>
<section class="main banner custom custom-content">
	<div class="style-wrap">
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="span12">
					<div class="content-block">
						<img src="<?php echo $custom3_image->getOriginalSource(); ?>" />
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="content-block column">
					<?php echo $custom3_content_left->getHtml(); ?>
				</div>
				<div class="content-block column">
					<img src="<?php echo $custom3_image_right->getOriginalSource(); ?>" />
				</div>
			</div>
			<div class="row-fluid">
				<div class="content-block">
					<?php echo $custom3_content2->getHtml(); ?>
				</div>
			</div>
		</div>
	</div>
</section>
