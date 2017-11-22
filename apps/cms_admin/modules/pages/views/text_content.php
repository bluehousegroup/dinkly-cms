<div class="container">
	<div class="card editor-content-card">
		<p class="card-header"><?php echo $block->getDesc(); ?></p>
		<div class="card-body">
			<?php if($block->getHint()): ?>
				<small class="form-text text-muted">
					<?php echo $block->getHint(); ?>
				</small>
			<?php endif; ?>
			<?php if($block->getEditor() == 'wysiwyg'): ?>
				<textarea class="form-control" name="content&&&text&&&<?php echo $block->getCode(); ?>&&&<?php echo get_class($block); ?>&&&html"><?php echo isset($content_index[$block->getCode()]) ? $content_index[$block->getCode()]->getHtml() : ''; ?></textarea>
			<?php elseif($block->getEditor() == 'textarea'): ?>
				<textarea class="form-control" id="<?php echo $block->getCode(); ?>" name="content&&&text&&&<?php echo $block->getCode(); ?>&&&<?php echo get_class($block); ?>&&&html"><?php echo isset($content_index[$block->getCode()]) ? $content_index[$block->getCode()]->getHtml() : ''; ?></textarea>
			<?php elseif($block->getEditor() == 'text'): ?>
				<input class="form-control" type="text" id="<?php echo $block->getCode(); ?>" name="content&&&text&&&<?php echo $block->getCode(); ?>&&&<?php echo get_class($block); ?>&&&html" value="<?php echo isset($content_index[$block->getCode()]) ? $content_index[$block->getCode()]->getHtml() : ''; ?>">
			<?php endif; ?>
		</div>
	</div>
</div>