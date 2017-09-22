<section id="home" class="section section-home">
	<div class="container-fluid">
		<img src="<?php echo $logo_path; ?>" alt="">
			<?php if($settings['address'] OR $settings['city'] OR $settings['state']): ?>
				<p class="address">
					<?php echo ($settings['address']) ? $settings['address']."<br/>" : "" ?>
					<?php if($settings['city']): ?>
						<?php echo $settings['city'] ?>
					<?php endif; ?>
					<?php if($settings['state']): ?>
						<?php echo $settings['state'] ?>
					<?php endif; ?>
				</p>
			<?php endif; ?>
		<p class="next-section"><a>Explore</a></p>
	</div>
</section>