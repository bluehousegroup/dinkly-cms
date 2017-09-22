<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="author" content="Bluehouse Group" />
    <meta name="keywords" content="<?php echo $settings['meta_keywords']; ?>" />
    <meta name="description" content="<?php echo $settings['meta_description']; ?>">
    <meta name="viewport" content="initial-scale=1.0, width=device-width" />
    <link href="/designs/elegant/css/default.css" rel="stylesheet" />
    <link href="/designs/elegant/css/style.css" rel="stylesheet" />
    <style><?php echo $settings['site_custom_css']; ?></style>
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script type="text/javascript" src="/designs/table34/js/lib/jquery-1.9.1.min.js"></script>
    <?php if($settings['page_title']=='Directions'): ?>
    <script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA3KtsW-VipTtJNNpj0jtlYKxY0r_z79Kg&amp;sensor=false">
    </script>
    <?php endif; ?>
    <title><?php echo ($settings['meta_title']) ? $settings['meta_title'] : $settings['page_title']; ?></title>
  </head>
  <body>
    <?php if($is_draft): ?>
        <div id="draft-message" class="draft-label">Viewing Draft Site</div>
    <?php endif; ?>
    <div class="background">
      <span>Background Image</span>
    </div>
    <header>
      <nav>
        <div class="inside">
          <div class="logo">
            <a href=""><img src="/designs/elegant/img/logo.png" alt="Elegant" /></a>
            <div>
              <a href="#nav">
                <span></span>
                <span></span>
                <span></span>
              </a>
            </div>
          </div>
          <ul>
            <?php foreach($nav_items as $nav): ?>
              <li><a href="<?php echo $base_path; ?>/<?php echo $nav->getSlug(); ?>"><?php echo $nav->getLabel(); ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>
        <div class="spreader"></div>
      </nav>
      <div class="contact">
        <div class="inside">
          <span class="social">
            <a href=""><img src="" alt="Like us on Facebook!" /></a>
            <a href=""><img src="" alt="Follow us on Twitter!" /></a>
          </span>
          <?php if($settings['address'] OR $settings['city'] OR $settings['state']): ?>
            <span><?php echo $settings['address']; ?><?php if($settings['address'] AND ($settings['city'] OR $settings['state'])): ?>,<?php endif; ?></span>
            <span><?php echo $settings['city']; ?> <?php echo $settings['state']; ?></span>
            <?php if($settings['phone']): ?>
              <span><a href="tel:+<?php echo $settings['phone']; ?>" class="tel"><?php echo $settings['phone']; ?></a></span>
            <?php endif; ?>
          <?php endif; ?>
          <a href="">Make a Reservation</a>
          <span class="social hide">
            <a href=""><img src="" alt="Like us on Facebook!" /></a>
            <a href=""><img src="" alt="Follow us on Twitter!" /></a>
          </span>
          <div style="clear: both;"></div>
        </div>
      </div>
    </header>