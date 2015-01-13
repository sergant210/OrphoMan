OrphoMan.grid.Items = function (config) {
	config = config || {};
	if (!config.id) {
		config.id = 'orphoman-grid-items';
	}
	Ext.applyIf(config, {
		url: OrphoMan.config.connector_url,
		fields: this.getFields(config),
		columns: this.getColumns(config),
		//tbar: this.getTopBar(config),
		sm: new Ext.grid.CheckboxSelectionModel(),
		baseParams: {
			action: 'mgr/item/getlist'
		},
		listeners: {
		},
		viewConfig: {
			forceFit: true,
			enableRowBody: true,
			autoFill: true,
			showPreview: true,
			scrollOffset: 0,
			getRowClass: function (rec, ri, p) {
				return !rec.data.active
					? 'orphoman-row-disabled'
					: '';
			}
		},
		paging: true,
		remoteSort: true,
		autoHeight: true
	});
	OrphoMan.grid.Items.superclass.constructor.call(this, config);

	// Clear selection on grid refresh
	this.store.on('load', function () {
		if (this._getSelectedIds().length) {
			this.getSelectionModel().clearSelections();
		}
	}, this);
};
Ext.extend(OrphoMan.grid.Items, MODx.grid.Grid, {
	windows: {},

	getMenu: function (grid, rowIndex) {
		var ids = this._getSelectedIds();

		var row = grid.getStore().getAt(rowIndex);
		var menu = OrphoMan.utils.getMenu(row.data['actions'], this, ids);

		this.addContextMenuItem(menu);
	},

	createItem: function (btn, e) {
		var w = MODx.load({
			xtype: 'orphoman-item-window-create',
			id: Ext.id(),
			listeners: {
				success: {
					fn: function () {
						this.refresh();
					}, scope: this
				}
			}
		});
		w.reset();
		w.setValues({active: true});
		w.show(e.target);
	},

	removeItem: function (act, btn, e) {
		var ids = this._getSelectedIds();
		if (!ids.length) {
			return false;
		}
		MODx.msg.confirm({
			title: ids.length > 1
				? _('orphoman_items_remove')
				: _('orphoman_item_remove'),
			text: ids.length > 1
				? _('orphoman_items_remove_confirm')
				: _('orphoman_item_remove_confirm'),
			url: this.config.url,
			params: {
				action: 'mgr/item/remove',
				ids: Ext.util.JSON.encode(ids)
			},
			listeners: {
				success: {
					fn: function (r) {
						this.refresh();
					}, scope: this
				}
			}
		});
		return true;
	},

	getFields: function (config) {
		return ['id', 'resource_id', 'text', 'ip', 'createdon', 'comment','actions'];
	},

	getColumns: function (config) {
		return [{
			header: _('orphoman_item_resource_id'),
			dataIndex: 'resource_id',
			sortable: true,
			width: 50
		}, {
			header: _('orphoman_item_text'),
			dataIndex: 'text',
			sortable: false,
			width: 200
		}, {
			header: _('orphoman_item_comment'),
			dataIndex: 'comment',
			sortable: false,
			width: 250
		}, {

			header: _('orphoman_item_ip'),
			dataIndex: 'ip',
			sortable: false,
			width: 100
		}, {

			header: _('orphoman_item_createdon'),
			dataIndex: 'createdon',
			sortable: true,
			width: 100
		}, {
			header: _('orphoman_grid_actions'),
			dataIndex: 'actions',
			renderer: OrphoMan.utils.renderActions,
			sortable: false,
			width: 50,
			id: 'actions'
		}];
	},

	getTopBar: function (config) {
		return [{
			text: '<i class="icon icon-plus">&nbsp;' + _('orphoman_item_create'),
			handler: this.createItem,
			scope: this
		}, '->', {
			xtype: 'textfield',
			name: 'query',
			width: 200,
			id: config.id + '-search-field',
			emptyText: _('orphoman_grid_search'),
			listeners: {
				render: {
					fn: function (tf) {
						tf.getEl().addKeyListener(Ext.EventObject.ENTER, function () {
							this._doSearch(tf);
						}, this);
					}, scope: this
				}
			}
		}, {
			xtype: 'button',
			id: config.id + '-search-clear',
			text: '<i class="icon icon-times"></i>',
			listeners: {
				click: {fn: this._clearSearch, scope: this}
			}
		}];
	},

	onClick: function (e) {
		var elem = e.getTarget();
		if (elem.nodeName == 'BUTTON') {
			var row = this.getSelectionModel().getSelected();
			if (typeof(row) != 'undefined') {
				var action = elem.getAttribute('action');
				if (action == 'showMenu') {
					var ri = this.getStore().find('id', row.id);
					return this._showMenu(this, ri, e);
				}
				else if (typeof this[action] === 'function') {
					this.menu.record = row.data;
					return this[action](this, e);
				}
			}
		}
		return this.processEvent('click', e);
	},

	_getSelectedIds: function () {
		var ids = [];
		var selected = this.getSelectionModel().getSelections();

		for (var i in selected) {
			if (!selected.hasOwnProperty(i)) {
				continue;
			}
			ids.push(selected[i]['id']);
		}

		return ids;
	},

	_doSearch: function (tf, nv, ov) {
		this.getStore().baseParams.query = tf.getValue();
		this.getBottomToolbar().changePage(1);
		this.refresh();
	},

	_clearSearch: function (btn, e) {
		this.getStore().baseParams.query = '';
		Ext.getCmp(this.config.id + '-search-field').setValue('');
		this.getBottomToolbar().changePage(1);
		this.refresh();
	}
});
Ext.reg('orphoman-grid-items', OrphoMan.grid.Items);