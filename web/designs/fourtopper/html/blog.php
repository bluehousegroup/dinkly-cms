<?php
/* If there is more than one do list view else show pots */
if(isset($posts) AND count($posts) > 0 OR isset($post) AND $post != ""): ?>
<section class="page-title">
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">
				<h2>Blog</h2>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>
<section class='main blog'>
	<div class="style-wrap">
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="span9">
					<div class="inner-wrap">
						<?php
						// if list
						if(isset($posts) AND count($posts) > 0): ?>
						<h3>Most Recent</h3>
						<ul class="blog-list">
							<?php
							if(count($posts) == 1) $posts = array(0=>$posts);
							foreach($posts as $post_data): ?>
							<li>
								<div class="post-layout post-info">
									<span class="date"><?php echo date("F j, Y", strtotime($post_data->getPostDate())); ?></span>
									<span class="author"><?php echo ($post_data->getPostAuthor() == 'Michael Adams' ? '<a rel="author" href="https://plus.google.com/u/0/112459284198897305914" >'.$post_data->getPostAuthor().'</a>' : $post_data->getPostAuthor()) ?></span>
									<span class="tags"><a href="/blog">Marketing</a>, <a href="/blog">Social</a></span>
								</div>
								<div class="post-layout post-content">
									<h4><a href="/blog/<?php echo $post_data->getPostName(); ?>" class='post-title'><?php echo $post_data->getPostTitle(); ?></a></h4>
									<div class="wysiwyg-content teaser">										
										<?php if($post_data->getPostExcerpt() != ""): ?>
											<?php echo $post_data->getPostExcerpt(); ?>
										<?php else: ?>											
											<?php echo PostCollection::purifyHTML(substr($post_data->getPostContent(),0,500)).'...'; ?>
										<?php endif; ?>
									</div>
								</div>
							</li>
							<?php endforeach; ?>
						</ul>
						<?php
						// elseif single post
						elseif(isset($post) AND $post != ""): ?>
						<h3><?php echo $post->getPostTitle(); ?></h3>
						<div class="single-post">
							<div class="post-layout post-info">
								<span class="date"><?php echo date("F j, Y", strtotime($post->getPostDate())); ?></span>
								<span class="author"><?php echo ($post->getPostAuthor() == 'Michael Adams' ? '<a rel="author" href="https://plus.google.com/u/0/112459284198897305914" >'.$post->getPostAuthor().'</a>' : $post->getPostAuthor()) ?></span>
								<span class="tags"><a href="/blog">Marketing</a>, <a href="/blog">Social</a></span>

								<div class="sharing-utils">
									<!-- AddThis Button BEGIN -->
									<div class="addthis_toolbox addthis_32x32_style">
										<a class="addthis_button_facebook"></a>
										<a class="addthis_button_twitter"></a>
										<a class="addthis_button_linkedin"></a>
										<a class="addthis_button_reddit"></a>
										<a class="addthis_button_compact"></a>
									</div>
									<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5183f45041e95f3f"></script>
									<!-- AddThis Button END -->
								</div>
							</div>
							<div class="post-layout post-content">
								<div class="wysiwyg-content">
									<?php echo $post->getPostContent(); ?>
								</div>
							</div>
						</div>
						<?php
						// else error message
						else: ?>
						<div>Oops, couldn't retrieve the post you were looking for.  Please, <a href="#">let us know</a> and we'll fix it right up!</div>
						<?php
						endif; ?>
					</div>
				</div>
				<aside class="span3 blog-utils">
					<div class="inner-wrap">
						
						<h4>Latest Posts</h4>
						<ul class="feat-posts">
							<?php if(isset($last_three_posts) AND count($last_three_posts) > 0): ?>
								<?php foreach($last_three_posts as $last_three): ?>
									<li><a href="/blog/<?php echo $last_three->getPostName(); ?>"><?php echo $last_three->getPostTitle(); ?></a></li>
								<?php endforeach; ?>
							<?php endif; ?>

						</ul>

						<!-- <h4>Categories</h4>
						<ul class="blog-categories">
							<li><a href="/blog">Marketing</a></li>
							<li><a href="/blog">Social</a></li>
						</ul> -->

						<h4>Post Archive</h4>
						<div class="accordion" id="archive-year">
							<?php while($current_year >= $oldest_post_year): ?>
								<div class="accordion-group">
									<div class="accordion-heading">
										<a class="accordion-toggle" data-toggle="collapse" data-parent="#blog-archive" href="#collapse1"><?php echo $current_year; ?></a>
									</div>
									<div class="accordion-body collapse in" id="#collapse1">
										<div class="accordion-inner">
											<ul class="archive-month">
												<?php for ($i=12; $i>=1; $i--): ?>
													<?php if($i<10) $month_num = "0$i"; else $month_num = $i; ?>
													<?php if(in_array("$month_num-".$current_year, $post_dates)): ?>
														<li><a href="/blog/archive_<?= $current_year.'_'.$month_num; ?>"><?= date("F", strtotime("01-$month_num-$current_year") ); ?></a></li> 
													<?php endif; ?>
												<?php endfor; ?>
											</ul>
										</div>
									</div>
								</div>
							<?php $current_year--; endwhile; ?>							
						</div>
					</div>
				</aside>
			</div>
		</div>
	</div>
</section>