<?php

if (empty($_POST['action'])) {
	die('Access denied');
}

if (!file_exists($_SERVER['DOCUMENT_ROOT'] . '/config.core.php')) {
    $response = json_encode(['success' => false, 'message' =>'Error of server initialization!']);
    die($response);
}
define('MODX_API_MODE', true);
// Boot up MODX
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.core.php';
require_once MODX_CORE_PATH . 'model/modx/modx.class.php';
$modx = new modX();
$modx->initialize('web');
$modx->getService('error','error.modError', '', '');

/* @var OrphoManager $OrphoMan */
$OrphoMan = $modx->getService('orphoman', 'OrphoManager', $modx->getOption('orphoman_core_path', null, $modx->getOption('core_path') . 'components/orphoman/') . 'service/');
if ($modx->error->hasError() || !($OrphoMan instanceof OrphoManager)) {
	die($modx->toJSON(array('success' => false, 'message' =>'Error of class init!')));
}

$response = array('success' => false, 'message' =>'');
switch ($_POST['action']) {
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