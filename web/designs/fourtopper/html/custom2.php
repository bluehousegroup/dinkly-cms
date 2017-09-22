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
					<div class="content-block column">
						<img src="<?php echo $custom2_image1->getOriginalSource(); ?>" />
					</div>
					<div class="content-block column">
						<img src="<?php echo $custom2_image2->getOriginalSource(); ?>" />
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="content-block">
					<?php echo $custom2_content1->getHtml(); ?>
				</div>
				<div class="content-block">
					<?php echo $custom2_content2->getHtml(); ?>
				</div>
			</div>
		</div>
	</div>
</section>