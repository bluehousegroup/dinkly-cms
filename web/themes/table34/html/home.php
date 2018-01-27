<div id="main">
	<div class="home-slideshow flexslider">
		<ul class="slides">
			<!--  slideshow -->
			<?php if(count($slideshow->getSlides()) > 0): ?>
				<?php foreach($slideshow->getSlides() as $slide): ?>
				<li style="background-image:url(<?php echo $slide->getOriginalSource(); ?>);">
					<a>
						<img src="<?php echo $slide->getOriginalSource(); ?>">
						<div class="caption-wrap">
							<div class="caption">
								<h2><?php echo $slide->getCaption(); ?></h2>
							</div>
						</div>
					</a>
				</li>
				<?php endforeach; ?>
			<?php endif; ?>
		</ul>
	</div>
	<div class="home-callouts">
		<div class="col leftcol">
			<div class="image-callout">
				<?php if($image1->getOriginalId()): ?>
				<div class="image-holder">
					<img src="<?php echo $image1->getOriginalSource(); ?>">
					<?php if($image1->getCaption()): ?>
					<div class="caption">
						<?php echo $image1->getCaption(); ?>
					</div>
					<?php endif; ?>
				</div>
				<?php endif; ?>
				<div class="content-holder <?php echo ($image1->getOriginalId()) ? '' : 'content-wide' ?>">
					<?php echo $left_text->getHtml(); ?>
				</div>
			</div>
		</div>

		<div class="col middlecol">
			<!-- Menu -->
			<div class="callout featured-menu">
				<?php echo $specials_text->getHtml(); ?>
			</div>
			<!-- Events -->
			<div class="callout upcoming-events">
				<?php echo $upcomingevents_text->getHtml(); ?>
			</div>
		</div>

		<div class="col rightcol">
			<!-- Hours -->
			<div class="callout our-hours">
				<?php echo $hours_text->getHtml(); ?>
			</div>
			<!-- Locations -->
			<?php if(isset($settings['address']) OR isset($settings['city']) OR isset($settings['state'])): ?>
				<div class="callout our-location">
					<h3>Location</h3>
						<?php echo (isset($settings['address'])) ? $settings['address'] : ''; ?><?php if(isset($settings['address']) AND (isset($settings['city']) OR isset($settings['state']))): ?>,<?php endif; ?>
						<?php echo (isset($settings['city'])) ? $settings['city'] : ''; ?>
						<?php echo (isset($settings['state'])) ? $settings['state'] : ''; ?>
					<p><a class="tel" href="#"><?php echo (isset($settings['phone'])) ? $settings['phone'] : ''; ?></a></p>
					<p><a href="#">Make a Reservation</a></p>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>