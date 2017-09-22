<section class="slideshow">
	<div>
		<div class="inside">
			<div class="flexslider">
				<ul class="slides">
					<?php if(count($slideshow->
					getSlides()) > 0): ?>
					<?php foreach($slideshow->
					getSlides() as $slide): ?>
					<li>
						<div class="half right">
							<div class="image-wrapper">
								<div>
									<img src="<?php echo $slide->getOriginalSource(); ?>" /></div>
							</div>
						</div>
						<div class="half left">
							<div class="h1-wrapper">
								<h1>
									<?php echo $slide->getCaption(); ?>
								</h1>
							</div>
							<!--div class="banner">
						</div-->
					</div>
				</li>
				<?php endforeach; ?>
				<?php endif; ?></ul>
		</div>
	</div>
</div>
</section>
<div class="frill"></div>
<section class="callout">
	<div class="inside">
		<div class="col left">
			<div>
				<h1>
					<?php echo $left_head->getHTML(); ?></h1>
				<p style="text-align: center;">
					<?php echo $left_text->getHTML(); ?></p>
			</div>
		</div>
		<div class="col right">
			<div>
				<h1>Our Hours</h1>
				<div class="hours-wrap">
					<?php echo $hours_text->getHTML(); ?>
				</div>
			</div>
		</div>
		<div class="col middle">
			<div>
				<h1>Featured Menu Item</h1>
				<img src="<?php echo $fmi->
				getOriginalSource(); ?>" />
				<h3 style="margin-bottom: 5px; text-align: center;">
					<?php echo $fmi->getCaption(); ?></h3>
				<h2>
					<a href="">See the Menu</a>
				</h2>
			</div>
		</div>
		<div style="clear: both"></div>
	</div>
</section>

<!-- jQuery -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.min.js">\x3C/script>')</script>


<!-- FlexSlider -->
<script defer src="/designs/burger/js/jquery.flexslider.js"></script>

<script type="text/javascript">
	$(window).load(function(){
			$('.flexslider').flexslider({
					animation: "fade",
					controlNav: false,
					prevText: "<i class='icon-caret-left'></i>",
					nextText: "<i class='icon-caret-right'></i>"
			});
	});
</script>