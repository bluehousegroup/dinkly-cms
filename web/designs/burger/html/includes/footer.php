<footer>
	<div class="inside">
		<div class="social">
			<?php if($settings['social_facebook']): ?>
			<a href="<?= $settings['social_facebook']; ?>" target="_blank"> <i class="icon-facebook-sign"></i>
				<span>Find us on Facebook</span>
			</a>
			<?php endif; ?>
			<?php if($settings['social_twitter']): ?>
			<a href="<?= $settings['social_twitter']; ?>" target="_blank"> <i class="icon-twitter"></i>
				<span>Follow us on Twitter</span>
			</a>
			<?php endif; ?>
		</div>
		<div class="contact">
			<?php if($settings['address']):?>
			<span><?= $settings['address']; ?><?= ($settings['city'] || $settings['state']) ? ', ' : ''; ?></span>
			<?php endif; ?>
			<?php if($settings['city']): ?>
			<span><?= $settings['city']; ?></span>
			<?php endif; ?>
			<?php if($settings['state']):?>
			<span><?= $settings['state']; ?></span>
			<?php endif; ?>
			<?php if($settings['phone']): ?>
			<span style="display:block;">
				<a href="tel:+<?= $settings['phone']; ?>" class="tel"><?= $settings['phone']; ?></a>
			</span>
			<?php endif; ?>
		</div>
		<nav id="nav">
			<a href="#top">
				<span>Back to Top</span>
			</a>
			<ul>
				<?php foreach($nav_items as $nav): ?>
				<li>
					<a href="<?= $base_path.'/'.$nav->getSlug(); ?>">
						<?= $nav->getLabel(); ?>
					</a>
				</li>
				<?php endforeach; ?>
			</ul>
		</nav>
	</div>
</footer>
</body>
</html>