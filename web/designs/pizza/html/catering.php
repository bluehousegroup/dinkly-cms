

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
<div id="main">
	<div class="main-content">
						<?php if($catering_image->getOriginalSource()): ?>
					<div class="image-block">
						<img src="<?php echo $catering_image->getOriginalSource(); ?>" />
					</div>
					<?php endif; ?>
		<?php echo $catering_text->getHtml(); ?>
	</div>
</div>
				</div>
			</div>
		</div>
	</div>
</section>
</div>
</div>
</section>