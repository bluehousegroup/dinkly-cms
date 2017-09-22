<section class="page-title">
	<div class="container-fluid">
		<div class="row-fluid">
			<h2><?php echo $settings['page_title']; ?></h2>
		</div>
	</div>
</section>
<section class="main custom-content">
	<div class="style-wrap">
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="content-block">
					<?php echo $custom6_content1->getHtml(); ?>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span12">
					<div class="content-block">
						<img src="<?php echo $custom6_image->getOriginalSource(); ?>" />
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="content-block">
					<?php echo $custom6_content2->getHtml(); ?>
				</div>
			</div>
		</div>
	</div>
</section>