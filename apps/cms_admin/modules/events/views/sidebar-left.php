<div class="sidebar-left">
	<div class="pad active scrollable">
		<div class="add-event">
			<a href="/site_admin/events/edit" class="btn btn-primary template-submit">Add Event</a>
		</div>
		<ul class="nav nav-pills nav-stacked site-nav">
			<?php if ($events != array()): ?>
				<?php foreach ($events as $sidebarEvent): ?>
					<li id="<?= $sidebarEvent->getId() ?>" data-status="<?= ($event && $sidebarEvent->getIsPublished() == 0) ? 'draft' : 'published' ?>" <?= ($event && $sidebarEvent->getId() == $event->getId()) ? 'class="active"' : '' ?>>
						<a href="/site_admin/events/default/event/<?= $sidebarEvent->getId() ?>"><?= $sidebarEvent->getTitle() ?></a>
					</li>
				<?php endforeach; ?>
			<?php endif; ?>
			<?php if ($events == array()): ?>
				<div id="no-events-message">
					<h4>No events to display.</h4>
				</div>
			<?php endif; ?>
		</ul>
	</div>
</div>