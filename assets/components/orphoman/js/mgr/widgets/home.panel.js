OrphoMan.panel.Home = function (config) {
	config = config || {};
	Ext.apply(config, {
		baseCls: 'modx-formpanel',
		layout: 'anchor',
		/*
		 stateful: true,
		 stateId: 'orphoman-panel-home',
		 stateEvents: ['tabchange'],
		 getState:function() {return {activeTab:this.items.indexOf(this.getActiveTab())};},
		 */
		hideMode: 'offsets',
		items: [{
			html: '<h2>' + _('orphoman_desc') + '</h2>',
			cls: '',
			style: {margin: '15px 5px'}
		}, {
			xtype: 'modx-tabs',
			defaults: {border: false, autoHeight: true},
			border: true,
			hideMode: 'offsets',
			items: [{
				title: _('orphoman_items'),
				layout: 'anchor',
				items: [{
					html: _('orphoman_update_available'),
					cls: 'panel-desc',
					id: 'orphoman-update-available',
					style: {margin: '10px 15px 0',color:'red'},
					hidden: true
				}, {
					xtype: 'orphoman-grid-items',
					cls: 'main-wrapper'
				}]
			}]
		}],
		listeners: {
			render: function (p) {
				MODx.Ajax.request({
					url: OrphoMan.config.connector_url,
					params: {
						action: 'mgr/package/checkupdate'
					},
					listeners: {
						success: {
							fn: function (r) {
								Ext.getCmp('orphoman-update-available').show();
							}, scope: this
						}
					}
				});
			}
		}
	});
	OrphoMan.panel.Home.superclass.constructor.call(this, config);
};
Ext.extend(OrphoMan.panel.Home, MODx.Panel);
Ext.reg('orphoman-panel-home', OrphoMan.panel.Home);
