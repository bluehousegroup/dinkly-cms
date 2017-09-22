$(function() {

  // Hide all inactive section panes
  $('.section-pane').filter(':not(:first-child)').hide();

  // Handle section nav clicks
  $('.section').on('click','.section-nav a',function() {

    var target = this.hash,
        $container = $(this).parents('.section'),
        $panes = $container.find('.section-pane'),
        $navlist = $(this).parents('.section-nav'),
        $navitems = $container.find('.section-nav li'),
        $targetnavitems = $container.find('.section-nav a[href$='+this.hash+']').parents('li');

    // Hide all panes and fade in target pane
    $panes.removeClass('active');
    $panes.hide().filter(target).fadeIn().addClass('active');

    // Reset nav state and set active state on all applicable navs
    $navitems.removeClass('active');
    $targetnavitems.addClass('active');

    // If below the content, scroll up to top of content
    if ($navlist.hasClass('bottomnav')) {
      $.smoothScroll({
        scrollTarget: target,
        offset: -50
      });
    }
    // Else no scrolling needed
    else {
      return false;
    }

  });

  // On page load check for hash and display that content
  if (window.location.hash.length) {
    hash = window.location.hash;
    $('.section .section-nav:first a[href$='+hash+']').click();

    $.smoothScroll({
      scrollTarget: hash,
      offset: -50
    });
  }

});