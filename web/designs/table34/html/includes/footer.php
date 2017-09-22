		<div class="footer-wrap">
			<div id="footer" class="footer">
				<ul class="nav">
					<?php foreach($nav_items as $nav): ?>
						<li><a href="<?php echo $base_path; ?>/<?php echo $nav->getSlug(); ?>"><?php echo $nav->getLabel(); ?></a></li>
					<?php endforeach; ?>
				</ul>
				<div class="address">
					<?php if(isset($settings['address']) OR isset($settings['city']) OR isset($settings['state'])): ?>
						<?php echo $settings['address']; ?><?php if($settings['address'] AND ($settings['city'] OR $settings['state'])): ?>,<?php endif; ?>
						<?php echo $settings['city']; ?>
						<?php echo $settings['state']; ?>
					<?php endif; ?>
					<?php if(isset($settings['phone'])): ?>
						<a href="tel:+<?php echo $settings['phone']; ?>" class="tel"><?php echo $settings['phone']; ?></a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</body>
</html>