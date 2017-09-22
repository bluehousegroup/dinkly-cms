<script type="text/javascript">

function updateSortOrder() {
	var data = $('.site-nav').sortable('toArray').join('&&&');
	displaySavingIndicator('Updating position...');
	$.ajax({
	  type: "POST",
	  url: '/cms_admin/pages/update_page_order/', 
	  data: { order: data },
	  success: function(msg) {
	  	hideSavingIndicator();
	  }
	});
}

function saveAndPublish() {
	$('#hidden-publish').val('true');
	saveSubmit();
}

function saveSubmit() {
	//Remove seed row to keep the $_FILES array tidy
	$('.slideshow-input').not(':visible').remove();

	$('#content-form').submit();
}

function deletePage($target) {
	window.location = "/cms_admin/pages/delete/page/"+$('#page_id').val();
}

function autosave() {
	//We need this to move the CKE data into the damn value attribute, totally weird, but works.
	for(var name in CKEDITOR.instances) {
        CKEDITOR.instances[name].updateElement();
    }

    $position = $('#autosave-preview').contents().scrollTop();

	$.ajax({
	  type: "POST",
	  url: '/cms_admin/pages/autosave/page/'+$('#page_id').val(), 
	  data: $('#content-form').serialize(),
	  success: function(msg) {
	  	var currSrc = $("#autosave-preview").attr("src");
		$("#autosave-preview").attr("src", currSrc);

		$('#autosave-preview').load(function() {
	        $('#autosave-preview').contents().scrollTop($position);
	    });
		
	  }
	});
}

//Called directly after an image is uploaded
function handleUploadResponse(response) {
	$('#'+response.input_id).siblings('.hidden-thumb-id').attr('value', response.thumb_id);
	$('#'+response.input_id).siblings('.hidden-original-id').attr('value', response.original_id);
	autosave();
}

