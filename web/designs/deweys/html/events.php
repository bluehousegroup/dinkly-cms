<section id="events" class="section section-events">
	<div class="container-fluid">
		<div class="section-header">
			<h1><?php echo $settings['page_title']; ?></h1>
		</div>
		<div class="section-content">
			<?php if($events_image1->getOriginalId()): ?>
			<img src="<?php echo $events_image1->getOriginalSource(); ?>" alt="">
			<?php endif; ?>
			<div class="events-content">
				<div class="pad">
					<?php echo $events_text->getHtml(); ?>
				</div>
			</div>
			<div class="events-list">
				<div class="pad">
					<?php foreach($event->getEvents() as $event): ?>
						<h3><?php echo $event->getTitle() ?></h3>
						<h4 class="date"><?php echo $event->getStartDatetime("F j, Y g:ia"); ?><?php echo ($event->getEndDatetime()) ? " - " . $event->getEndDatetime("F j, Y g:ia") : "" ?></h4>
						<p><?php echo $event->getDescription() ?></p>
					<?php endforeach;?>
				</div>
			</div>
		</div>
	</div>
</section>