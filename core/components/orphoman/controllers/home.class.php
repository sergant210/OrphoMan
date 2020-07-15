<?php

/**
 * The home manager controller for OrphoMan.
 *
 */
class OrphoManHomeManagerController extends modExtraManagerController {
	/* @var OrphoMan $OrphoMan */
	public $OrphoMan;


    /**
     * @return array
     */
    public function getLanguageTopics() {
        return array('orphoman:default');
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
    public function initialize() {
        $corePath = $this->modx->getOption('orphoman_core_path', null, $this->modx->getOption('core_path') . 'components/orphoman/');
        require_once $corePath . 'service/orphomanager.class.php';

        $this->OrphoMan = new OrphoManager($this->modx);

        $this->addCss($this->OrphoMan->config['cssUrl'] . 'mgr/main.css');
        $this->addJavascript($this->OrphoMan->config['jsUrl'] . 'mgr/orphoman.js');
        $this->addHtml('<script>
		Ext.onReady(function() {
			OrphoMan.config = ' . $this->modx->toJSON($this->OrphoMan->config) . ';
			OrphoMan.config.connector_url = "' . $this->OrphoMan->config['connectorUrl'] . '";
		});
		</script>');

        parent::initialize();
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
		$this->addHtml('<script>
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