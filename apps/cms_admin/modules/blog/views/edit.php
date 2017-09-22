<div id="main" role="main">
	<div id="content">
		<div class="content-wrapper has-header">
			<?php include_once('../apps/cms_admin/layout/messaging.php'); ?>
			<div class="content-header clearfix">
				<h2 class="pull-left">Blog</h2>
				<div class="pull-right">
					<a href="/cms_admin/blog" class="btn">New Post</a>
					<a target="_blank" href="/site/<?php echo $site->getDomain(); ?>" class="btn">View Draft Site</a>
				</div>
			</div>
			<div class="content-body scrollable">
				<div class="sidebar-left">
					<div class="pad active scrollable">
						<ul class="nav nav-pills nav-stacked">
							<?php if(isset($posts) AND count($posts) > 0): ?>
								<?php foreach($posts as $post): ?>
									<li><a href="/cms_admin/blog/edit/post/<?php echo $post->getId(); ?>"><?php echo $post->getPostTitle(); ?></a></li>
								<?php endforeach; ?>
							<?php endif; ?>
						</ul>
					</div>
				</div>

				<form id="blog-form" class="editor-form form-horizontal" action="/cms_admin/blog/save" method="post" enctype="multipart/form-data">
					<div class="content-editor scrollable">
						<div class="pad">
							<h4>Edit Post</h4>
							<input type="hidden" name="id" value="<?php if(isset($edit_post)) echo $edit_post->getId(); ?>"/>
							<div class="control-group">
								<label class="control-label">Title</label>
								<div class="controls">
									<input type="text" name="title" value="<?php if(isset($edit_post)) echo $edit_post->getPostTitle(); ?>"/>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Slug</label>
								<div class="controls">
									<input type="text" name="name" value="<?php if(isset($edit_post)) echo $edit_post->getPostName(); ?>" readonly/>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Author</label>
								<div class="controls">
									<input type="text" name="author" value="<?php if(isset($edit_post)) echo $edit_post->getPostAuthor(); ?>"/>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Post Date</label>
								<div class="controls">
									<input type="text" name="post_date" class="datetimepicker" value="<?php if(isset($edit_post)) echo $edit_post->getPostDate(); ?>"/>
								</div>
							</div>
							<div class="control-group wysiwyg">
								<label class="control-label">Content</label>
								<div class="controls">
									<textarea class="ckeditor" id="ckeditor" name="content"><?php if(isset($edit_post)) echo $edit_post->getPostContent(); ?></textarea>
								<script type="text/javascript">
									CKEDITOR.replace( 'ckeditor', { height: 275 });
								</script>
								</div>
							</div>
						</div>
					</div>
					<div class="content-editor-actions">
						<div class="pad">
							<button onclick="saveSubmit();" class="btn btn-primary save-button" data-loading-text="Saving...">Save Post</button>
							<a href="/cms_admin/blog" class="btn">Discard Changes</a>
							<a onclick="return confirm('Are you super sure?');" href="/cms_admin/blog/delete/post/<?php if(isset($edit_post)) echo $edit_post->getId(); ?>" class="btn btn-danger pull-right">Delete Post</a>
						</div>
					</div>


				</form>

			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

function saveSubmit() {
	$('#blog-form').submit();
}

$(document).ready(function() {
	$(".datetimepicker").datetimepicker({
		autoclose: true,
		showMeridian: true
	});
});
</script>
