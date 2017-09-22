		<section class="vital-info">
			<div class="container-fluid">
				<div class="row-fluid">
					<ul class="boxes-wrapper">
						<li class="hours">
							<div class="inner-wrap">
								<ul>
								
							</ul>
							</div> 
						</li>
						<li class="deliver">
							<div class="inner-wrap">
								<ul class="announce">
								<li><h2 class="Wedo">WE DELIVER</h2></li>
								<li><h2 class="phone"><a href="tel:+<?php echo $settings['phone']; ?>" class="tel"><?php echo $settings['phone']; ?></a></h2></li>
								</ul>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</section>
<section class="main-content">
			<div class="container-fluid">
				<div class=" main-area" style="background: #f6eecf;"> 
<div class="banner">
	<div class="banner-wrap" style="background-image:url(../img/sample/deviled-eggs.jpg);">
		<h1><?php echo $settings['page_title']; ?></h1>
	</div>
</div>
<div id="main">
	<div class="main-content event">
		<?php echo $event_text->getHtml(); ?>
		<h2>Upcoming Events</h2>
		<div class="events">
			<?php foreach ($events as $event): ?>
				<div class="event">
					<h4 class="date"><?php echo $event->getStartDatetime("F j, Y"); ?><?php echo ($event->getEndDatetime()) ? " - " . $event->getEnddatetime("F j, Y") : "" ?></h4>
					<?php if ($isDetail): ?>
						<h3><?php echo $event->getTitle() ?></h3>
						<p><?php echo $event->getDescription() ?></p>
					<?php else: ?>
						<h3><a href="<?php echo $event->getUrl(); ?>"><?php echo $event->getTitle() ?></a></h3>
						<p><?php echo $event->truncate($event->getDescription(), 5) ?></p>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>
</div>
</div>
</section>
		