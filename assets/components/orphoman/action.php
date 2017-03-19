<?php

if (empty($_POST['action'])) {
	die('Access denied');
}
else {
	$action = $_POST['action'];
}

define('MODX_API_MODE', true);
if (file_exists(dirname(dirname(dirname(dirname(__FILE__)))).'/index.php')) {
    /** @noinspection PhpIncludeInspection */
    require_once dirname(dirname(dirname(dirname(__FILE__)))).'/index.php';
}
else {
    require_once dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/index.php';
}

$modx->getService('error','error.modError');
$modx->getRequest();
$modx->setLogLevel(modX::LOG_LEVEL_ERROR);
$modx->setLogTarget('FILE');
$modx->error->message = null;

/* @var OrphoManager $OrphoMan */
$OrphoMan = $modx->getService('orphoman', 'OrphoManager', $modx->getOption('orphoman_core_path', null, $modx->getOption('core_path') . 'components/orphoman/') . 'model/orphoman/');
if ($modx->error->hasError() || !($OrphoMan instanceof OrphoManager)) {
	die($modx->toJSON(array('success' => false, 'message' =>'Error of class init!')));
}

$response = array('success' => false, 'message' =>'');
switch ($action) {
	case 'save': 
		if (!empty($_POST['text'])) {
			$response = $OrphoMan->saveError($_POST);
		}
		break;
	default:
		$response = $modx->toJSON(array('success' => false, 'message' => 'Request error!'));
}

if (is_array($response)) {
	$response = $modx->toJSON($response);
}

@session_write_close();
exit($response);