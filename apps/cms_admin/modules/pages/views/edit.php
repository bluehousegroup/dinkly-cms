<div class="container">
	<?php include($_SERVER['APPLICATION_ROOT'] . 'apps/cms_admin/layout/messaging.php'); ?>
	<div class="page-header mt-4">
		<h2>
			Pages
			<div class="float-md-right">
				<button type="button" class="btn btn-primary">Save</button>	
				<button type="button" class="btn btn-info">Save and Publish</button>
				<button type="button" class="btn btn-secondary">View Draft</button>
			</div>
		</h2>	
	</div>
	<hr>
	<div class="row">
		<div class="col-md-3 col-sm-6">
			<label>Live Preview &nbsp;</label>
			<div class="btn-group btn-group-toggle" data-toggle="buttons">
				<label class="btn btn-secondary active">
					<input type="radio" name="options" id="option1" checked="checked"> Off
				</label>
				<label class="btn btn-secondary">
					<input type="radio" name="options" id="option2"> On
				</label>
			</div>
		</div>
		<div class="col-sm-12 pt-sm-2 pt-lg-0 pt-md-0 pt-2 col-md-9">
			<h4><?php echo ($settings['site_name']) ? $settings['site_name'] : 'Unnamed Site'; ?>: <?php echo $page->getTemplate()->getTemplateName(); ?></h4>
			<p>Current Template: <strong><?php echo $page->getDesign()->getTitle(); ?></strong></p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3 col-sm-12">
			<form action="" method="post" name="add_page" class="form-inline">
				<form class="form-inline">
					<select name="page_template" class="form-control mb-2 mr-2">
						<option value="">New page...</option>
						<?php if($available_templates == array()): ?>
							<option value=""><em>All available pages have been added</em></option>
						<?php else: ?>
							<?php foreach($available_templates as $template): ?>
								<option value="<?php echo $template->getCode(); ?>"><?php echo $template->getTemplateName(); ?></option>
							<?php endforeach; ?>
						<?php endif; ?>
					</select>

					<input class="btn btn-primary template-submit mb-2" type="submit" value="Add" name="page_template_submit">
				</form>
			</form>
			<nav class="navbar navbar-light bg-light content-sidebar">
				<nav class="nav nav-pills flex-column">
					<?php foreach($structure as $nav_item): ?>
						<a id="<?php echo $nav_item->getPage()->getDetail()->getSiteNavItemId(); ?>" class="nav-link <?php echo ($nav_item->getPage()->getDetail()->getSiteNavItemId() == $page_id) ? 'active' : ''; ?>" href="/cms_admin/pages/edit/page/<?php echo $nav_item->getPage()->getDetail()->getSiteNavItemId(); ?>"><?php echo $nav_item->getPage()->getDetail()->getNavLabel(); ?></a>
					<?php endforeach; ?>
				</nav>
			</nav>
		</div>
		<div class="col-md-9">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" id="content-tab" data-toggle="tab" href="#content" role="tab" aria-controls="content" aria-selected="true">Content</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="metadata-tab" data-toggle="tab" href="#metadata" role="tab" aria-controls="metadata" aria-selected="false">Metadata</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="history-tab" data-toggle="tab" href="#history" role="tab" aria-controls="history" aria-selected="false">History</a>
				</li>
			</ul>
			<form action="" method="post" name="edit_page">
				<div class="tab-content">
					<div class="tab-pane fade show active" id="content" role="tabpanel" aria-labelledby="content-tab">
						<!-- Template Content Block Editing -->
						<?php if($template_content_blocks != array()): ?>
							<?php foreach($template_content_blocks as $block): ?>
								<?php if(get_class($block) == 'CmsSlideshowContent'): ?>
									<?php include('../apps/cms_admin/modules/pages/views/slideshow_content.php'); ?>
								<?php elseif(get_class($block) == 'CmsImageContent'): ?>
									<?php include('../apps/cms_admin/modules/pages/views/image_content.php'); ?>
								<?php elseif(get_class($block) == 'CmsTextContent'): ?>	
									<?php include('../apps/cms_admin/modules/pages/views/text_content.php'); ?>
								<?php endif; ?>
							<?php endforeach; ?>
						<?php endif; ?>

						<input type="hidden" name="posted" value="true" />
						<input type="hidden" name="publish" id="hidden-publish" value="" />
					</div>
					<div class="tab-pane fade" id="metadata" role="tabpanel" aria-labelledby="metadata-tab">
						<?php include('../apps/cms_admin/modules/pages/views/metadata.php'); ?>
					</div>
					<div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="history-tab">
						<?php include('../apps/cms_admin/modules/pages/views/revision_history.php'); ?>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<input type="hidden" name="page_id" id="page_id" value="<?php echo $page_id; ?>">

<script type="text/javascript">
	$(document).ready(function() {
		//This little ditty will make sure the datatable gets draw to the correct width when its initialzed
		$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
			if($(this).html() == 'History') {
				if(!$.fn.DataTable.isDataTable("#revision-table")) {
					$('#revision-table').DataTable({
						searching: false
					});
				}
			}
		});
	});
</script>