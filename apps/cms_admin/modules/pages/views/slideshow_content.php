<div class="container">
	<div class="card editor-content-card">
		<p class="card-header"><?php echo $block->getDesc(); ?></p>
		<div class="card-body">
			<?php if($block->getHint()): ?>
				<small class="form-text text-muted">
					<?php echo $block->getHint(); ?>
				</small>
			<?php endif; ?>
			<table class="table">
				<thead>
					<tr>
						<th>Image</th>
						<th>Caption</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php if($content_index[$block->getCode()]->getSlides() != array()): ?>
						<tr>
							<td colspan="2"><em>This slideshow is currently empty</em></td>
						</tr>
					<?php endif; ?>
					<tr id="<?php echo $block->getCode(); ?>">
						<td>
							<em>[image uploader]</em>
						</td>
						<td>
							<input type="text" name="content&&&slideshow&&&<?php echo $block->getCode(); ?>&&&<?php echo get_class($block); ?>&&&caption[]">
						</td>
						<td>
							<a href="#" class="remove-input-slide">remove slide</a>
						</td>
					</tr>
					<?php if($content_index[$block->getCode()]->getSlides() != array()): ?>
						<?php foreach($content_index[$block->getCode()]->getSlides() as $pos => $slide): ?>
						<tr>
							<td>
								<?php if($slide->getThumbId() > 0): ?>
									<img src="/cms_admin/pages/display_image/image_id/<?php echo $slide->getThumbId(); ?>">
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
			<div>
				<p>&nbsp;<a class="btn new-slide btn-primary" href="#"><i class="icon icon-plus"></i> Add New Slide</a></p>
			</div>
		</div>
	</div>
</div>