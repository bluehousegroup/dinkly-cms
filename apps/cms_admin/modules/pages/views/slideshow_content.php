<div class="control-group wysiwyg slideshow-block">
	<label class="control-label"><?php echo $block->getDesc(); ?></label>
	<div class="controls">
		<?php echo ($block->getHint()) ? '<p class="hint">'.$block->getHint().'</p>' : ''; ?>
		<table class="table slideshow-table">
			<thead>
				<tr>
					<th width="140">Image</th>
					<th>Caption</th>
					<th></th>
				</tr>
			</thead>
			<tbody class="slideshow-rows">
				<tr class="slideshow-placeholder" <?php echo ($content_index[$block->getCode()]->getSlides() != array()) ? 'style="display: none;"' : ''; ?>>
					<td colspan="2"><em>This slideshow is currently empty</em></td>
				</tr>
				<tr class="slideshow-input slideshow-slide" id="<?php echo $block->getCode(); ?>" style="display: none;">
					<td>
						<span class="btn btn-success fileinput-button">
							<i class="icon-plus icon-white"></i>
							<span>Select image</span>
							<input type="file" class="input-slideshow-image" name="content&&&slideshow&&&<?php echo $block->getCode(); ?>&&&<?php echo get_class($block); ?>&&&filename[]">
						</span>
						<label class="image-slideshow-filename" style="display: none;"></label>
					</td>
					<td><input type="text" name="content&&&slideshow&&&<?php echo $block->getCode(); ?>&&&<?php echo get_class($block); ?>&&&caption[]"></td>
					<td><a href="#" class="remove-input-slide">remove slide</a></td>
				</tr>
				<?php if($content_index[$block->getCode()]->getSlides() != array()): ?>
				<?php foreach($content_index[$block->getCode()]->getSlides() as $pos => $slide): ?>
				<tr class="slideshow-slide">
					<td>
						<?php if($slide->getThumbId() > 0): ?>
						<img src="/site_admin/pages/display_image/image_id/<?php echo $slide->getThumbId(); ?>">
						<input type="file" style="display: none;" class="input-slideshow-image" name="content&&&slideshow&&&<?php echo $block->getCode(); ?>&&&<?php echo get_class($block); ?>&&&filename[]">
						<?php endif; ?>
					</td>
					<td>
						<input value="<?php echo $slide->getCaption(); ?>" type="text" name="content&&&slideshow&&&<?php echo $block->getCode(); ?>&&&<?php echo get_class($block); ?>&&&caption[]">
					</td>
					<td><a href="#" class="remove-existing-slide">remove slide</a></td>
				</tr>
				<?php endforeach; ?>
				<?php endif; ?>
			</tbody>
		</table>
		<div class="pull-right">
			<p>&nbsp;<a class="btn new-slide btn-primary" href="#"><i class="icon icon-plus"></i> Add New Slide</a></p>
		</div>
	</div>
</div>