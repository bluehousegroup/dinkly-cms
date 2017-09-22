<div id="main" role="main">
	<div id="content">
		<div class="content-wrapper has-header">
			<?php include_once('../apps/site_admin/layout/messaging.php'); ?>
			<div class="content-header clearfix">
				<h2 class="pull-left">My Account</h2>
			</div>
			<div class="body-loader"></div>
			<div class="content-body scrollable">
				<div class="sidebar-left">
					<div class="pad active scrollable">
						<?php include_once('../apps/site_admin/modules/account/views/sidebar_nav.php'); ?>
					</div>
				</div>

				<div class="content-editor has-top-actions scrollable">
					<div class="pad">

						<!-- Address/Map -->
						<div class="tab-pane" id="address">
							<form class="editor-form form-horizontal">
								<h4>Upgrade Your Account</h4>
								<div class="form-actions">
									<button class="btn btn-primary save-button" data-loading-text="Working...">Upgrade</button>
								</div>
							</form>
						</div>

					</div>
				</div>

			</div>
		</div>
	</div>
</div>