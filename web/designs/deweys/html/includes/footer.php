		<!-- Google Analytics snippet -->
		<?php if(isset($settings['google_analytics_id']) AND !empty($settings['google_analytics_id'])): ?>
		<script type="text/javascript">
		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', '<?php echo $settings['google_analytics_id'] ?>']);
		  _gaq.push(['_trackPageview']);

		  (function() {
		    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();
		</script>
		<?php endif; ?>
		<div class="pull-right"><a href="http://fourtopper.com">Made by Fourtopper</a></div>
	</body>
</html>