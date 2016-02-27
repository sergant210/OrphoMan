<div class="orpho-modal" id="orphoman-confirm-dlg" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">[[%orphoman_dialog_title]]</h4>
			</div>
			<form id="omConfirmDlgForm" role="form" method="post">
				<div class="modal-body">
					<div class="form-group">[[%orphoman_dialog_mistake]] <span id="error-text"></span></div>
					<div class="form-group last">
						<label class="labelform">[[%orphoman_dialog_comment]]</label>
						<input class="form-control" type="text" id="comment" name="comment" title="[[%orphoman_dialog_comment_title]]">
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-default" id="confirm-btn" form="omConfirmDlgForm" title="Enter">[[%orphoman_dialog_send]]</button>
					<button type="button" class="btn btn-default" id="cancel-btn" title="Esc">[[%orphoman_dialog_cancel]]</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Inform button -->
<button id="inform-button" class="btn btn-primary">
	[[%orphoman_inform_about_mistake]]
</button>