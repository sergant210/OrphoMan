OrphoMan.window.Info = function (config) {
	config = config || {};
	if (!config.id) {
		config.id = 'orphoman-info-window';
	}
	Ext.applyIf(config, {
		title: _('orphoman_info'),
		width: 400,
		stateful: false,
		// autoHeight: true,
		// url: OrphoMan.config.connector_url,
		fields: this.getFields(config),
		keys: [{
			key: Ext.EventObject.ESC, fn: function () {
				this.hide();
			}, scope: this
		}],
		buttons: [{
			text: _('orphoman_close'),
			id: 'orphoman-window-close-btn',
			handler: function(){this.hide();},
			scope: this
		}]
	});
	OrphoMan.window.Info.superclass.constructor.call(this, config);
};
Ext.extend(OrphoMan.window.Info, MODx.Window, {

	getFields: function (config) {
		return [{
			xtype: 'hidden',
			name: 'id',
			id: config.id + '-id'
		}, {
			xtype: 'textfield',
			fieldLabel: _('orphoman_item_resource'),
			name: 'pagetitle',
			id: config.id + '-pagetitle',
			readOnly: true,
			anchor: '100%'
		}, {
			xtype: 'textfield',
			fieldLabel: _('orphoman_item_text'),
			name: 'text',
			id: config.id + '-text',
			readOnly: true,
			anchor: '100%'
		}, {
			xtype: 'textarea',
			fieldLabel: _('orphoman_item_comment'),
			name: 'comment',
			id: config.id + '-comment',
			readOnly: true,
			anchor: '100%',
			height: 100
		}, {
			xtype: 'textfield',
			fieldLabel: _('orphoman_item_ip'),
			name: 'ip',
			id: config.id + '-ip',
			readOnly: true,
			anchor: '100%'
		}, {
			xtype: 'textfield',
			fieldLabel: _('orphoman_item_createdon'),
			name: 'createdon',
			id: config.id + '-createdon',
			readOnly: true,
			anchor: '100%'
		}];
	}

});
Ext.reg('orphoman-info-window', OrphoMan.window.Info);