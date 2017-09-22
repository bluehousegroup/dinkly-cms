		<footer id="footer">
			<div class="container-fluid">
				<div class="row-fluid">				
					<div class="span3 footer-left">
						<div class="inner-wrap">
							<span>
								<?php echo $settings['address']; ?><?php if($settings['address'] AND ($settings['city'] OR $settings['state'] OR $settings['zipcode'])): ?>,<?php endif; ?>
								<?php echo $settings['city']; ?>
								<?php echo $settings['state']; ?>
								<?php echo $settings['zipcode']; ?>
							</span>
							<span><a class="tel" href="tel:+<?php echo $settings['phone']; ?>"><?php echo $settings['phone']; ?></span>
						</div>
					</div>
					<div class="span9 footer-right">
						<div class="inner-wrap clearfix">
							<ul class="nav footer-main">
								<?php foreach($nav_items as $nav): ?>
									<li><a href="<?php echo $base_path; ?>/<?php echo $nav->getSlug(); ?>"><?php echo $nav->getLabel(); ?></a></li>
								<?php endforeach; ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="container-fluid">
				<div class="row-fluid">	
					<div class="span4 offset8">
						<div class="inner-wrap clearfix">
							<ul class="nav footer-util">
								<?php if(isset($settings['social_twitter']) AND $settings['social_twitter'] != ""): ?>
									<li class="twitter"><a href="<?= $settings['social_twitter']; ?>" target="_blank"><img src="/designs/pizza/img/twitter.gif" /></a></li>
								<?php endif; ?>
								<?php if(isset($settings['social_facebook']) AND $settings['social_facebook'] != ""): ?>
									<li class="facebook"><a href="<?= $settings['social_facebook']; ?>" target="_blank"><img src="/designs/pizza/img/facebook.gif" /></i></a></li>
								<?php endif; ?>
							</ul>
						</div>
					</div>
				</div>
				<div class="pull-right"><a href="http://fourtopper.com">Bring More to the Table with Fourtopper</a></div>
			</div>
		</footer>
	</body>
</html>






