<div class="banner">
	<div class="banner-wrap">
		<h1><?php echo $settings['page_title']; ?></h1>
	</div>
</div>
<section id="main" class="custom-content">
	<div class="main-content">
		<div class="inner-wrap">
			<div class="content-column-wrap">
				<div class="column last">
					<?php if(!empty($settings['address']) && !empty($settings['city']) && !empty($settings['state']) && !empty($settings['zipcode'])): ?>
					<div class="map-block">
						<?php $formattedAddress = $settings['address'].', '.$settings['city'].' '.$settings['state'].' '.$settings['zipcode']; ?>
						<div id="map-canvas" data-address="<?php echo $formattedAddress; ?>"></div>
					</div>
					<?php endif; ?>
					<div class="map-actions">
						<input type="text" id="starting-location" placeholder="Your location" />
						<button class="button" type="submit" onclick="gmap.calcRoute();">Get Directions</button>
						<div id="directions-wrapper"></div>
					</div>
				</div>
				<div class="column first">
					<div class="content-block">
						<div class="vcard">
							<h4 class="fn"><?php echo $settings['restaurant_name']; ?></h4>
							<div class="adr">
								<?php if($settings['address']):?><div class="street-address"><?php echo $settings['address']; ?></div><?php endif; ?>
								<div>
									<?php if($settings['city']): ?><span class="locality"><?php echo $settings['city']; ?></span><?php endif; ?><?php if($settings['state']): ?>, <span class="region"><?php echo $settings['state']; ?></span><?php endif; ?><?php if($settings['zipcode']): ?> <span class="postal-code"><?php echo $settings['zipcode']; ?></span><?php endif; ?>
								</div>
							</div>
							<?php if($settings['phone']): ?>
							<div class="tel">
								<a href="tel:+<?php echo $settings['phone']; ?>" class="value"><?php echo $settings['phone']; ?></a>
							</div>
							<?php endif; ?>
						</div>
					</div>
					<div class="content-block">
						<?php if($directions_text->getHtml()): ?>
						<?php echo $directions_text->getHtml(); ?>
						<?php endif; ?>
					</div>
					<div class="content-block">
						<?php if($parking_text->getHtml()): ?>
						<?php echo $parking_text->getHtml(); ?>
						<?php endif; ?>
					</div>
					<div class="content-block">
						<?php if($hours_text2->getHtml()): ?>
						<?php echo $hours_text2->getHtml(); ?>
						<?php endif; ?>
					</div>

					<form class="check-ph-support" id="contact-form-directions">
						<input class="text" type="text" name="name" id="name" placeholder="Your Name" />

						<input class="text" type="email" name="email" id="email" placeholder="Your Email" />

						<textarea class="textarea" type="textarea" name="message" id="message" placeholder="Your Message"></textarea>

						<div class="action">
							<button type="submit" class="button">Contact Us</button>
						</div>
					</form> 
				</div>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript" src="/designs/table34/js/mapsInit.js"></script>