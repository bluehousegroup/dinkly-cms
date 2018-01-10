<div class="container mt-4">
	<table class="table" id="revision-table">
		<thead class="thead-light">
			<tr>
				<th scope="col">Revision #</th>
				<th scope="col">Created</th>
				<th scope="col"></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($revisions as $rev): ?>
				<tr>
					<th scope="row"><?php echo $rev->getRevision(); ?></th>
					<td><?php echo $rev->getCreatedAt('n/j/y G:ia'); ?></td>
					<td>
						<?php if($rev->getIsCurrentLive()): ?>
							<strong>Published Version</strong>
						<?php elseif($rev->getIsCurrentDraft()): ?>
							<strong>Current Draft</strong>
						<?php else: ?>
							<a href="/home/default/site/<?php echo $rev->getId(); ?>/revision">View</a>
						<?php endif; ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>