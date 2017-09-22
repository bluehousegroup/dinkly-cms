<div class="banner">
	<div class="banner-wrap" style="background-image:url(../img/sample/deviled-eggs.jpg);">
		<h1><?php echo $settings['page_title']; ?> <span><a class="button" href="#">PDF Menu</a></span></h1>
	</div>
</div>
<div id="main">
	<?php if(count($menu->getMenus()) > 0): ?> 
	<ul class="nav menu-nav">
		<?php foreach($menu->getMenus() as $pos => $m): ?><li><a href="#menu-<?php echo $m->getSlug(); ?>"><?php echo $m->getTitle(); ?></a></li><?php endforeach;?>
	</ul>
	<?php endif; ?>

	<div class="main-content">
		<?php if(count($menu->getMenus()) > 0): ?>
		<?php foreach($menu->getMenus() as $pos => $m): ?>
		<section class="menu-section" id="menu-<?php echo $m->getSlug(); ?>">

			<h2><?php echo $m->getTitle(); ?></h2>
			<div class="menu-category-wrap">

				<?php if(count($m->getGroups()) > 0): ?>
				<?php foreach($m->getGroups() as $group): ?>
				<div class="menu-category">

					<h3><?php echo $group->getTitle(); ?></h3>
					<?php if(count($group->getItems()) > 0): ?>
					<ul class="item-list menu-list">
						<?php foreach($group->getItems() as $item): ?>
						<li>
							<div class="item">
								<h4><?php echo $item->getTitle(); ?></h4>
								<p><?php echo $item->getDescription(); ?> <?php if($item->getPrices() != array()): ?><?php foreach($item->getPrices() as $price): ?><span class="size"><?php echo $price->getTitle(); ?></span> <span class="price"><?php echo $price->getPrice(); ?></span><?php endforeach; ?><?php endif; ?></p>
							</div>
						</li>
					<?php endforeach;?>
					</ul>
					<?php endif; ?>

				</div>
				<?php endforeach;?>
				<?php endif; ?>

			</div>

		</section>
		<?php endforeach;?>
		<?php endif; ?>
	</div>
</div>