$(function () {

	/******************************************************************************** INITIALIZATION */

	//Set up the drag and drop sortable on the feature list
	$('.site-nav').sortable({
		update: function(event, ui) {
			delay(function(){
				updateSortOrder();
			}, 500);
		},
	});

	initUploaders('/cms_admin/pages/image_upload/page/'+$('#page_id').val(), 'handleUploadResponse');

	/******************************************************************************** EVENTS */

	//Intercept escape key to toggle live preview
	$(document).keyup(function(e) {
	  if(e.keyCode == 27) {
	  	// Toggle preview mode
		$('body').toggleClass('live-preview');
		$('.sidebar-left .pad').removeClass('active');
		$('.sidebar-left .page-nav').addClass('active');
		$('.slideshow-block').toggle();
		// $('.image-content').toggle();
		$('.editor-tabs').parents('.nav').find('li:first-child a').click();
	  }
	});

	// Editor tabs
	$('.editor-tabs').on('click','li > a',function() {
		if ($(this).hasClass('toggle-preview')) {
			// Toggle preview mode
			$('body').toggleClass('live-preview');
			$('.sidebar-left .pad').removeClass('active');
			$('.sidebar-left .page-nav').addClass('active');
			$('.slideshow-block').toggle();
			// $('.image-content').toggle();
			$(this).parents('.nav').find('li:first-child a').click();
		}
		else if ($(this).hasClass('toggle-history')) {
			// Show history sidebar
			$('.sidebar-left .pad').removeClass('active');
			$('.sidebar-left .page-revs').addClass('active');
			return false; // ?
		}
		else {
			// Show page nav sidebar
			$('.sidebar-left .pad').removeClass('active');
			$('.sidebar-left .page-nav').addClass('active');
		}
	});

	//Throttle keypressing and trigger autosave
	$('input:text,textarea').keyup($.debounce(500, autosave));
	CKEDITOR.document.on('keyup', $.debounce(500, autosave));

	//Remove image
	$('.remove-image').click(function() {
		$(this).parents('.filedrag').find('.filedrag-filename').html('');
		$(this).parents('.controls').find('img').fadeOut(function() {
			$(this).remove();
		});

		//Empty out image variables
		$(this).parents('.filedrag').find('.hidden-thumb-id').val('');
		$(this).parents('.filedrag').find('.hidden-original-id').val('');

		$(this).fadeOut();

		autosave();

		return false;
	});

	//Remove selected page
	$('.delete-page').click(function() {
		displayConfirmation('Are you sure you with to delete this page?', null, 'deletePage');
	});

	//Make sure a template has been selected before allowing the post
	$('.template-submit').click(function() {
		if($(this).siblings('select').val() != "") { return true; }
		return false;
	});

	//Filename handling and validation for image content
	// $('.input-image').change(function(){
	// 	var filename = $(this).val();
	// 	//Grab the filename, remove fakepath bs if it's there
	// 	filename = filename.replace("C:\\fakepath\\", "");

	// 	//...and the extension
	// 	var ext = filename.substring(filename.lastIndexOf('.') + 1).toLowerCase();

	// 	//Basic validation
	// 	if(ext != 'jpg' && ext != 'png') {
	// 		$('#hidden-bad-message').val('Valid image formats: JPG, PNG');
	// 		displayBadMessages();
	// 	}
	// 	else {
	// 		//Hide the previous image, if there was one
	// 		$(this).parents('.controls').find('.image-content-image').hide();

	// 		//Good to go, pop the filename into the label
	// 		$(this).parents('.fileinput-button').siblings('.image-filename').html(filename);

	// 		//Display remove button
	// 		$(this).parents('.controls').find('.remove-image').fadeIn();
	// 	}
	// });

	//Filename handling and validation for slideshow content
	$('.input-slideshow-image').change(function(){
		//Grab the new slide button, we'll be toggling its display later
		$new_slide_button = $(this).parents('.controls').find('.new-slide');

		//We need this too, to hide the button once an image is selected
		$button_span = $(this).parents('.fileinput-button');

		//And also the filename label
		$image_label = $button_span.siblings('.image-slideshow-filename');

		//Grab the filename, remove fakepath bs if it's there
		var filename = $(this).val();
		filename = filename.replace("C:\\fakepath\\", "");

		//...and the extension
		var ext = filename.substring(filename.lastIndexOf('.') + 1).toLowerCase();

		//Basic validation
		if(ext != 'jpg' && ext != 'png') {
			$('#hidden-bad-message').val('Valid image formats: JPG, PNG');
			displayBadMessages();
		}
		else {
			//Good to go, pop the filename into the label
			$button_span.fadeOut(function() {
				$image_label.html(filename).fadeIn();
				$new_slide_button.fadeIn();
			});
		}
	});

	//Display file input for slideshow content
	$('.new-slide').click(function() {
		//We start by hiding the button - we won't need it again until an image has been selected
		$(this).fadeOut();

		//Grab the first input row (it becomes our template)
		$slideshow_input_row = $(this).parents('.controls').find('.slideshow-input:first');

		//This is the array of rows we'll be adding to
		$slideshow_rows = $(this).parents('.controls').find('.slideshow-rows');

		//Fade things nicely if the placeholder row is visible (only happens when the slideshow is empty)
		if($('.slideshow-placeholder').is(':visible')) {
			$('.slideshow-placeholder').fadeOut('fast', function() {
				$slideshow_rows.append($slideshow_input_row.clone(true).hide().fadeIn());
			});
		}
		else { $slideshow_rows.append($slideshow_input_row.clone(true).fadeIn()); }

		return false;
	});

	//Remove a slide from the slideshow (a slide that has yet to be saved)
	$('.remove-input-slide').click(function() {
		//Grab the relevant row, fade it out, remove it
		$slideshow_row = $(this).parents('.slideshow-input');

		$slideshow_row.fadeOut('fast', function() {
			//Check to see if this row had an image attached, if not, we'll need to redisplay the 'add slide' button
			if($slideshow_row.find('.image-slideshow-filename').html() == "") {
				$slideshow_row.parents('.slideshow-block').find('.new-slide').fadeIn('fast');
			}

			//We're done with the row, nix it
			$slideshow_row.remove();

			//Check to see if the table now appears empty, in which case we'll fade back in the placeholder
			if($('.slideshow-slide').length == 1) {
				$('.slideshow-placeholder').fadeIn('fast');
			}
		});

		return false;
	});

	//Remove a slide from the slideshow (an existing slide)
	$('.remove-existing-slide').click(function() {
		//Grab the relevant row, fade it out, remove it
		$slideshow_row = $(this).parents('.slideshow-slide');

		$slideshow_row.fadeOut('fast', function() {
			$slideshow_row.remove();

			//Check to see if the table now appears empty, in which case we'll fade back in the placeholder
			if($('.slideshow-slide').length == 1) {
				$('.slideshow-placeholder').fadeIn('fast');
			}
		});

		return false;
	});

	//add_employee button creates additional fields to add another employee
	$('#add_employee').click(function(e) {
		e.preventDefault();
		number = parseInt($("#total_emplyees").val()) + 1;
		$("#employee_container").append('<div id="employee_'+number+'"><div class="control-group"><label class="control-label">Employee '+number+' <i class="icon icon-remove remove-employee" data="'+number+'"></i></label><div class="controls"><input type="text" class="input-block-level" name="content&&&employees&&&about_employees&&&employees['+number+'][name]" id="name" value="" placeholder="Name"></div></div><div class="control-group"><label class="control-label"></label><div class="controls"><input type="text" class="input-block-level" name="content&&&employees&&&about_employees&&&employees['+number+'][position]" id="position" value="" placeholder="Position"></div></div><div class="control-group"><label class="control-label"></label><div class="controls"><textarea class="input-block-level" rows="5" name="content&&&employees&&&about_employees&&&employees['+number+'][bio]" id="bio" placeholder="Bio"></textarea></div></div></div>');
		$("#total_emplyees").val(number);
	});

	//remove-employee
	$("body").on("click", ".remove-employee", function(e){
		e.preventDefault();
		id = $(this).attr("data");
		$("#employee_"+id).html("");
	});

});
</script>