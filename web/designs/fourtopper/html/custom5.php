<section class="page-title">
	<div class="container-fluid">
		<div class="row-fluid">
			<h2><?php echo $settings['page_title']; ?>
		</div>
	</div>
</section>
<section class="main banner custom custom-content">
	<div class="style-wrap">
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="span12">
					<div class="content-block">
						<img src="<?php echo $custom5_image->getOriginalSource(); ?>" />
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="content-block">
					<?php echo $custom5_content->getHtml(); ?>
				</div>
			</div>
		</div>
	</div>
</section>