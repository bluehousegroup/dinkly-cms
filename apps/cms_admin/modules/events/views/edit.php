<?php
/*
Post value 'today' actually refers to on day of Event
*/
?>
<div id="main" role="main">
	<div id="content">
		<div class="content-wrapper has-header">
			<?php include_once('../apps/cms_admin/layout/messaging.php'); ?>
			<div class="content-header clearfix">
				<h2 class="pull-left">Manage Events <span class="loading" style="display: none;"></span></h2>
				<div class="pull-right">
					<?php if ($event && $event->getIsPublished()): ?>
						<a class="btn save-event" data-publish="0" >Unpublish Event</a>
					<?php else: ?>
						<a class="btn save-event" data-publish="1" >Save and Publish Event</a>
					<?php endif; ?>
					<a target="_blank" href="/site/<?php echo $site->getDomain()."/events"; ?>" class="btn">View Draft Site</a>
				</div>
			</div>
			<div class="content-body">
				<?php
				//include sidebar-left
				include_once('../apps/cms_admin/modules/events/views/sidebar-left.php'); ?>
				<form id="content-form" class="editor-form form-horizontal clearfix" action="/cms_admin/events/edit" method="post" enctype="multipart/form-data">
					<div class="content-editor scrollable">
						<div class="pad">
							<div class="form-left">
								<div class="collapse-wrap" id="event-panel">
									<a href="javascript:void(0)" class="collapse-trigger">
										<span>Event Details</span>
										<i class="icon"></i>
									</a>
									<div class="collapse-body">
										<?php
										//include event-detail form
										include_once('../apps/cms_admin/modules/events/views/event-detail-form.php');
										?>
									</div>
								</div>
								<?php if($anyAuthed): ?>
								<div class="collapse-wrap closed" id="social-panel">
									<a href="javascript:void(0)" class="collapse-trigger">
										<span>Social Media Reminder Settings</span>
										<i class="icon"></i>
									</a>
									<div class="collapse-body">
										<?php
										//include social posting guff
										include_once('../apps/cms_admin/modules/events/views/social-post-settings.php');
										?>
									</div>
								</div>
								<?php endif; ?>
							</div>
							<aside class="sidebar-right">
								<div class="pad">
									<div class="fixed-content social-info">
										<?php // if at least one social module is authed
										if($anyAuthed): ?>
										<p>We can send out reminders via social media to your followers automatically.  You have given us permission to post to the following platforms:</p>
										<ul class="platform-summary">
											<?php
											foreach($authServices as $service => $auth)
											{
												echo ($auth) ? '<li>'.ucfirst($service)."</li>" : "";
											}
											?>
										</ul>
										
										<?php // if all possible modules are authed don't ask them to auth more
										if(!$allAuthed): ?>
											<?php if(stristr($_SERVER['HTTP_HOST'], "localhost")): ?>
												<h6>(Social Media requires you use 127.0.0.1 instead of localhost)</h6>
											<?php else: ?>
												<a href="/cms_admin/settings/socialIntegration" class="auth-exit btn btn-primary">Authorize More</a>
											<?php endif; ?>
										<?php endif; ?>

										<h4>Social Media Reminders</h4>
										<p>Posting to these platforms will occur according to the following schedule</p>
										<div class="reminder-schedule-summary">
											<ul></ul>
										</div>
										<a href="javascript:void(0)" class="edit-schedule btn">Edit Reminder Schedule</a>

										<?php // if no modules are authed, display callout to auth
										else: ?>
										<!-- get more exposure notification -->
										<p class="auth-callout">
											<?php if(stristr($_SERVER['HTTP_HOST'], "localhost")): ?>
												<h6>(Social Media requires you use 127.0.0.1 instead of localhost)</h6>
											<?php else: ?>
												<h4>Get more exposure with social media!</h4>
												<p>If you've got social media accounts we can send out reminders to your audience automatically.  This saves you time and increases the amount of potential customers you reach with the news!</p>
												<a href="/cms_admin/settings/socialIntegration" class="btn btn-primary auth-exit">Get Started!</a>
											<?php endif; ?>
										</p>
										<?php endif; ?>
									</div>
								</div>
							</aside>
						</div>
					</div>
					<input type="hidden" name="posted" value="true" />
					<input type="hidden" id="id" name="id" value="<?= ($event) ? $event->getId() : "" ?>" />
					<input type="hidden" name="publish" id="hidden-publish" value="0" />
					<input type="hidden" name="post_schedule" id="post_schedule" value='<?= (isset($post) && trim($post) !== "") ? $post : "" ?>' />
					<input type="hidden" name="event_repeating" id="event_repeating" value='<?= ($event) ? $event->getRepeating() : "" ?>' />
					<div id="cleanCKEDITOR" style="display: none;"></div>
					<div class="content-editor-actions">
						<div class="pad">
							<button class="btn btn-primary save-button save-event" data-publish="<?= ($event) ? $event->getIsPublished() : 0 ?>" data-loading-text="Saving...">Save</button>
							<a href="/cms_admin/events/edit/event/<?= ($event) ? $event->getId() : "" ?>" class="btn">Cancel</a>
							<?= ($event) ? "<a href='#/cms_admin/events/delete/event/" . $event->getId() . "' class='delete-event btn btn-danger pull-right'>Delete Event</a>" : "" ?>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	/*
	Events Page Functions
	*/

	/* CRUD */

	//Post event content to controller to be saved as a JSON string
	function saveSubmit(doPublish) {
		$('#hidden-publish').val(doPublish);
		$("#repeating").val(JSON.stringify(getEventRepeating()));

		/* Save social media post if it's set */
		$("#post_schedule").val(JSON.stringify(generateScheduleObj()));

		//Submit holder form to POST to controller
		$('#content-form').submit();
		return false;
	}

	// Save event before redirecting to auth social media
	function draftSave() {
		var data = {
			id: $("#id").val(),
			title: $("#title").val(),
			location: $("#location").val(),
			description: $("#event_description").val(),
			start_date: $("#start_date").val(),
			start_time: $("#start_time").val(),
			end_date: $("#end_date").val(),
			end_time: $("#end_time").val(),
			repeating: $('#repeating').val(),
			publish: 0,
			post_schedule: JSON.stringify(generateScheduleObj())
		};

		$.post("/cms_admin/events/saveDraft", data, function(response) {
			//console.log(response);
		});
	}

	//Call event controller to delete event
	function deleteEvent() {
		window.location = $(".delete-event").attr('href').substr(1);
	}

	/* Repeating */

	//Generate an array of days selected for 'Specific' recurring events
	function getDays() {
		var days = new Array();

		$('.repeating_days input[type="checkbox"]').each(function(i, e) {
			if($(e).prop('checked'))
				days.push($(e).attr('name'));
		});

		return days.join(",");
	}

	function getEventRepeating() {
		if($('#enable_repeating').prop('checked')) {
			return {
				repeating_type: $('#repeating_type').val(),
				repeating_days: this.getDays()
			};
		}
		else
			return null;
	}

	/*
	Social Media Functions
	*/
	function redirectToAuth() {
		draftSave();
		window.location.href = $(".auth-exit").attr("href");
		return false;
	}

	/* Content editing */

	function makeContentResponsive() {
		//Pre-fill social media post
		//Due to jQuery callbacks referencing the element as this, SocialMediaJS needs to be used explicitly
		$("#title").on("keyup", defaultPostMessage);
		$("#location").on("keyup", defaultPostMessage);
		$("#start_date").on("keyup", defaultPostMessage);
		$("#start_time").on("keyup", defaultPostMessage);
		CKEDITOR.document.textContent = ($("#event_description").val());
		CKEDITOR.document.on('keyup', $.debounce(500, defaultPostMessage));
		this.generateScheduleObj($("#post_schedule").val());
		this.defaultPostMessage();
		$("#social_post_msg").on("keyup", function() {
			if($(this).val().length <= 0)
			{
				customMessage = false;
			}
		});
	}

	function defaultPostMessage()
	{
		if(window.customMessage !== true)
		{
			var startDate = $("#start_date").val() + " " + $("#start_time").val();

			//Build message
			var message = $("#title").val();
			if($.trim($("#location").val()) !== "") {
				message += "\n" + $("#location").val();
			}
			if($.trim(startDate) !== "") {
				message += "\n" + startDate;
			}

			//Grab data from CKEDITOR
			$("#cleanCKEDITOR").html(CKEDITOR.document.textContent);
			var desc = $("#cleanCKEDITOR").text();
			if(desc !== "") {
				message += "\n" + desc;
			}

			// If the default message is too long to be posted to twitter
			// Truncate it with space for "..."
			if(message.length > 117) {
				message = message.substring(0, 117) + "...";
			}

			$("#social_post_msg").val(message);
			setSocialMsgCount();
		}
	}

	/* Schedule construct/view */

	//This function will either generate an object which can be json encoded to be saved with an event
	//or initalize the social media reminder settings
	function generateScheduleObj($json) {
		var scheduleObj = { };
		if(typeof $json === "undefined" || $.trim($json) === "") {
			//Generate object from social media schedule
			//only if the user actually enabled the post
			if($('.social-toggle').hasClass('checked')) {

				//Get schedule weeks, days, months, minutes
				$schedule = $(".reminder-schedule-summary");
				$schedule.find("li").each(function(i, e) {
					var values = $(e).html().split(" ");
					if(values[0] !== "Today")
						scheduleObj[values[1]] = values[0];
				});

				//Get start date
				scheduleObj['start_date'] = $("#start_date").val() + " " + $("#start_time").val();

				//Get selected services
				scheduleObj['services'] = new Array();
				$(".social-toggle.checked").each(function(i, e) {
					scheduleObj['services'].push($(e).data('service'));
				});

				//Set if posting today
				if($("#post-today").prop("checked"))
					scheduleObj['today'] = 1;
				else
					scheduleObj['today'] = 0;

				//set message
				scheduleObj['message'] = $("#social_post_msg").val();
				scheduleObj['id'] = "event:"+$("#id").val();
				scheduleObj['customMessage'] = window.customMessage;
			}
		} else {
			//Initialize social media schedule
			scheduleObj = JSON.parse($json);

			//Iniitialize all social variables other than the <ul> of days, weeks, etc.
			customMessage = scheduleObj['customMessage'];
			//Check services
			scheduleObj['services'].forEach(function(e, i, a) {
				$("."+e).addClass("checked");
			});
			//Toggle posting today
			if(scheduleObj['today'] === "1")
				$("#post-today input").prop("checked", true);
			else
				$("#post-today input").prop("checked", false);
		}

	return scheduleObj;
	}

	function removeBlankReminders() {
		$('li.editing-row li:not("li.post-today") input').each(function(){
			if($(this).val() == ''){
				$(this).parents('li.schedule-input-group').remove();
			}
		});
	}

	// Build summary string based off of selected social recursion values
	function buildSummaryString(reminders, name) {
		var str = "";
		if(reminders[name] == "undefined" || reminders[name].length <= 0)
			return false;
		reminders[name].forEach(function(e, i, a) {
			str += e + ", ";
		});
		return str.substring(0, str.length - 2);
	}

	function buildScheduleSummary() {
		//Grab a handle on the <ul> of weeks, days, etc.
		$scheduleEditor = $("ul.scheduling-grid li.editing-row");

		reminders = new Array();
		//Loop over inputs
		$scheduleEditor.find(".schedule-input-group").each(function(i, e) {
			//Grab input key/values
			key = $(e).find('option:selected').val();
		    value = $(e).find('input[type="number"]').val();

		    //Add input data to summary
		    if(value != "") {
			    if(reminders[key] == null)
					reminders[key] = new Array();
				reminders[key].push(value);
			}
		});

		//Get a handle on the summary on page
		var $r = $(".reminder-schedule-summary ul");
		//Clear any summary data currently on page
		$r.html("");
		//Loop over summary data
		for(key in reminders) {
			//configure data as string and display on page
			var str = this.buildSummaryString(reminders, key);
			if(str)
				$r.html($r.html() + "<li>"+reminders[key]+" "+key+" before event</li>");
		}
		//Display if posting today as well.
		if($("#post-today").prop("checked"))
			$r.html($r.html() + "<li>On Publish of Event</li>");
	}

	function restoreScheduleDefault(schedule)
	{
		$this = this;
		var scheduleTypes = new Array('weeks', 'days', 'hours', 'minutes');
		for(var type in schedule) {
			if((schedule[type] !== null && typeof schedule[type] !== undefined) && $.inArray(type, scheduleTypes) !== -1) {
				values = schedule[type].split(',');
				values.forEach(function(value, i, a) {
					$this.cloneScheduleElement(value, type)
				});
			}
		}
		$('#post-today').prop('checked', 'true');
		this.buildScheduleSummary();
	}

	/* Schedule UI */

	//toggle interface for editing reminders
	function editReminderSchedule() {
		$('ul.scheduling-grid li.editing-row, ul.scheduling-grid li.schedule-actions').slideToggle(function() {
			var oldColor = $(this).css('background');
			if($(this).css('display') != 'none') {
				$(this).animate({'background': 'red'}, 300, function() {
					$(this).animate({'background': oldColor}, 300);
				});
			}
		});

		if($(".edit-schedule").hasClass('editing')) {
			$(".edit-schedule").removeClass('editing btn-primary').html('Edit Reminder Schedule');
			this.removeBlankReminders();
			this.buildScheduleSummary();
			this.saveSocialPost();
		} else {
			$(".edit-schedule").addClass('editing btn-primary').html('Save Scheduling');
		}
	}

	function setSocialMsgCount() {
		var twitterCount = 120 - $("#social_post_msg").val().length,
			facebookCount = 420 - $("#social_post_msg").val().length;

		if(twitterCount < 0)
			$("#twitter_count").css('color', 'red');
		else
			$("#twitter_count").css('color', '');
		if(facebookCount < 0)
			$("#facebook_count").css('color', 'red');
		else
			$("#facebook_count").css('color', '');

		$("#twitter_count").html(twitterCount);
		$("#facebook_count").html(facebookCount);
	}

	function selectScheduleValues(value, type, inputClone) {
		inputClone.find('input').val(value);
		inputClone.find("option").each(function(i,e) {
			$e = $(e);
			if($e.val() == type){
				$e.prop("selected", true);
			}
		});
	}

	function cloneScheduleElement(value, type) {
		var inputClone = $('ul.defaults-2-clone li.clone-me').clone().removeClass('clone-me');
		inputClone.insertAfter('.editing-row li:last-child', this.selectScheduleValues(value, type, inputClone));
	}

	function addReminder() {
		$('ul.defaults-2-clone li.clone-me').clone().hide().insertAfter('.editing-row li:last-child').slideDown().removeClass('clone-me');
	}

	/* Saving */

	function saveSocialPost() {
		var data = {
			id: $("#id").val(),
			post_schedule: JSON.stringify(generateScheduleObj())
		};

		$.post("/cms_admin/events/saveSocialPost", data, function(response) {
			//console.log(response);
		});
	}

	/*
	Page load
	*/
	$(function() {
		collapsingInterface.init();

		/******************************************************************************** INITIALIZATION */
		/*
		Events Page
		*/
		// On load of event, initalize recurring controls
		if(typeof $('#event_repeating').val() !== "undefined" && $('#event_repeating').val() !== "" && $('#event_repeating').val() !== "null")
		{
			var $json = JSON.parse($('#event_repeating').val());
			$('#enable_repeating').prop('checked', true);
			$('#repeating_type').val($json['repeating_type']);
			if($json['repeating_days'] !== null) {
				$json['repeating_days'].split(",").forEach(function(e, i, a) {
					$('#' + e).prop('checked', true);
				});
			}
			$("#repeating_type").slideToggle(3);
			if($("#repeating_type").val() === "Specific") {
				$("#repeating_days").slideDown(3);
			}
		}

		/*
		Social Media
		*/
		var defaultSchedule = {
			"minutes": "5",
			"hours": null,
			"days": "1,3,5",
			"weeks": "1"
		};

		if($("#social-panel").length > 0) {
			$("#social_post_msg").on("keyup", function() {
				window.customMessage = true;
			});

			//Initialize the schedule
			if($("#post_schedule").val())
				restoreScheduleDefault(generateScheduleObj($("#post_schedule").val()));
			else
				restoreScheduleDefault(defaultSchedule);

			//Make Social Media UI reactive to changes in Event
			makeContentResponsive();
		}

		/******************************************************************************** EVENTS */
		/*
		Events Page
		*/
		/* UI Events */
		// Hide/show social media recursion controls
		$("#enable_repeating").click(function() {
			$(".repeating_type").slideToggle(3);
			if(!$(this).prop('checked'))
				$(".repeating_days").slideUp(3);
			if($(this).prop('checked') && $(".repeating_type").val() == "Specific")
				$(".repeating_days").slideDown(3);

		});

		// Hide/show specific day checkboxes for social media modal
		$(".repeating_type").change(function() {
			if($(this).find(":selected").val() == "Specific") {
				$(".repeating_days").slideDown(3);
			} else {
				$(".repeating_days").slideUp(3);
				$('.repeating_days input[type="checkbox"]').each(function(i, e) {
					$(this).prop('checked', false);
				});
			}
		});

		/* Event Saving */
		$(".save-event").click(function(e) {
			e.preventDefault();
			saveSubmit($(this).data("publish"));
			return false;
		});

		// Display confirmation before deleting event
		$(".delete-event").on('click', function(e) {
			e.preventDefault();
			displayConfirmation('Are you sure you with to delete this event?', null, 'deleteEvent');
			return false;
		});

		// Save event
		// Redirect to authenticate social media
		$(".auth-exit").on("click", function(e) {
			e.preventDefault();
			displayConfirmation('Do you want to redirect to the Social Authentication page? Your event will be saved as a draft.', null, 'redirectToAuth');
			return false;
		});

		/*
		Social Media
		*/
		//button.restore-defaults removes all current scheduling and replaces them with a clone from div.defaults-2-clone
		$('#social-panel').on('click', 'button.restore-defaults', function(e){
			e.preventDefault();
			$('ul.scheduling-grid li.schedule-input-group').remove();
			restoreScheduleDefault(defaultSchedule);
			$('li.post-today input.checkbox').prop('checked');
		})
		//button.add-reminder clones li.clone-me - a standard schedule-input-group template
		.on('click', 'button.add-reminder', function(e){
			e.preventDefault();
			$('ul.defaults-2-clone li.clone-me').clone().hide().insertAfter('.editing-row li:last-child').slideDown().removeClass('clone-me');
		})
		//a.remove-reminder removes the corresponding schedule-input-group
		.on('click', 'a.remove-reminder', function(){
			//if time animate this
			$(this).parent().slideUp(400, function(){
				$(this).remove();
			});
		});

		// Toggle social media checked/unchecked
		// i.e. check/uncheck facebook or twitter
		$('button.social-toggle').on('click', function(e) {
			e.preventDefault();
			if(!$(this).hasClass('no-auth')) {
				$(this).toggleClass('checked', function() {
					$(this).find('i.icon.checker').removeClass('icon-check icon-check-empty');
					if($(this).hasClass('checked')) {
						$(this).find('.checked-val-target').val('true');
						$(this).find('i.icon.checker').addClass('icon-check');
					} else {
						$(this).find('.checked-val-target').val('false');
						$(this).find('i.icon.checker').addClass('icon-check-empty');
					}
				});
			} else {
				//Redirect to settings auth page if service unchecked
				displayConfirmation('Do you want to redirect to the Social Authentication to enable '+$(this).data('service')+'? Your event will be saved as a draft.', null, 'redirectToAuth');
			}
			return false;
		});

		$(".edit-schedule").on('click', function(e) {
			e.preventDefault();
			if($(this).parents('.sidebar-right').length > 0){
				collapsingInterface.closeBody($('.collapse-wrap:not(#social-panel)'));
				collapsingInterface.openBody($('#social-panel'));
			}
			editReminderSchedule();
			return false;
		});

		$(".add-reminder").on('click', function(e) {
			e.preventDefault();
			addReminder();
			return false;
		});
	});
</script>
