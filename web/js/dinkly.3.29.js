$(document).ready(function() {
	$(".message-close").click(function() {
		$(this).parents('.alert').slideUp();
	});

	$('.dinkly-datatable').DataTable({
		//Options
	});
});