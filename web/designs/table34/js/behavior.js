$(function() {

	$('.home-slideshow').flexslider({
		animation: 'fade',
		controlNav: false,
		smoothHeight: true,
		start: function() {
			$('.home-slideshow').resize(); // correct not including caption on first draw
		}
	});

	$('.menu-category:nth-child(odd)').addClass('odd');

	$('.menu-list li:nth-child(odd)').addClass('odd');

	function checkPlaceholderSupport(){
		test=document.createElement('input');
		if('placeholder' in test){
			return true;
		}else{
			return false;
		}
	}

	if(checkPlaceholderSupport()){
		return;
	}else{
		$('form.check-ph-support input[type="text"], input[type="textarea"], input[type="email"], input[type="tel"]').each(function(){
			console.log($(this));
			if(!$(this).val()){
				$(this).val($(this).attr('placeholder'));
			}
		}).focus(function(){
			if($(this).attr('placeholder') != '' && $(this).val() == $(this).attr('placeholder')){
				$(this).val('');
			}
		}).blur(function(){
			if($(this).val()==''){
				$(this).val($(this).attr('placeholder'));
			}
		});
	}

});