<h4>Employees</h4>
<?php $employees = json_decode($content_index[$block->getCode()]->getEmployees()); ?>
<div id="employee_container">
<?php if(count($employees) > 0): ?>
<?php $pos = 1; ?>
<?php foreach($employees as $key => $value): ?>
<div id="employee_<?php echo $pos; ?>">
	<div class="control-group">
		<label class="control-label">Employee <?php echo $pos; ?> <i class="icon icon-remove remove-employee" data="<?php echo $pos; ?>"></i></label>
		<div class="controls">
			<input type="text" class="input-block-level" name="content&&&employees&&&<?php echo $block->getCode(); ?>&&&employees[<?php echo $pos; ?>][name]" id="name" value="<?php echo $value->name; ?>" placeholder="Name">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label"></label>
		<div class="controls">
			<input type="text" class="input-block-level" name="content&&&employees&&&<?php echo $block->getCode(); ?>&&&employees[<?php echo $pos; ?>][position]" id="position" value="<?php echo $value->position; ?>" placeholder="Position">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label"></label>
		<div class="controls">
			<textarea class="input-block-level" rows="5" name="content&&&employees&&&<?php echo $block->getCode(); ?>&&&employees[<?php echo $pos; ?>][bio]" id="bio" placeholder="Bio"><?php echo $value->bio; ?></textarea>
		</div>
	</div>
</div>
<?php $pos++; ?>
<?php endforeach; ?>
<input type="hidden" id="total_emplyees" value="<?php echo $pos-1; ?>"/>
<?php else: ?>
<div id="employee_1">
	<div class="control-group">
		<label class="control-label">Employee 1 <i class="icon icon-remove remove-employee" data="1"></i></label>
		<div class="controls">
			<input type="text" class="input-block-level" name="content&&&employees&&&<?php echo $block->getCode(); ?>&&&employees[1][name]" id="name" value="" placeholder="Name">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label"></label>
		<div class="controls">
			<input type="text" class="input-block-level" name="content&&&employees&&&<?php echo $block->getCode(); ?>&&&employees[1][position]" id="position" value="" placeholder="Position">
		</div>
	</div>
	<div class="control-group">
		<label class="control-label"></label>
		<div class="controls">
			<textarea class="input-block-level" rows="5" name="content&&&employees&&&<?php echo $block->getCode(); ?>&&&employees[1][bio]" id="bio" placeholder="Bio"></textarea>
		</div>
	</div>
</div>
<input type="hidden" id="total_emplyees" value="1"/>
<?php endif; ?>
</div>
<div class="control-group">
	<label class="control-label"></label>
	<div class="controls">
		<a href="#" id="add_employee">Add Additional Employee</a>
	</div>
</div>