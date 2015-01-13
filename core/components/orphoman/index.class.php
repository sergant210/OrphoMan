<?php
echo "Hello World!";
/**
 * Class OrphoManMainController
 */
abstract class OrphoManMainController extends modExtraManagerController {
	/** @var OrphoMan $OrphoMan */
	public $OrphoMan;


	/**
	 * @return void
	 */
	public function initialize() {
		$corePath = $this->modx->getOption('orphoman_core_path', null, $this->modx->getOption('core_path') . 'components/orphoman/');
		require_once $corePath . 'model/orphoman/orphomanager.class.php';

		$this->OrphoMan = new OrphoManager($this->modx);
		/*
		$path = $this->modx->getOption('orphoman_core_path', null, $this->modx->getOption('core_path') . 'components/orphoman/');
		$OrphoManClass = $this->modx->loadClass('OrphoMan', $path, true, false);

		$this->OrphoMan = new $OrphoManClass($this->modx);
		*/
		$this->addCss($this->OrphoMan->config['cssUrl'] . 'mgr/main.css');
		$this->addJavascript($this->OrphoMan->config['jsUrl'] . 'mgr/orphoman.js');
		//$this->addJavascript($this->OrphoMan->config['jsUrl'] . 'mgr/misc/utils.js');
		$this->addHtml('<script type="text/javascript">
		Ext.onReady(function() {
			OrphoMan.config = ' . $this->modx->toJSON($this->OrphoMan->config) . ';
			OrphoMan.config.connector_url = "' . $this->OrphoMan->config['connectorUrl'] . '";
		});
		</script>');

		parent::initialize();
	}


	/**
	 * @return array
	 */
	public function getLanguageTopics() {
		return array('orphoman:default');
	}


	/**
	 * @return bool
	 */
	public function checkPermissions() {
		return true;
	}
}


/**
 * Class IndexManagerController
 */
class IndexManagerController extends OrphoManMainController {

	/**
	 * @return string
	 */
	public static function getDefaultController() {
		return 'home';
	}
}