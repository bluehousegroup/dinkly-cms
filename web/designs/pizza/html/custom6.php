

<section class="vital-info">
	<div class="container-fluid">
		<div class="row-fluid">
			<ul class="boxes-wrapper">
				<li class="hours">
					<div class="inner-wrap">
						<ul>

						</ul>
					</div>
				</li>
				<li class="deliver">
					<div class="inner-wrap">
						<ul class="announce">
							<li><h2 class="Wedo">WE DELIVER</h2></li>
							<li><h2 class="phone"><a href="tel:+<?php echo $settings['phone']; ?>" class="tel"><?php echo $settings['phone']; ?></a></h2></li>
						</ul>
					</div>
				</li>
			</ul>
		</div>
	</div>
</section>
<section class="main-content">
	<div class="container-fluid">
		<div class=" main-area" style="background: #f6eecf;">

			<div class="banner">
				<div class="banner-wrap">
					<h1><?php echo $settings['page_title']; ?></h1>
				</div>
			</div>
			<section id="main" class="custom-content">
				<div class="main-content">
					<div class="inner-wrap">
						<?php if($custom6_content1 != ''): ?>
						<div class="content-block">
							<?php echo $custom6_content1->getHtml(); ?>
						</div>
					<?php endif; ?>
					<div class="content-column-wrap">
						<div class="column first">
							<?php if($custom6_image_left->getOriginalSource()): ?>
							<div class="image-block">
								<img src="<?php echo $custom6_image_left->getOriginalSource(); ?>" />
							</div>
						<?php endif; ?>
						<?php if($custom6_content_left != ''): ?>
						<div class="content-block">
							<?php echo $custom6_content_left->getHtml(); ?>
						</div>
					<?php endif; ?>
				</div>
				<div class="column last">
					<?php if($custom6_content_right != ''): ?>
					<div class="content-block">
						<?php echo $custom6_content_right->getHtml(); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
</section>
</div>
</div>
</div>
</section>