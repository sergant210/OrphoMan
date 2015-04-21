var Selection = {
		initialize: function() {
			$(document).on('click touchend', '#cancel_btn', function(e) {
				dialog.close();
				e.preventDefault();
				return false;
			});
			$(document).on('submit', '#omConfirmDlgForm', function(e) {
				e.preventDefault();
				var comment=$('input[name=comment]').val();
				dialog.close();
				$.post(orphoConfig.actionUrl, {action: 'save', text: $('#error_text').text(), comment: comment,resource: orphoConfig.resource}, function(response) {
					if (response.success == false ) {
						Selection.message(response.message);
					}
				},'json');
			});
			$(document).ready(function() {
				// при нажатии на Ctrl + Enter
				$(document).on('keydown', function(e) {
					if (e.keyCode == 13 && e.ctrlKey){
						var text = Selection.getText();
						var message = '';
						if (text.length < orphoConfig.min) {
							message = 'Количество символов должно быть не менее '+orphoConfig.min +'!';
							Selection.message(message);
							return false;
						}
						if (text.length > orphoConfig.max) {
							message = 'Максимально допустимое количество символов '+orphoConfig.max +'!';
							Selection.message(message);
							return false;
						}
						// получаем и показываем выделенный текст
						Selection.confirm(text);
					} else if (e.keyCode == 27) {
						if ($('#orphoman_confirm_dlg').is(':visible')) {
							dialog.close();
						}
					}
				});
			});
		},
		getText : function() {
			var selected_text = '';
			if (selected_text = window.getSelection)
				selected_text = window.getSelection().toString();
			else
				selected_text = document.selection.createRange().text;
			return selected_text;
		},
		confirm : function (text) {
			$('#error_text').text(text);
			dialog.open();
		},
		message : function (message) {
			$.jGrowl(message, {theme: 'orphoman-message-info'});
		}
	},
	dialog = {
		open : function() {
			$('#orphoman_confirm_dlg').show();
			$('#orphoman-modal-backdrop').show();
		},
		close : function() {
			$('#orphoman_confirm_dlg').hide();
			$('#orphoman-modal-backdrop').hide();
			$('input[name=comment]').val('');
		}
	};

Selection.initialize();