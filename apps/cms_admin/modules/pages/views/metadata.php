<div class="container">
	<div class="card editor-content-card">
		<p class="card-header">Page title</p>
		<div class="card-body">
			<div class="form-row">
				<div class="form-group col-md-8">
					<input maxlength="264" type="text" class="form-control" name="page_detail_title" id="page_detail_title" value="<?php echo $page->getDetail()->getTitle(); ?>" />
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="card editor-content-card">
		<p class="card-header">Navigation label</p>
		<div class="card-body">
			<div class="form-row">
				<div class="form-group col-md-6">
					<input maxlength="256" type="text" class="form-control" name="page_detail_nav_label" id="page_detail_nav_label" value="<?php echo $page->getDetail()->getNavLabel(); ?>">
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="card editor-content-card">
		<p class="card-header">Meta Title</p>
		<div class="card-body">
			<div class="form-row">
				<div class="form-group col-md-12">
					<input maxlength="512" type="text" class="form-control" name="page_detail_meta_title" id="page_detail_meta_title" value="<?php echo $page->getDetail()->getMetaTitle(); ?>">
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="card editor-content-card">
		<p class="card-header">Meta keywords</p>
		<div class="card-body">
			<div class="form-row">
				<div class="form-group col-md-12">
					<textarea maxlength="2000" class="form-control" rows="2" name="page_detail_meta_keywords" id="page_detail_meta_keywords"><?php echo $page->getDetail()->getMetaKeywords(); ?></textarea>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="card editor-content-card">
		<p class="card-header">Meta description</p>
		<div class="card-body">
			<div class="form-row">
				<div class="form-group col-md-12">
					<textarea maxlength="5000" class="form-control" rows="2" name="page_detail_meta_description" id="page_detail_meta_description"><?php echo $page->getDetail()->getMetaDescription(); ?></textarea>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- <div class="container">
	<div class="card editor-metadata-card">
		<div class="card editor-content-card">
			<p class="card-header">Meta Title</p>
			<div class="card-body">
				<input type="text" class="form-control" name="page_detail_meta_title" id="page_detail_meta_title" value="<?php echo $page->getDetail()->getMetaTitle(); ?>">
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="card editor-metadata-card">
		<div class="card editor-content-card">
			<p class="card-header">Meta description</p>
			<div class="card-body">
				<textarea class="form-control" rows="5" name="page_detail_meta_description" id="page_detail_meta_description"><?php echo $page->getDetail()->getMetaDescription(); ?></textarea>
			</div>
		</div>
	</div>
</div> -->