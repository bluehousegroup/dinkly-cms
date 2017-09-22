<div class="banner">
	<div class="banner-wrap">
		<h1><?php echo $settings['page_title']; ?></h1>
	</div>
</div>
<section id="main" class="custom-content">
	<div class="main-content">
		<div class="inner-wrap">
			<?php if (!$isDetail): ?>
			<?php if($events_image->getOriginalSource()): ?>
			<div class="image-block">
				<img src="<?php echo $events_image->getOriginalSource(); ?>" />
			</div>
			<?php endif; ?>
			<?php endif; ?>
			<div class="content-block">
				<?php if (!$isDetail): ?>
				<h2>Upcoming Events</h2>
				<?php endif; ?>
				<div class="events">
					<?php foreach ($events as $event): ?>
						<div class="event">
							<h4 class="date"><?php echo $event->getStartDatetime("F j, Y g:ia"); ?><?php echo ($event->getEndDatetime()) ? " - " . $event->getEndDatetime("F j, Y g:ia") : "" ?></h4>
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
</section>