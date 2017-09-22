$(function() {

	// smooth scrolling nav
	$('.navbar .nav a').smoothScroll();
	$('a.next-section').smoothScroll();

	// responsive google map
	if ($('.map-container iframe').length > 0) {
		$map = $('.map-container iframe');

		var h = $map.innerHeight();
		var w = $map.innerWidth();

		$('.map-container').addClass('responsive-map').prepend('<canvas height="'+h+'" width="'+w+'"></canvas>');
	}

});