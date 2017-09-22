<?php if($menu->getMenus() != array()): ?>
	<?php foreach($menu->getMenus() as $pos => $m): ?>
	<section id="menu-<?php echo $m->getSlug(); ?>" class="section section-menu <?php echo (($pos)%2) ? 'section-even' : 'section-odd'; ?>">
		<div class="container-fluid">
			<div class="section-header has-menu">
				<h1><?php echo $m->getTitle(); ?></h1>
				<?php if($m->getGroups() != array()): ?>
				<ul class="nav section-nav">
					<?php foreach($m->getGroups() as $pos => $group): ?>
					<li <?php echo ($pos == 0) ? 'class="active"' : ''; ?>><a href="#<?php echo $group->getSlug(); ?>" ><?php echo $group->getTitle(); ?></a></li>
					<?php endforeach;?>
				</ul>
				<?php endif; ?>
			</div>

			<?php if($m->getGroups() != array()): ?>
			<div class="section-content">
				<?php foreach($m->getGroups() as $group): ?>
				<div class="menu-category section-pane active" id="<?php echo $group->getSlug(); ?>">
					<h3><?php echo $group->getTitle(); ?></h3>
					<?php if($group->getItems() != array()): ?>
					<ul class="menu-list item-list">
						<?php foreach($group->getItems() as $item): ?>
						<li class="menu-item">
							<h4><?php echo $item->getTitle(); ?></h4>
							<p><?php echo $item->getDescription(); ?></p>
							<?php if($item->getPrices() != array()): ?>
							<p>
								<?php foreach($item->getPrices() as $price): ?>
								<span class="size"><?php echo $price->getTitle(); ?></span> <span class="price"><?php echo $price->getPrice(); ?></span> 
								<?php endforeach; ?>
							</p>
							<?php endif; ?>
						</li>
						<?php endforeach; ?>
					</ul>
					<?php endif; ?>
				</div>
				<?php endforeach; ?>
			</div>
			<?php endif; ?>

			<div class="section-footer">
				<?php if($m->getGroups() != array()): ?>
				<ul class="nav section-nav bottomnav">
					<?php foreach($m->getGroups() as $pos => $group): ?>
					<li <?php echo ($pos == 0) ? 'class="active"' : ''; ?>><a href="#<?php echo $group->getSlug(); ?>" ><?php echo $group->getTitle(); ?></a></li>
					<?php endforeach;?>
				</ul>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<?php endforeach;?>
<?php endif; ?>