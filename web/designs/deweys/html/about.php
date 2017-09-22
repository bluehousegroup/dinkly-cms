<section id="about" class="section section-about">
	<div class="container-fluid">
		<div class="section-header">
			<h1><?php echo $settings['page_title']; ?></h1>
		</div>
		<div class="section-content clearfix">
			<div class="content-wrap">
				<div class="pad">
					<img class="pull-left" src="<?php echo ($about_image1->getOriginalId()) ? $about_image1->getOriginalSource() : 'http://placehold.it/148x148/&amp;text=IMAGE'; ?>" alt="">
					<?php echo $about_text->getHtml(); ?>
				</div>
			</div>
			<div class="image-wrap">
				<div class="pad">
					<img class="top-img" src="<?php echo ($about_image2->getOriginalId()) ? $about_image2->getOriginalSource() : 'http://placehold.it/402x265/&amp;text=IMAGE'; ?>" alt="">
					<div class="image-row">
						<img class="bot-left-img" src="<?php echo ($about_image3->getOriginalId()) ? $about_image3->getOriginalSource() : 'http://placehold.it/238x203/&amp;text=IMAGE'; ?>" alt="">
						<img class="bot-right-img" src="<?php echo ($about_image4->getOriginalId()) ? $about_image4->getOriginalSource() : 'http://placehold.it/148x203/&amp;text=IMAGE'; ?>" alt="">
					</div>
				</div>
			</div>
		</div>
	</div>
</section>