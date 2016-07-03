<?php

/**
 * The home manager controller for OrphoMan.
 *
 */
class OrphoManHomeManagerController extends OrphoManMainController {
	/* @var OrphoMan $OrphoMan */
	public $OrphoMan;


	/**
	 * @param array $scriptProperties
	 */
	public function process(array $scriptProperties = array()) {
	}


	/**
	 * @return null|string
	 */
	public function getPageTitle() {
		return $this->modx->lexicon('orphoman');
	}


	/**
	 * @return void
	 */
	public function loadCustomCssJs() {
		$this->addJavascript($this->OrphoMan->config['jsUrl'] . 'mgr/misc/utils.js');
		$this->addJavascript($this->OrphoMan->config['jsUrl'] . 'mgr/widgets/items.grid.js');
		$this->addJavascript($this->OrphoMan->config['jsUrl'] . 'mgr/widgets/items.windows.js');
		$this->addJavascript($this->OrphoMan->config['jsUrl'] . 'mgr/widgets/home.panel.js');
		$this->addJavascript($this->OrphoMan->config['jsUrl'] . 'mgr/sections/home.js');
		$this->addHtml('<script type="text/javascript">
		Ext.onReady(function() {
			MODx.load({ xtype: "orphoman-page-home"});
		});
		</script>');
	}


	/**
	 * @return string
	 */
	public function getTemplateFile() {
		return $this->OrphoMan->config['templatesPath'] . 'home.tpl';
	}
}