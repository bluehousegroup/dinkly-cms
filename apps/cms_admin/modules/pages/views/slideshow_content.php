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
				<tbody class="slides-<?php echo $block->getCode(); ?>">
					<tr id="new-slide-template-<?php echo $block->getCode(); ?>" class="new-slide-row-<?php echo $block->getCode(); ?>" style="display: none;">
						<td>
							<div class="form-group">
								<div class="filedrag neat-little-uploader" id="uploader-new-slide-<?php echo $block->getCode(); ?>">
									<div class="filedrag-preview-container filedrag-preview-container-slideshow" style="display: none;">
										<img src="" class="filedrag-preview">
									</div>
									<div class="filedrag-droparea">
										<div class="filedrag-display-filename"></div>
									</div>
									<div class="filedrag-progress"></div>
									<input type="file" class="filedrag-input" id="file-input" name="file-input">
									<input class="filedrag-input hidden-original" type="hidden" name="content&&&slideshow&&&new_slide&&&<?php echo get_class($block); ?>&&&original[]" value="">
									<input class="filedrag-input hidden-new" type="hidden" name="content&&&slideshow&&&new_slide&&&<?php echo get_class($block); ?>&&&new[]" value="">
								</div>
							</div>
						</td>
						<td>
							<input class="form-control" type="text" name="content&&&slideshow&&&<?php echo $block->getCode(); ?>&&&<?php echo get_class($block); ?>&&&caption[]">
						</td>
						<td>
							<a href="#" class="remove-slide-<?php echo $block->getCode(); ?>">remove slide</a>
						</td>
					</tr>
					<?php if($content_index[$block->getCode()]->getSlides() != array()): ?>
						<?php foreach($content_index[$block->getCode()]->getSlides() as $pos => $slide): ?>
						<tr>
							<td>
								<div class="form-group">
									<div class="filedrag neat-little-uploader" id="uploader-<?php echo $slide->getId(); ?>">
										<div class="filedrag-droparea">
											<div class="filedrag-display-filename"></div>
										</div>
										<div class="filedrag-progress"></div>
										<input type="file" class="filedrag-input" id="file-input" name="file-input">
										<input class="filedrag-input hidden-original" type="hidden" name="content&&&slideshow&&&<?php echo $slide->getId(); ?>&&&<?php echo get_class($block); ?>&&&original[]" value="<?php echo (isset($content_index[$block->getCode()])) ? $content_index[$block->getCode()]->getOriginalId() : ''; ?>">
										<input class="filedrag-input hidden-new" type="hidden" name="content&&&slideshow&&&<?php echo $slide->getId(); ?>&&&<?php echo get_class($block); ?>&&&new[]" value="">
									</div>
								</div>
							</td>
							<td>
								<input value="<?php echo $slide->getCaption(); ?>" type="text" name="content&&&slideshow&&&<?php echo $block->getCode(); ?>&&&<?php echo get_class($block); ?>&&&caption[]">
							</td>
							<td><a href="#" class="remove-slide-<?php echo $block->getCode(); ?>">remove slide</a></td>
						</tr>
						<?php endforeach; ?>
					<?php endif; ?>
				</tbody>
			</table>
			<div>
				<p>&nbsp;<a class="btn new-slide-<?php echo $block->getCode(); ?> btn-primary" href="#"><i class="icon icon-plus"></i> Add New Slide</a></p>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(function () {

	/* FUNCTIONS ********************************************************************************/

	//Since we add our slides after load, we need to make sure we apply any events to the rows
	function applySlideEventHandlers() {
		/*
			Remove selected slide (the off, then on prevents this handler getting added to the same 
			element multiple times and firing more than once)
		*/
		$('.remove-slide-<?php echo $block->getCode(); ?>').off('click').on('click', function() {
			slide_count_<?php echo $block->getCode(); ?>--;

			$(this).parents('tr').remove();

			return false;
		});
	}

	/* EVENTS ***********************************************************************************/

	//Handle new slide click
	$('.new-slide-<?php echo $block->getCode(); ?>').on('click', function() {
		//New slide, count it
		slide_count_<?php echo $block->getCode(); ?>++;

		//Clone the new slide row and append it to the table
		$('#new-slide-template-<?php echo $block->getCode(); ?>')
			.clone()
			.show()
			.removeAttr('id')
			.appendTo('.slides-<?php echo $block->getCode(); ?>');


		//Replace the id of our new row so we can target it
		$('.slides-<?php echo $block->getCode(); ?>').last().find('.neat-little-uploader').last().removeAttr('id').attr('id', 'uploader-new-slide-<?php echo $block->getCode(); ?>-' + slide_count_<?php echo $block->getCode(); ?>);

		//Initialize the uploader in our new row
		initUploader('uploader-new-slide-<?php echo $block->getCode(); ?>-' + slide_count_<?php echo $block->getCode(); ?>, '/cms_admin/pages/image_upload', null);

		applySlideEventHandlers();

		return false;
	});

	/* INITIALIZATION **************************************************************************/

	//Keep track of the number of slideshow slides
	var slide_count_<?php echo $block->getCode(); ?> = $('.slides-<?php echo $block->getCode(); ?>').length;

	//Initialize uploaders for uploaded images
	<?php if($content_index[$block->getCode()]->getSlides() != array()): ?>
		<?php foreach($content_index[$block->getCode()]->getSlides() as $pos => $slide): ?>
			initUploader('uploader-<?php echo $block->getCode(); ?>', '/cms_admin/pages/image_upload', null, '/cms_admin/pages/display_image/image_id/<?php echo $content_index[$block->getCode()]->getThumbId(); ?>', '<?php echo $content_index[$block->getCode()]->getFilename(); ?>');
		<?php endforeach; ?>
	<?php endif; ?>
});
</script>