    <section class="inside">
      <h1 class="pagetitle"><?php echo $settings['page_title']; ?></h1>
      <div class="page">
        <?php if($events_header_text->getHTML()): ?>
          <h2><?php echo $events_header_text->getHTML(); ?></h2>
        <?php endif; ?>
        <?php if($events_text->getHTML()): ?>
          <?php echo $events_text->getHTML(); ?>
        <?php endif; ?>
        <div class="events">
          <?php foreach ($events as $event): ?>
            <div class="event">
              <h4 class="date">
                <?php echo $event->getStartDatetime("F j, Y g:ia"); ?><?php echo ($event->getEndDatetime()) ? " - " . $event->getEnddatetime("F j, Y g:ia") : "" ?>
                <?php echo $event->getLocation(); ?>
              </h4>
              <?php if ($isDetail): ?>
                <h3><?php echo $event->getTitle() ?></h3>
                <p><?php echo $event->getDescription() ?></p>
              <?php else: ?>
                <h3><a href="<?php echo $event->getUrl(); ?>"><?php echo $event->getTitle() ?></a></h3>
                <p><?php echo $event->getDescription(); ?></p>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>