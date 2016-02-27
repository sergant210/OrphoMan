var Selection = {
		text: '',
		dialogOpened: false,

		initialize: function() {
			$(document)
				.on('click touchend', '#cancel-btn', function(e) {
					dialog.close();
				})
				.on('click touchend', '#orphography-button', function(e) {
					$('#orphography-block').fadeToggle(300);
				})
				.on('mousedown touchend', '#inform-button', function(e) {
					$(this).hide();
					Selection.clear();
					Selection.confirm(Selection.text);
				})
				.on('submit', '#omConfirmDlgForm', function(e) {
					var comment=$('input[name=comment]').val();
					dialog.close();
					$.post(orphoConfig.actionUrl, {action: 'save', text: $('#error-text').text(), comment: comment,resource: orphoConfig.resource}, function(response) {
						if (response.message) {
							Selection.message(response.message);
						}
					},'json');
					e.preventDefault();
				})
				// touch screen
				.on('touchend', function(e) {
					if ($('#inform-button').is(':visible') && e.target.id != 'inform-button') {
						Selection.clear();
						Selection.text = '';
						$('#inform-button').hide();
					} else {
						var touch = e.originalEvent.touches[0] || e.originalEvent.changedTouches[0];
						Selection.run(touch, true);
						if (Selection.dialogOpened && e.target.id != 'confirm-btn' && e.target.id != 'comment') e.preventDefault();
					}
				})
				// press Ctrl + Enter
				.on('keydown', function(e) {
					if (e.keyCode == 13 && e.ctrlKey){
						$('#inform-button').hide();
						Selection.run(e, false);
					} else if (e.keyCode == 27) {
						if ($('#orphoman-confirm-dlg').is(':visible')) {
							dialog.close();
						}
					}
				});
		},
		run : function(e,touchEvent) {
			Selection.text = Selection.getText();
			if (!Selection.text) return false;
			var message = Selection.validate(Selection.text);
			if (message) {
				Selection.message(message);
				return false;
			}
			if (touchEvent) {
				$('#inform-button').show().css({"top": e.clientY - 15, "left": e.clientX + 20});
			} else {
				Selection.confirm(Selection.text);
			}
			Selection.dialogOpened = true;
		},
		getText : function() {
			var selected_text;
			if (selected_text = window.getSelection)
				selected_text = window.getSelection().toString();
			else
				selected_text = document.selection.createRange().text;
			return selected_text ? $.trim(selected_text) : '';
		},
		clear : function() {
			try {
				window.getSelection().removeAllRanges();
			} catch (e) {
				// для IE8-
				document.selection.empty();
			}
		},
		confirm : function (text) {
			$('#error-text').text(text);
			dialog.open();
		},
		message : function (message) {
			$.jGrowl(message, {theme: 'orphoman-message-info'});
		},
		validate : function (text) {
			var message = '';
			if (text.length < orphoConfig.min) {
				message = orphoConfig.messageMin+orphoConfig.min +'!';
			}
			if (text.length > orphoConfig.max) {
				message = orphoConfig.messageMax+orphoConfig.max +'!';
			}
			return message;
		}
	},
	dialog = {
		open : function() {
			$('#orphoman-confirm-dlg').fadeIn(300);
			$('<div id="orphoman-modal-backdrop"></div>').appendTo('body');
		},
		close : function() {
			$('#orphoman-confirm-dlg').fadeOut(200);
			$('#orphoman-modal-backdrop').remove();
			$('input[name=comment]').val('');
			Selection.clear();
			Selection.dialogOpened = false;
		}
	};

Selection.initialize();