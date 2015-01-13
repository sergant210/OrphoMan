OrphoMan.page.Home = function (config) {
	config = config || {};
	Ext.applyIf(config, {
		components: [{
			xtype: 'orphoman-panel-home', renderTo: 'orphoman-panel-home-div'
		}]
	});
	OrphoMan.page.Home.superclass.constructor.call(this, config);
};
Ext.extend(OrphoMan.page.Home, MODx.Component);
Ext.reg('orphoman-page-home', OrphoMan.page.Home);