<div class="modal" id="orphoman_confirm_dlg" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Отправить сообщение об ошибке?</h4>
			</div>
			<form id="omConfirmDlgForm" role="form" action="post">
				<div class="modal-body">
					<div class="form-group">Ошибка: <span id="error_text"></span></div>
					<div class="form-group last">
						<label class="labelform">Комментарий (дополнительно)</label>
						<input class="form-control" type="text" id="comment" name="comment" title="Введите комментарий">
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-default" id="confirm_btn" form="omConfirmDlgForm">Отправить</button>
					<button type="button" class="btn btn-default" id="cancel_btn">Отмена</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal-backdrop"></div>