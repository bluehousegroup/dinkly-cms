<!-- signup modal -->
<div id="beta-signup-modal" class="modal hide fade" data-replace="true" tab-index="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="inner-wrap">
		<div class="modal-header clearfix">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Close x</button>
		</div>
		<div class="modal-body">
			<h3>Get Started Today!</h3>
			<form action="" method="post" class="form-horizontal" id="modal-form">
				<p>Just pop in your name, email, and phone number. We'll be in touch to get your site started.</p>
				<input type="text" class="text" id="m-name" placeholder="Name">
				<input type="email" class="text" id="m-email" placeholder="Email">
				<input type="tel" class="text" id="m-tel" placeholder="Phone Number" value="">
				<div class="action">
					<button type="submit" class="btn green freeSiteModal">Start Building My Site!</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div id="contact-form-modal" class="modal hide fade" data-replace="true" tab-index="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="inner-wrap">
		<div class="modal-header clearfix">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Close x</button>
		</div>
		<div class="modal-body">
			<h3>Contact Us!</h3>
			<form action="" method="post" class="form-horizontal" id="contact-form">
				<input id="contact-name" type="text" class="text" placeholder="Name" />
				<input id="contact-email" type="email" class="text" placeholder="Email" />
				<input id="contact-number" type="phone" class="text" placeholder="Phone Number" />
				<textarea id="contact-message" placeholder="Your Message"></textarea>
				<div class="action">
					<button type="submit" class="btn green contactFormModal">Send Message</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div id="submission-success-modal" class="modal hide fade" data-replace="true" tab-index="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="inner-wrap">
		<div class="modal-header clearfix">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Close x</button>
		</div>
		<div class="modal-body">
			<p class="message-target">Message sent successfully</p>
		</div>
		<div class="modal-footer">
			<button class="btn green big" data-dismiss="modal" role="button">Got it!</button>
		</div>
	</div>
</div>
<footer class="">
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span4 footer-left hidden-phone">
				<div class="inner-wrap">
					<ul class="nav nav-list">
						<li><a href="/tour">Tour</a></li>
						<li><a href="/design">Designs</a></li>
						<li><a href="/pricing">Pricing</a></li>
						<li><a href="/meet-us">Meet Us</a></li>
						<li><a href="/blog">Blog</a></li>
					</ul>
				</div>
			</div>
			<div class="span4 footer-right offset3">
				<div class="inner-wrap">
					<h3 class="flourish">Grow Your Restaurant</h3>
					<p>Get proven tips to take your restaurant to the next level.</p>
					<form class="form-horizontal" action="http://fourtopper.createsend.com/t/i/s/ayhy/" id="email-capture-footer">
						<div class="control-group">
							<label class="control-label" for="footer-email">Email:</label>
							<div class="controls">
								<input type="email" class="text" name="cm-ayhy-ayhy" id="footer-email" placeholder="something@example.com">
							</div>
						</div>
						<div class="control-group">
							<div class="controls action">
								<button type="submit" class="btn yellow freeSite">Get More Customers</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="span3 footer-center pull7">
				<div class="inner-wrap clearfix">
					<h3 class="flourish">Get Support</h3>
					<a href="tel:+8024482493" class="tel">(802) 448-2493</a>
					<a href="mailto:help@fourtopper.com" class="email">help@fourtopper.com</a>
					<!-- <a href="#" class="faq-link">FAQ</a> -->
				</div>
			</div>
		</div>
	</div>
