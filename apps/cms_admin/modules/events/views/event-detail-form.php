<div class="control-group">
	<label class="control-label">Title</label>
	<div class="controls">
		<input type="text" class="input-block-level" name="title" id="title" placeholder="Title" value="<?= ($event) ? $event->getTitle() : "" ?>" />
	</div>
</div>
<div class="control-group">
	<div class="column-left">
		<label class="control-label">Start Date</label>
		<div class="controls">
			<div class="input-append">
				<input type="text" class="input-block-level date-field" data-date="Y-m-d G:i" name="start_date" id="start_date" placeholder="mm/dd/yyyy" value="<?= ($event && $event->getStartDatetime() != "") ? Date('m/d/Y', strtotime($event->getStartDatetime())) : "" ?>">
				<span class="add-on"><i class="icon icon-calendar"></i></span>
			</div>
		</div>
	</div>
	<div class="column-right">
		<label class="control-label">Time</label>
		<div class="controls">
			<div class="input-append bootstrap-timepicker">
				<input type="text" class="input-block-level time-field" data-date="Y-m-d G:i" name="start_time" id="start_time" placeholder="hh:mm" value="<?= ($event && $event->getStartDatetime() != "") ? Date('G:i', strtotime($event->getStartDatetime())) : "" ?>">
				<span class="add-on"><i class="icon icon-time"></i></span>
			</div>
		</div>
	</div>
</div>
<div class="control-group">
	<div class="column-left">
		<label class="control-label">End Date</label>
		<div class="controls">
			<div class="input-append">
				<input type="text" class="input-block-level datepicker" data-date="Y-m-d G:i" name="end_date" id="end_date" placeholder="mm/dd/yyyy" value="<?= ($event && $event->getEndDatetime() != "") ? Date('m/d/Y', strtotime($event->getEndDatetime())) : "" ?>">
				<span class="add-on"><i class="icon icon-calendar"></i></span>
			</div>
		</div>
	</div>
	<div class="column-right">
		<label class="control-label">Time</label>
		<div class="controls">
			<div class="input-append bootstrap-timepicker">
				<input type="text" class="input-block-level timepicker"  name="end_time" id="end_time" placeholder="hh:mm" value="<?= ($event && $event->getEndDatetime() != "") ? Date('G:i', strtotime($event->getEndDatetime())) : "" ?>">
				<span class="add-on"><i class="icon icon-time"></i></span>
			</div>
		</div>
	</div>
</div>
<div class="control-group">
	<label class="control-label">Recurring</label>
	<div class="controls">
		<input type="checkbox" class="input-block-level" name="enable_repeating" id="enable_repeating">
		<select class='repeating_type' id='repeating_type' style='display:none;'>
			<option value="Daily">Daily</option>
			<option value="Weekly">Weekly</option>
			<option value="Monthly">Monthly</option>
			<option value="Yearly">Yearly</option>
			<option value="Specific">Specific Days</option>
		</select>
		<div class="repeating_days" id="repeating_days" style="display:none;">
			<input type="checkbox" class="input-block-level" name="monday" id="monday">Mon
			<input type="checkbox" class="input-block-level" name="tuesday" id="tuesday">Tue
			<input type="checkbox" class="input-block-level" name="wednesday" id="wednesday">Wed
			<input type="checkbox" class="input-block-level" name="thursday" id="thursday">Thu
			<input type="checkbox" class="input-block-level" name="friday" id="friday">Fri
			<input type="checkbox" class="input-block-level" name="saturday" id="saturday">Sat
			<input type="checkbox" class="input-block-level" name="sunday" id="sunday">Sun

		</div>
		<input type="hidden" name="repeating" id="repeating" value='<?= ($event) ? $event->getRepeating() : "" ?>' />
	</div>
</div>
<div class="control-group">
	<label class="control-label">Location</label>
	<div class="controls">
		<input type="text" class="input-block-level" name="location" id="location" placeholder="Location" value='<?= ($event) ? $event->getLocation() : "" ?>'>
	</div>
</div>
<div class="control-group wysiwyg">
	<label class="control-label">Description</label>
	<div class="controls">
		<textarea class="ckeditor" name="event_description" id="event_description"><?= ($event) ? $event->getDescription() : "" ?></textarea>
	</div>
</div>
