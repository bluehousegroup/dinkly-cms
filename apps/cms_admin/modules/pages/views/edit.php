<div id="main" role="main">
	<div id="content">
		<div class="content-wrapper has-header">
			<?php include('../apps/cms_admin/layout/messaging.php'); ?>
			<div class="content-header clearfix">
				<h2 class="pull-left">Pages <span class="loading" style="display: none;"></span></h2>
				<div class="pull-right">
					<a onclick="saveAndPublish();" class="btn">Publish Page</a>
					<a target="_blank" href="/site/<?php echo $page->getDetail()->getSlug(); ?>" class="btn">View Draft</a>
				</div>
			</div>
			<div class="content-body">
				<div class="sidebar-left">
					<div class="pad page-nav active scrollable">
						<div class="add-page">
							<form action="" method="post" name="add_page" class="form-inline">
								<div class="control-group">
									<div class="controls">
										<select name="page_template" style="width: 125px;">
											<option value="">New page...</a>
											<?php if($available_templates == array()): ?>
											<option value=""><em>All available pages have been added</em></option>
											<?php else: ?>
											<?php foreach($available_templates as $template): ?>
											<option value="<?php echo $template->getCode(); ?>"><?php echo $template->getTemplateName(); ?></option>
											<?php endforeach; ?>
											<?php endif; ?>
										</select>
										<input type="hidden" name="add_page_posted" value="true" />
										<input class="btn btn-primary template-submit" type="submit" value="Add" name="page_template_submit" />
									</div>
								</div>
							</form>
						</div>
						<h4><?php echo ($settings['site_name']) ? $site->getSettings()['site_name'] : 'Unnamed Site'; ?></h4>
						<p>Using design <strong><?php echo $page->getDesign()->getTitle(); ?></strong></p>
						<ul class="nav nav-pills nav-stacked site-nav">
							<?php foreach($structure as $nav_item): ?>
							<li id="<?php echo $nav_item->getPage()->getDetail()->getSiteNavItemId(); ?>" <?php echo ($nav_item->getPage()->getDetail()->getSiteNavItemId() == $page_id) ? 'class="active"' : ''; ?>><a href="/cms_admin/pages/edit/page/<?php echo $nav_item->getPage()->getDetail()->getSiteNavItemId(); ?>"><?php echo $nav_item->getPage()->getDetail()->getNavLabel(); ?></a></li>
							<?php endforeach; ?>
						</ul>
					</div>
					<!-- Revision History -->
					<?php include('../apps/cms_admin/modules/pages/views/revision_history.php'); ?>
				</div>

				<form id="content-form" class="editor-form form-horizontal" action="/cms_admin/pages/edit/page/<?php echo $page_id; ?>" method="post" enctype="multipart/form-data">
					<div class="content-editor scrollable">
						<div class="pad">
							<div class="content-tabs">
								<ul class="nav nav-tabs editor-tabs">
									<li class="active"><a href="#page-content" data-toggle="tab">Content</a></li>
									<li class="t-metadata"><a href="#page-metadata" data-toggle="tab">Metadata</a></li>
									<li class="t-history"><a href="#page-history" data-toggle="tab" class="toggle-history">History</a></li>
									<li class="t-preview"><a href="#" class="toggle-preview"><span>Live Preview</span> <i class="icon-remove"></i></a></li>
								</ul>
							</div>
							<div class="tab-content">
								<div class="tab-pane active" id="page-content">
									<!-- Exceptions for specific types of templates -->
									<?php if($page->getTemplate()->getCode() == 'menu'): ?>
									<div class="control-group">
										<label for="" class="control-label"></label>
										<div class="controls">
											<a class="btn btn-large btn-primary" href="/cms_admin/menu/"><i class="icon icon-edit"></i> Edit food menus</a>
										</div>
									</div>
									<?php elseif($page->getTemplate()->getCode() == 'events'): ?>
									<div class="control-group">
										<label for="" class="control-label"></label>
										<!-- <div class="controls">
											<a class="btn btn-large btn-primary" href="/cms_admin/events/"><i class="icon icon-edit"></i> Edit events</a>
										</div> -->
									</div>
									<?php endif; ?>

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

								<!-- Metadata -->
								<?php include('../apps/cms_admin/modules/pages/views/metadata.php'); ?>

								<!-- History -->
								 <div class="tab-pane" id="page-history">
									<div class="alert alert-danger">Currently viewing version #16. <a href="#" class="btn">Revert to this version</a> <a class="btn" href="#">Preview version</a></div>
								
								</div>
							</div>
						</div>
					</div>
					<div class="content-editor-actions">
						<div class="pad">
							<button onclick="saveSubmit();" class="btn btn-primary save-button" data-loading-text="Saving...">Save Draft</button>
							<a href="/cms_admin/pages/edit/page/<?php echo $page_id; ?>/discarded/1" class="btn">Discard Changes</a>
							<a href="#/cms_admin/pages/delete/page/<?php echo $page_id; ?>" class="delete-page pull-right">Delete Page</a>
						</div>
					</div>
					<!-- Live Preview -->
					<div class="content-preview">
						<iframe id="autosave-preview" src="/home/default/site/<?php echo $page->getDetail()->getSiteNavItemId(); ?>/autosave" width="100%" height="100%" frameborder="0"></iframe>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
<input type="hidden" name="page_id" id="page_id" value="<?php echo $page_id; ?>">
<?php include('../apps/cms_admin/modules/pages/views/javascript.php'); ?>