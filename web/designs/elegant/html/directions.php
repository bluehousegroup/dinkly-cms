    <section class="inside">
      <h1 class="pagetitle"><?php echo $settings['page_title']; ?></h1>
      <div class="page">
        <div class="items">
          <?php if($settings['address'] OR $settings['city'] OR $settings['state'] OR $settings['zipcode']): ?>
            <h3> Address </h3>
            <?php echo $settings['Address']; ?><?php if($settings['address'] AND ($settings['city'] OR $settings['state'])): ?><br/><?php endif; ?>
            <?php echo $settings['city']; ?><?php if($settings['city'] AND ($settings['state'])): ?>,<?php endif; ?>
            <?php echo $settings['state']; ?>
          <?php endif; ?>
          <?php if($settings['phone']): ?>
            <?php if($settings['address'] OR $settings['city'] OR $settings['state'] OR $settings['zipcode']): ?>
              <br/>
            <?php endif; ?>
            <?php echo $settings['phone']; ?>
          <?php endif; ?>
          </div>
          <?php if($directions_hours_text): ?>
            <div class="item">
              <h3>Hours</h3>
              <?php echo $directions_hours_text->getHTML(); ?>
            </div>
          <?php endif; ?>
        </div>
        <?php if($directions_text): ?>
          <h2>Directions</h2>
          <p><?php echo $directions_text->getHTML(); ?></p>
        <?php endif; ?>
          <?php if(!empty($settings['address']) AND !empty($settings['city']) AND !empty($settings['state']) AND !empty($settings['zipcode'])): ?>
          <div class="map-block">
            <?php $formattedAddress = $settings['address'].', '.$settings['city'].' '.$settings['state'].' '.$settings['zipcode']; ?>
            <div id="map-canvas" data-address="<?php echo $formattedAddress; ?>" style="background-color: #ddd; color: #222; height: 400px; line-height: 400px; text-align: center; width: 100%:"></div>
          </div>
          <?php endif; ?>
          <div class="map-actions">
            <input type="text" id="starting-location" placeholder="Your location" />
            <button class="button" type="submit" onclick="gmap.calcRoute();">Get Directions</button>
            <div id="directions-wrapper"></div>
          </div>
      </div>
    </section>
<script type="text/javascript" src="/designs/table34/js/mapsInit.js"></script>