<div class="banner custom">
	<div class="banner-wrap">
		<h1><?php echo $settings['page_title']; ?></h1>
	</div>
	<?php if($events_header->getOriginalSource()): ?>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">
				<div class="content-block">
					<img src="<?php echo $events_header->getOriginalSource(); ?>" />
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>
</div>
<section id="main" class="custom-content">
	<div class="main-content">
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="span12">
					<div class="inner-wrap">
						<div class="content-block"><h2>Upcoming Events</h2>
							<div class="events">
								<?php foreach ($events as $event): ?>
									<div class="event">
										<h4 class="date"><?php echo $event->getStartDatetime("F j, Y g:ia"); ?><?php echo ($event->getEndDatetime()) ? " - " . $event->getEnddatetime("F j, Y g:ia") : "" ?></h4>
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
		</div>
	</div>
</section>