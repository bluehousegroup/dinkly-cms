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
								<div class="content-column-wrap">
									<div class="column first span6">
										<?php if($custom4_left_content1 != ''): ?>
										<div class="content-block">
											<?php echo $custom4_left_content1->getHtml(); ?>
										</div>
										<?php endif; ?>
									</div>
									<div class="column last span5">
										<?php if($custom4_right_image->getOriginalSource()): ?>
										<div class="image-block">
											<img src="<?php echo $custom4_right_image->getOriginalSource(); ?>" />
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
	</div>
</section>
</div>
</div>
</section>