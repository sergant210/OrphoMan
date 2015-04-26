var Selection = {
		initialize: function() {
			$(document)
				.on('click touchend', '#cancel-btn', function(e) {
					dialog.close();
					e.preventDefault();
				})
				.on('click touchend', '#orphography-button', function(e) {
					$('#orphography-block').fadeToggle(300);
					e.preventDefault();
				});
			$(document).on('submit', '#omConfirmDlgForm', function(e) {
				e.preventDefault();
				var comment=$('input[name=comment]').val();
				dialog.close();
				$.post(orphoConfig.actionUrl, {action: 'save', text: $('#error-text').text(), comment: comment,resource: orphoConfig.resource}, function(response) {
					if (response.success == false ) {
						Selection.message(response.message);
					}
				},'json');
			});
			$(document).ready(function() {
				// press Ctrl + Enter
				$(document).on('keydown', function(e) {
					if (e.keyCode == 13 && e.ctrlKey){
						var text = Selection.getText();
						var message = '';
						if (text.length < orphoConfig.min) {
							message = orphoConfig.messageMin+orphoConfig.min +'!';
							Selection.message(message);
							return false;
						}
						if (text.length > orphoConfig.max) {
							message = orphoConfig.messageMax+orphoConfig.max +'!';
							Selection.message(message);
							return false;
						}
						// получаем и показываем выделенный текст
						Selection.confirm(text);
					} else if (e.keyCode == 13) {
						if ($('#orphoman-confirm-dlg').is(':visible')) {
							$('#omConfirmDlgForm').trigger('submit');
						}

					} else if (e.keyCode == 27) {
						if ($('#orphoman-confirm-dlg').is(':visible')) {
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
			$('#error-text').text(text);
			dialog.open();
		},
		message : function (message) {
			$.jGrowl(message, {theme: 'orphoman-message-info'});
		}
	},
	dialog = {
		open : function() {
			$('#orphoman-confirm-dlg').show();
			$('<div id="orphoman-modal-backdrop"></div>').appendTo('body');
		},
		close : function() {
			$('#orphoman-confirm-dlg').hide();
			$('#orphoman-modal-backdrop').remove();
			$('input[name=comment]').val('');
		}
	};

Selection.initialize();