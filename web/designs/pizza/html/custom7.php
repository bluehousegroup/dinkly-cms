

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
						<?php if($custom7_content != ''): ?>
						<div class="content-block">
							<?php echo $custom7_content->getHtml(); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</section>
	</div>
</div>
</div>
</section>