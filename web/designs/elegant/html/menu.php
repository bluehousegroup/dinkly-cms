<section class="inside">
  <h1 class="pagetitle"><?php echo $settings['page_title']; ?></h1>
  <!-- Menus -->
  <?php if($menu->getMenus() != array()): ?>
    <?php foreach($menu->getMenus() as $pos => $m): ?>
      <div class="page">
      <h2><?php echo $m->getTitle(); ?></h2>
      <!-- Groups -->
      <?php if($m->getGroups() != array()): ?>
        <?php foreach($m->getGroups() as $group): ?>
          <h3><?php echo $group->getTitle(); ?></h3>
          <!-- Items -->
          <?php if($group->getItems() != array()): ?>
            <div class="items">
              <?php foreach($group->getItems() as $item): ?>
                <div class="item">
                  <h3><?php echo $item->getTitle(); ?></h3>
                  <p><?php echo $item->getDescription(); ?></p>
                  <ul>
                    <?php foreach($item->getPrices() as $price): ?>
                    <li>Size <span><?php echo $price->getTitle(); ?></span></li>
                    <li>Price <span>$<?php echo $price->getPrice(); ?></span></li>
                    <?php endforeach; ?>
                  </ul>
                </div>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
        <?php endforeach; ?>
      <?php endif; ?>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</section>