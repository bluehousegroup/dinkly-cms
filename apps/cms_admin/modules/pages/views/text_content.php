<!-- <div class="control-group wysiwyg">
	<label class="control-label"><?php echo $block->getDesc(); ?></label>
	<div class="controls">
		<?php echo ($block->getHint()) ? '<p class="hint">'.$block->getHint().'</p>' : ''; ?>
		<?php if($block->getEditor() == 'ckeditor'): ?>
		<textarea class="ckeditor" id="ckeditor_<?php echo $block->getCode(); ?>" name="content&&&text&&&<?php echo $block->getCode(); ?>&&&<?php echo get_class($block); ?>&&&html"><?php echo isset($content_index[$block->getCode()]) ? $content_index[$block->getCode()]->getHtml() : ''; ?></textarea>
		<script type="text/javascript">
		CKEDITOR.replace('ckeditor_<?php echo $block->getCode(); ?>', { height: <?php echo $block->getEditorHeight(); ?> });
		</script>
		<?php elseif($block->getEditor() == 'textarea'): ?>
		<textarea style="height: <?php echo $block->getEditorHeight(); ?>px;" id="<?php echo $block->getCode(); ?>" name="content&&&text&&&<?php echo $block->getCode(); ?>&&&<?php echo get_class($block); ?>&&&html"><?php echo isset($content_index[$block->getCode()]) ? $content_index[$block->getCode()]->getHtml() : ''; ?></textarea>
		<?php elseif($block->getEditor() == 'text'): ?>
		<input type="text" id="<?php echo $block->getCode(); ?>" name="content&&&text&&&<?php echo $block->getCode(); ?>&&&<?php echo get_class($block); ?>&&&html" value="<?php echo isset($content_index[$block->getCode()]) ? $content_index[$block->getCode()]->getHtml() : ''; ?>">
		<?php endif; ?>
	</div>
</div> -->