</footer>
</div><!-- /.page-container -->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-1071988-49']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<script>
function submitSignup(customer_name, customer_email, customer_tel) {
	$.post("/api/api/signup_submit", { name: customer_name, email: customer_email, phone: customer_tel }, function(msg) {
		if(msg=='Success'){
			window.location = '/signup-thanks';
		}else{
			var submitMessage = "Please forgive us, there was an issue delivering while trying to get you signed up.  Please contact michael [at] bluehousegroup.com so we can get you up and running as soon as possible!";
		}
		$('#submission-success-modal .message-target').html(submitMessage);
		$("#submission-success-modal").modal('show');
	});
}
function submitContact(customer_name, customer_email, customer_tel, customer_message){
	$.post("/api/api/contact_submit", { name: customer_name, email: customer_email, phone: customer_tel, message: customer_message }, function(msg){
		if(msg=="Success"){
			var submitMessage = "Thanks for contacting us, we'll respond as soon as possible!";
		}else{
			var submitMessage = "Please forgive us, there was an issue delivering your message, please contact michael [at] bluehousegroup.com so we can respond to you as soon as possible!";
		}
		$('#submission-success-modal .message-target').html(submitMessage);
		$("#submission-success-modal").modal('show');
	});
}
function submitClientLead(customer_name, customer_email, customer_tel, customer_message){
  $.post('/api/api/submit_client_lead/', {name: customer_name, email: customer_email, phone: customer_tel, message: customer_message}, function(msg){
	    if(msg=="Success"){
	      var submitMessage = "Thanks, we've added you to our lists and we'll be sending you some information shortly!";
	      $.post('http://fourtopper.createsend.com/t/i/s/ayhy/', customer_email, function(data, textStatus){
	      	console.log(textStatus);
	      });
	    }else{
	      var submitMessage = "Please forgive us, there was an issue delivering your message, please contact michael [at] bluehousegroup.com so we can respond to you as soon as possible!";
    }
    $('#submission-success-modal .message-target').html(submitMessage);
		$("#submission-success-modal").modal('show');
  });
}
$(document).ready(function() {
  
	// $("body").on("click", ".freeSite", function(e){
	// 	e.preventDefault();
	// 	if($("#footer-email").val() == "") alert("Email is required");
	// 	else submitSignup(null, $("#footer-email").val(), null);
	// 	_gaq.push(['_trackPageview', 'Footer-Signup', 'Beta', 'Footer - <?php echo $settings["page_title"]; ?>', false]);
	// });

	$("body").on("click", ".freeSiteModal", function(e){
		e.preventDefault();
		if($("#m-email").val() == "") alert("Email is required");
		else submitSignup($("#m-name").val(), $("#m-email").val(), $("#m-tel").val());
		_gaq.push(['_trackPageview', 'Banner-Signup', 'Beta', 'Top Button - Home', false]);
	});

	$("body").on('submit', '#signup-home', function(e){
		e.preventDefault();
		submitSignup($('#signup-name').val(), $('#signup-email').val(), $('#signup-phone').val());
		_gaq.push(['_trackPageview', 'Homepage-Signup', 'Full', 'Signup - <?php echo $settings["page_title"]; ?>', false]);
	});

	// $("body").on('submit', '.capture-form, #email-capture-footer', function(e){
	// 	e.preventDefault();
	// 	submitClientLead('', $(this).find('input.text').val(), '', '');
	// 	_gaq.push(['_trackPageview', 'Homepage-Newsletter-Signup', 'Full', 'Email Capture - <?php echo $settings["page_title"]; ?>', false]);
	// });

	$("body").on('click', '.contactFormModal', function(e){
		e.preventDefault();
		if($('#contact-email').val() == '') alert("Email is required");
		else submitContact($('#contact-name').val(), $('#contact-email').val(), $('#contact-number').val(), $('#contact-message').val());
		_gaq.push(['_trackPageview', 'Contact-Submission', 'Beta', 'Contact Us Button - <?php echo $settings["page_title"]; ?> Page', false]);
	});

	$("body").on('click', '.landingPageForm', function(e){
		e.preventDefault();
		if($('#landing-email').val() == '') alert("Email is required");
		else submitSignup($('#landing-name').val(), $('#landing-email').val(), $('#landing-number').val(), 'No Message');
		_gaq.push(['_trackPageview', 'Landingpage-Submission', 'Beta', 'Contact Us Button - <?php echo $settings["page_title"]; ?> Page', false]);
	})

});
</script>
</body>
</html>