    <section class="inside">
      <h1 class="pagetitle"><?php echo $settings['page_title']; ?></h1>
      <div class="page">
        <?php if($catering_image->getOriginalSource()): ?>
          <div style="background-image: url(<?php echo $catering_image->getOriginalSource(); ?>); background-position: 50% 50%; background-repeat: none; background-size: cover; height: 400px; width: 100%:"></div>
        <?php endif; ?>
        <?php if($catering_header_text->getHTML()): ?>
          <h2><?php echo $catering_header_text->getHTML(); ?></h2>
        <?php endif; ?>
        <?php if($catering_text->getHTML()): ?>
          <p><?php echo $catering_text->getHTML(); ?></p>
        <?php endif; ?>
      </div>
    </section>