<div class="container">
	<div class="card editor-content-card">
		<p class="card-header"><?php echo $block->getDesc(); ?></p>
		<div class="card-body">
			<?php if($block->getHint()): ?>
				<small class="form-text text-muted">
					<?php echo $block->getHint(); ?>
				</small>
			<?php endif; ?>
			<div class="form-group">
				<div class="filedrag neat-little-uploader" id="uploader-<?php echo $block->getCode(); ?>">
					<div class="filedrag-preview-container" style="display: none;">
						<img src="" class="filedrag-preview">
					</div>
					<div class="filedrag-droparea">
						<div class="filedrag-display-filename"></div>
						<div class="filedrag-remove-button">(<button type="button" class="btn btn-xs btn-link filedrag-remove-file">remove</button>)</div>
					</div>
					<div class="filedrag-progress"></div>
					<input type="file" class="filedrag-input" id="file-input" name="file-input">
					<input class="filedrag-input hidden-original" type="hidden" name="content&&&image&&&<?php echo $block->getCode(); ?>&&&<?php echo get_class($block); ?>&&&original" value="<?php echo (isset($content_index[$block->getCode()])) ? $content_index[$block->getCode()]->getOriginalId() : ''; ?>">
					<input class="filedrag-input hidden-new" type="hidden" name="content&&&image&&&<?php echo $block->getCode(); ?>&&&<?php echo get_class($block); ?>&&&new" value="">
					<input type="hidden" name="content&&&image&&&<?php echo $block->getCode(); ?>&&&<?php echo get_class($block); ?>&&&crop_width" value="<?php echo $block->getCropWidth(); ?>"/>
					<input type="hidden" name="content&&&image&&&<?php echo $block->getCode(); ?>&&&<?php echo get_class($block); ?>&&&crop_height" value="<?php echo $block->getCropHeight(); ?>"/>
				</div>
			</div>
		</div>
		<div class="card-body">
			<?php if($block->getHasCaption()): ?>
				<label><?php echo $block->getDesc(); ?> caption</label>
				<div class="form-group">
					<?php if($block->getCaptionEditor() == 'wysiwyg'): ?>
						<textarea class="form-control" id="<?php echo $block->getCode(); ?>" name="content&&&image&&&<?php echo $block->getCode(); ?>&&&<?php echo get_class($block); ?>&&&caption"><?php echo isset($content_index[$block->getCode()]) ? $content_index[$block->getCode()]->getCaption() : ''; ?></textarea>
					<?php elseif($block->getCaptionEditor() == 'textarea'): ?>
						<textarea class="form-control" id="<?php echo $block->getCode(); ?>" name="content&&&image&&&<?php echo $block->getCode(); ?>&&&<?php echo get_class($block); ?>&&&caption"><?php echo isset($content_index[$block->getCode()]) ? $content_index[$block->getCode()]->getCaption() : ''; ?></textarea>
					<?php elseif($block->getCaptionEditor() == 'text'): ?>
						<input class="form-control" type="text" id="<?php echo $block->getCode(); ?>" name="content&&&image&&&<?php echo $block->getCode(); ?>&&&<?php echo get_class($block); ?>&&&caption" value="<?php echo isset($content_index[$block->getCode()]) ? $content_index[$block->getCode()]->getCaption() : ''; ?>">
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
<script type="text/javascript">
$(function () {
	<?php if($content_index[$block->getCode()]->getThumbId()): ?>
	initUploader('uploader-<?php echo $block->getCode(); ?>', '/cms_admin/pages/image_upload', null, '/cms_admin/pages/display_image/image_id/<?php echo $content_index[$block->getCode()]->getThumbId(); ?>', '<?php echo $content_index[$block->getCode()]->getFilename(); ?>');
	<?php else: ?>
	initUploader('uploader-<?php echo $block->getCode(); ?>', '/cms_admin/pages/image_upload');
	<?php endif; ?>
});
</script>