<div class="tab-pane" id="page-metadata">
	<div class="control-group">
		<label class="control-label">Page title</label>
		<div class="controls">
			<input type="text" class="input-block-level" name="page_detail_title" id="page_detail_title" value="<?php echo $page->getDetail()->getTitle(); ?>" />
		</div>
	</div>
	<div class="control-group">
		<label class="control-label">Navigation label</label>
		<div class="controls">
			<input type="text" class="input-block-level" name="page_detail_nav_label" id="page_detail_nav_label" value="<?php echo $page->getDetail()->getNavLabel(); ?>">
		</div>
	</div>
	<?php if(($page->getDesign()->getLayout() == 'single' && $page->getDetail()->getPageTemplateCode() == 'home') || $page->getDesign()->getLayout() == 'multiple'): ?>
	<div class="control-group">
		<label class="control-label">Meta Title</label>
		<div class="controls">
			<input type="text" class="input-block-level" name="page_detail_meta_title" id="page_detail_meta_title" value="<?php echo $page->getDetail()->getMetaTitle(); ?>">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label">Meta keywords</label>
		<div class="controls">
			<textarea class="input-block-level" rows="5" name="page_detail_meta_keywords" id="page_detail_meta_keywords"><?php echo $page->getDetail()->getMetaKeywords(); ?></textarea>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label">Meta description</label>
		<div class="controls">
			<textarea class="input-block-level" rows="5" name="page_detail_meta_description" id="page_detail_meta_description"><?php echo $page->getDetail()->getMetaDescription(); ?></textarea>
		</div>
	</div>
	<?php endif; ?>
</div>