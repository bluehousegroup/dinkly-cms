<section class="page-title">
	<div class="container-fluid">
		<div class='row-fluid'>
			<h2><?php echo $settings['page_title']; ?></h2>
		</div>
	</div>
</section>
<section class="main custom-content">
	<div class="style-wrap">
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="content-block">
					<?php echo $custom7_content1->getHtml(); ?>
				</div>
			</div>
			<div class="row-fluid">
				<div class="content-block column">
					<div class="interior-block">
						<img src="<?php echo $custom7_image_left->getOriginalSource(); ?>" />
					</div>
					<div class="interior-block">
						<?php echo $custom7_content_left->getHtml(); ?>
					</div>
				</div>
				<div class="content-block column">
					<div class="interior-block">
						<?php echo $custom7_content_right->getHtml(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>