<div class="top-row clearfix">
	<div class="column clearfix">
		<h5>Social Media Post Content:</h5>
		<textarea id="social_post_msg"></textarea>
		<?php foreach($authServices as $service => $auth): ?>
		<?php if($auth): ?>
		<span class="social-count <?= $service; ?>-count"><i class="icon icon-<?= $service; ?>-sign"></i><span id="<?= $service; ?>_count" class="count">#</span></span>
		<?php endif; ?>
		<?php endforeach; ?>
	</div>
	<div class="column clearfix">
		<h5>Available Social Platforms</h5>
		<?php foreach($authServices as $service => $auth): ?>
		<button data-service='<?= $service; ?>' class="social-toggle <?php echo $service.' '; echo (!$auth) ? 'no-auth' : 'checked'; ?>">
			<i class="icon icon-<?= $service; ?>-sign service-icon"></i>
			<i class="icon checker <?= ($auth) ? 'icon-check' : 'icon-check-empty' ?>" style="float:left"></i>
			<input type="hidden" class="checked-val-target" name="post-to-<?= $service ?>" value="<?= ($auth) ? 'true' : 'false' ?>" />
		</button>
		<?php endforeach;	?>
	</div>
</div>
<div class="scheduling-row">
	<ul class="scheduling-grid">
		<li><h5>Social Media Reminders</h5></li>
		<li class="editing-row">
			<ul>
				<li class="post-today" >
					<label for="post-today">
						<input type="checkbox" class="checkbox" id="post-today" name="post-today" checked style="margin-top: 0px;">
						<span>On publish of this event.</span>
					</label>
				</li>
			</ul>
		</li>
		<li class="schedule-actions">
			<button class="add-reminder btn"><i class="icon icon-plus"></i> Add Reminder</button>
			<button class="restore-defaults btn"><i class="icon icon-undo"></i> Restore Defaults</button>
		</li>
		<li class="summary-row">
			<div class="reminder-schedule-summary">
				<h5>Summary:</h5>
				<ul></ul>
			</div>
			<a class="edit-schedule btn" href="javascript:void(0)">Edit Reminder Schedule</a>
		</li>
	</ul>

	<!-- these are very important and will be cloned on the reg -->
	<ul class="defaults-2-clone" style="display: none;">
		<li class="schedule-input-group clone-me">
			<input type="number" class="text" value="" />
			<select>
				<option value="minutes">Minute(s) Before Event</option>
				<option value="hours">Hour(s) Before Event</option>
				<option value="days">Day(s) Before Event</option>
				<option value="weeks">Week(s) Before Event</option>
			</select>
			<a href="javascript:void(0)" class="remove-reminder"><i class="icon icon-remove"></i></a>
		</li>
	</ul>
</div>

<style>
	.hideSelect { display: none; }
</style>