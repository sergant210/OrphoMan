var OrphoMan = function (config) {
	config = config || {};
	OrphoMan.superclass.constructor.call(this, config);
};
Ext.extend(OrphoMan, Ext.Component, {
	page: {}, window: {}, grid: {}, tree: {}, panel: {}, combo: {}, config: {}, view: {}, utils: {}
});
Ext.reg('orphoman', OrphoMan);

OrphoMan = new OrphoMan();