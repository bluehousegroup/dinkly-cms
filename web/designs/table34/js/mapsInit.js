var gmap = {
	geocoder: null,
	map: null,
	directionsDisplay: null,
	directionsService: new google.maps.DirectionsService(),
	initialize: function(){
		gmap.directionsDisplay = new google.maps.DirectionsRenderer();
		gmap.geocoder = new google.maps.Geocoder();
		var latlng = new google.maps.LatLng(-34.397, 150.644);
		var mapOptions = {
			zoom: 14,
			center: latlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		}
		map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
		gmap.directionsDisplay.setMap(map);
		gmap.directionsDisplay.setPanel(document.getElementById('directions-wrapper'));
	},
	codeAddress: function(){
		var address = $('#map-canvas').attr('data-address');
		gmap.geocoder.geocode( { 'address': address}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				map.setCenter(results[0].geometry.location);
				var marker = new google.maps.Marker({
					map: map,
					position: results[0].geometry.location
				});
			} else {
				// alert("Geocode was not successful for the following reason: " + status);
				return;
			}
		});
	},
	calcRoute: function(){
		var start = $('#starting-location').val();
		var end = $('#map-canvas').attr('data-address');
		var request = {
			origin: start,
			destination: end,
			travelMode: google.maps.TravelMode.DRIVING
		};
		gmap.directionsService.route(request, function(result, status){
			if(status == google.maps.DirectionsStatus.OK){
				gmap.directionsDisplay.setDirections(result);
				$('#directions-wrapper').html('');
			}
		});
	}
};

$(function(){
	if($('#map-canvas')){
		gmap.initialize();
		gmap.codeAddress();
	}
});