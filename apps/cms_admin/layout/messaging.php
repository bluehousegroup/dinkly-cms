<div id="message">
	<div class="alert alert-error" style="display:none;">
		<p class="bad-message"></p>
	</div>
	<div class="alert alert-success" style="display:none;">
		<p class="good-message"></p>
	</div>
</div>
<div id="modal-confirm-template" data-backdrop="static" class="modal hidden fade">
    <div class="modal-body confirm-message"></div>
    <div class="modal-footer">
        <a href="#" class="confirm-yes btn btn-danger">Yes</a>
        <a class="btn btn-secondary confirm-no" href="javascript:$('#modal-confirm').modal('hide')">No</a>
    </div>
    <input type="hidden" class="callback">
    <input type="hidden" class="target-id">
</div>