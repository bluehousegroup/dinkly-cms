		<section class="vital-info">
			<div class="container-fluid">
				<div class="row-fluid">
					<ul class="boxes-wrapper">
						<li class="hours">
							<div class="inner-wrap">
								<ul>
									<?php if($hours1->getHtml()): ?>
										<li><?php echo $hours1->getHtml(); ?></li>
									<?php endif; ?>
									<?php if($hours2->getHtml()): ?>
										<li><?php echo $hours2->getHtml(); ?></li>
									<?php endif; ?>
									<?php if($hours3->getHtml()): ?>
										<li><?php echo $hours3->getHtml(); ?></li>
									<?php endif; ?>
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

		<section >
			<div class="bottom_border">
			<div class="banner home" style="<?php echo ($home_banner->getOriginalId()) ? 'background-image:url(' . $home_banner->getOriginalSource() . ');' : ''; ?>">

			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span12 ">
						<div class="inner-wrap circle">
							<div class="circle-border-top"></div>
							<div class="banner-text">
									<span><?php echo $home_banner_text->getHtml(); ?></span>
							</div>
							<div class="circle-border-bottom"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
		</section>

		<section class="main-content">
			<div class="container-fluid">
				<div class=" main-area">
					<div class="row-fluid">
						<div class="span7">
							<div class="inner-wrap  main-left">
									<?php echo $home_content->getHtml(); ?>
							</div>
						</div>
						<div class="span5">
							<div class="inner-wrap  main-right">
								<h3 class="text-center">House Favorites</h3>
								<ul class="favorites">
									
									<li class="well-fav clearfix">
										<a href="javascript:void(0)" >
											<div class="fav-img">
												<img src="<?php echo $pizza_home_menu_image_1->getOriginalSource(); ?>" />
											</div>
											<div class=" fav-disc">
												
												<p><?php echo $pizza_home_menu_disc_1->getHtml(); ?></p>
											</div>
										</a>
									</li>

									<li class="well-fav clearfix" >
										<a href="javascript:void(0)" >
											<div class="fav-img">
												<img src="<?php echo $pizza_home_menu_image_2->getOriginalSource(); ?>" />
											</div>
											<div class=" fav-disc">
												<p><?php echo $pizza_home_menu_disc_2->getHtml(); ?></p>
											</div>
										</a>
									</li>

									<li class="well-fav clearfix">
										<a href="javascript:void(0)">
											<div class="fav-img">
												<img src="<?php echo $pizza_home_menu_image_3->getOriginalSource(); ?>" />
											</div>
											<div class=" fav-disc">
												<p><?php echo $pizza_home_menu_disc_3->getHtml(); ?></p>
											</div>
										</a>
									</li>		
								</ul>
								<a href="<?php echo $base_path; ?>/menu" class="btn green full-menu ">See the Full Menu</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		