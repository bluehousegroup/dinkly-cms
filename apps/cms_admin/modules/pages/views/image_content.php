<div class="control-group wysiwyg image-content">
	<label class="control-label"><?php echo $block->getDesc(); ?></label>
	<div class="controls">
		<div class="filedrag">
			<?php echo ($block->getHint()) ? '<p class="hint">'.$block->getHint().'</p>' : ''; ?>
			<?php if(isset($content_index[$block->getCode()])): ?>
				<?php if($content_index[$block->getCode()]->getThumbId() > 0): ?>
				<img class="filedrag-preview image-content-image" src="/cms_admin/pages/display_image/image_id/<?php echo $content_index[$block->getCode()]->getThumbId(); ?>">
				<label class="filedrag-filename"><?php echo $content_index[$block->getCode()]->getFilename(); ?></label>
				<?php else: ?>
				<img class="filedrag-preview" src="/img/placeholder1.gif">
				<?php endif; ?>
			<?php endif; ?>
			<div>&nbsp;</div>
			<div class="filedrag-droparea">drop image (or click)</div>
			<div class="filedrag-progress"></div>
			<input type="file" class="filedrag-input" id="<?php echo uniqid(); ?>" name="content&&&image&&&<?php echo $block->getCode(); ?>&&&<?php echo get_class($block); ?>&&&filename">
			<?php if(isset($content_index[$block->getCode()])): ?>
				<?php if($content_index[$block->getCode()]->getThumbId() > 0): ?>
				<a href="#" class="remove-image btn btn-danger">Remove Image</a>
				<?php endif; ?>
			<?php endif; ?>

			<input type="hidden" class="hidden-thumb-id" name="content&&&image&&&<?php echo $block->getCode(); ?>&&&<?php echo get_class($block); ?>&&&thumb_id" value="<?php echo (isset($content_index[$block->getCode()])) ? $content_index[$block->getCode()]->getThumbId() : ''; ?>"/>
			<input type="hidden" class="hidden-original-id" name="content&&&image&&&<?php echo $block->getCode(); ?>&&&<?php echo get_class($block); ?>&&&original_id" value="<?php echo (isset($content_index[$block->getCode()])) ? $content_index[$block->getCode()]->getOriginalId() : ''; ?>"/>

			<input type="hidden" name="content&&&image&&&<?php echo $block->getCode(); ?>&&&<?php echo get_class($block); ?>&&&crop_width" value="<?php echo $block->getCropWidth(); ?>"/>
			<input type="hidden" name="content&&&image&&&<?php echo $block->getCode(); ?>&&&<?php echo get_class($block); ?>&&&crop_height" value="<?php echo $block->getCropHeight(); ?>"/>
		</div>
	</div>
</div>
<?php if($block->getHasCaption()): ?>
<div class="control-group wysiwyg">
	<label class="control-label"><?php echo $block->getDesc(); ?> caption</label>
	<div class="controls">
		<?php if($block->getCaptionEditor() == 'ckeditor'): ?>
		<textarea class="ckeditor" id="ckeditor_<?php echo $block->getCode(); ?>" name="content&&&image&&&<?php echo $block->getCode(); ?>&&&<?php echo get_class($block); ?>&&&caption"><?php echo isset($content_index[$block->getCode()]) ? $content_index[$block->getCode()]->getCaption() : ''; ?></textarea>
		<script type="text/javascript">
		CKEDITOR.replace('ckeditor_<?php echo $block->getCode(); ?>', { height: <?php echo $block->getCaptionEditorHeight(); ?> });
		</script>
		<?php elseif($block->getCaptionEditor() == 'textarea'): ?>
		<textarea style="height: <?php echo $block->getCaptionEditorHeight(); ?>px;" id="<?php echo $block->getCode(); ?>" name="content&&&image&&&<?php echo $block->getCode(); ?>&&&<?php echo get_class($block); ?>&&&caption"><?php echo isset($content_index[$block->getCode()]) ? $content_index[$block->getCode()]->getCaption() : ''; ?></textarea>
		<?php elseif($block->getCaptionEditor() == 'text'): ?>
		<input type="text" id="<?php echo $block->getCode(); ?>" name="content&&&image&&&<?php echo $block->getCode(); ?>&&&<?php echo get_class($block); ?>&&&caption" value="<?php echo isset($content_index[$block->getCode()]) ? $content_index[$block->getCode()]->getCaption() : ''; ?>">
		<?php endif; ?>
	</div>
</div>
<?php endif; ?>