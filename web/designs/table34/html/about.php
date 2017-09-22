<div class="banner">
	<div class="banner-wrap">
		<h1><?php echo $settings['page_title']; ?></h1>
	</div>
</div>
<section id="main" class="custom-content">
	<div class="main-content">
		<div class="inner-wrap">
			<?php if($about_image->getOriginalSource()): ?>
			<div class="image-block">
				<img src="<?php echo $about_image->getOriginalSource(); ?>" />
			</div>
			<?php endif; ?>
			<?php if($about_text != ''): ?>
			<div class="content-block">
				<?php echo $about_text->getHtml(); ?>
			</div>
			<?php endif; ?>
			<?php $employees_array = (isset($employees)) ? json_decode($employees->getEmployees()) : array(); ?>
			<?php if(count($employees_array) > 0): ?>
			<!-- Employees -->
			<div class="content-block team-list-wrap">
				<ul class="team-grid clearfix">
					<?php foreach($employees_array as $key => $employee): ?>
					<li class="pos<?php echo $key; ?>">
						<ul class="member">
							<li class="photo"><img class="photo" src="http://placehold.it/800x800" /></li>
							<li class="title"><?php echo $employee->position; ?></li>
							<li class="name"><?php echo $employee->name; ?></li>
							<li class="bio">
								<p><?php echo $employee->bio; ?></p>
							</li>
						</ul>
					</li>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php endif; ?>
		</div>
	</div>
</section>