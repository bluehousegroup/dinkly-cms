$(function() {

	$('#tickets').dataTable({});

	$("body").on("click", ".ticket_submit", function(e){
		e.preventDefault();

		$context = $(this).parents('.reveal-modal');

		//validate form
		if($context.find(".ticket_subject").val() !== "" && $context.find(".ticket_message").val() !== "")
		{
			//post values to end point ticket_post
			$.post("/cms_admin/mini_ticket/TicketAjax", {
				'type' : 'ticket',
				'subject' : $context.find(".ticket_subject").val(),
				'message' : $context.find(".ticket_message").val()
			}, function(msg) {
				if(msg == "Success"){
					$('.close-reveal-modal').trigger('click'); //close dialogue
					$context.find(".ticket_subject").val('');
					$context.find(".ticket_message").val('');
					$context.find(".ticket_submit").click(true);
					alert("Thanks for submitting your ticket. We are totally on it.");
					location.reload();
				}
				else alert("Oops, something went wrong!");
			});
		}
		else alert("Both subject and message are required.");
	});

	$('body').on("change", ".update_status", function(e) {
		//post values to end point ticket_post
		$.post("controller.php", {
			'type' : 'status',
			'ticket_id' : $("#ticket_id").val(),
			'status' : $(".update_status").val()
		}, function(msg) {
			if(msg=="Success") alert("Ticket status succesfully updated.");
			else alert("There was an error updating the ticket.");
		});
	});

	$('body').on("click", "#comment_submit", function(e) {
		e.preventDefault();
		$("#comment_form").submit();
	});

});