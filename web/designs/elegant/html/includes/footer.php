    <footer>
      <div class="inside">
        <span class="contact">
          <span class="social">
            <a href=""><img src="" alt="Like us on Facebook!" /></a>
            <a href=""><img src="" alt="Follow us on Twitter!" /></a>
          </span>
        <?php if($settings['address'] OR $settings['city'] OR $settings['state']): ?>
          <?php echo $settings['address']; ?><?php if($settings['address'] AND ($settings['city'] OR $settings['state'])): ?>,<?php endif; ?>
          <?php echo $settings['city']; ?>
          <?php echo $settings['state']; ?>
          <?php if($settings['phone']): ?>
              <a href="tel:+<?php echo $settings['phone']; ?>" class="tel"><?php echo $settings['phone']; ?></a>
          <?php endif; ?>
        <?php endif; ?>
        <nav id="nav">
          <ul>
            <?php foreach($nav_items as $nav): ?>
                <li><a href="<?php echo $base_path; ?>/<?php echo $nav->getSlug(); ?>"><?php echo $nav->getLabel(); ?></a></li>
            <?php endforeach; ?>
          </ul>
        </nav>
      </div>
      <div class="madewith">
        <div class="inside">
          <a href="">Websites for Restaurants by <img src="/designs/elegant/img/fourtopper.png" alt="Four Topper" /></a>
        </div>
      </div>
    </footer>
  </body>
</html>