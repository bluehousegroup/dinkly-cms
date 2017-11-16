<div class="pad page-revs scrollable">
	<p>Revision History for <strong><?php echo $page->getDetail()->getTitle(); ?></strong></p>
	<ul class="nav nav-pills nav-stacked">
		<?php foreach($revisions as $rev): ?>
			<?php if($rev->getIsCurrentLive()): ?>
			<li><a target="_blank" src="/site/<?php echo $rev->getId(); ?>/revision"><strong>#<?php echo $rev->getRevision(); ?></strong> - <?php echo $rev->getCreatedAt('n/j/y G:ia'); ?> <span><strong><em>Current Live</em></strong></span></a></li>
			<?php elseif($rev->getIsCurrentDraft()): ?>
			<li><a target="_blank" href="/site/<?php echo $rev->getId(); ?>/revision"><strong>#<?php echo $rev->getRevision(); ?></strong> - <?php echo $rev->getCreatedAt('n/j/y G:ia'); ?> <span><strong><em>Current Draft</em></strong></span></a></li>
			<?php else: ?>
			<li><a target="_blank" href="/site/<?php echo $rev->getId(); ?>/revision"><strong>#<?php echo $rev->getRevision(); ?></strong> - <?php echo $rev->getCreatedAt('n/j/y G:ia'); ?></a></li>
			<?php endif; ?>
		<?php endforeach; ?>
	</ul>
</div>