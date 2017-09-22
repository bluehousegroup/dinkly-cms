<section id="contact" class="section section-contact">
	<div class="container-fluid">
		<div class="section-header">
			<h1><?php echo $settings['page_title']; ?></h1>
		</div>
		<div class="section-content">
			<div class="map-container">
				<div class="pad">
					<?php echo $map->getHtml(); ?>
				</div>
			</div>
			<div class="address-hours">
				<div class="pad">
					<!-- Address -->HELLO
					<?php if($settings['address'] || $settings['city'] || $settings['state']): ?>
						<p class="address">
							<?php if($settings['address']): ?>
								<?=$settings['address']?>
								<?php if($settings['city']): ?>
									<!--br/-->
								<?php endif; ?>
							<?php endif; ?>
							<?php if($settings['city']): ?>
								<?=$settings['city']?>
							<?php endif; ?>
							<?php if($settings['state']): ?>
								<?=$settings['state']?>
							<?php endif; ?>
						</p>
					<?php endif; ?>

					<!-- Phone -->
					<p class="tel"><a href="tel:+<?php echo $settings['phone']; ?>"><?php echo $settings['phone']; ?></a></p>
					<?php echo $contact_hours->getHtml(); ?>
					<?php echo $contact_info->getHtml(); ?>
				</div>
			</div>
		</div>
	</div>
</section>