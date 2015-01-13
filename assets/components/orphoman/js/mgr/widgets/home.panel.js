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
			style: {margin: '15px 0'}
		}, {
			xtype: 'modx-tabs',
			defaults: {border: false, autoHeight: true},
			border: true,
			hideMode: 'offsets',
			items: [{
				title: _('orphoman_items'),
				layout: 'anchor',
				items: [{
					html: _('orphoman_intro_msg'),
					cls: 'panel-desc'
				}, {
					xtype: 'orphoman-grid-items',
					cls: 'main-wrapper'
				}]
			}]
		}]
	});
	OrphoMan.panel.Home.superclass.constructor.call(this, config);
};
Ext.extend(OrphoMan.panel.Home, MODx.Panel);
Ext.reg('orphoman-panel-home', OrphoMan.panel.Home);
