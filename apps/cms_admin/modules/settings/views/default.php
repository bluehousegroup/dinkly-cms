<div id="main" role="main">
	<div id="content">
		<div class="content-wrapper has-header">
			<?php include_once('../apps/site_admin/layout/messaging.php'); ?>
			<div class="content-header clearfix">
				<h2 class="pull-left">Site Settings</h2>
				<div class="pull-right">
					<a target="_blank" href="/site/<?php echo $site->getDomain(); ?>" class="btn">View Draft Site</a>
				</div>
			</div>
			<div class="body-loader"></div>
			<div class="content-body scrollable">
				<div class="sidebar-left">
					<div class="pad active scrollable">
						<?php include_once('../apps/site_admin/modules/settings/views/sidebar_nav.php'); ?>
					</div>
				</div>
				<div class="content-editor has-top-actions scrollable">
					<div class="pad">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>