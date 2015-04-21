<?php
/** @var array $scriptProperties */
/** @var OrphoMan $OrphoManager */
if (!$OrphoMan = $modx->getService('orphoman', 'OrphoManager', $modx->getOption('orphoman_core_path', null, $modx->getOption('core_path') . 'components/orphoman/') . 'model/orphoman/', $scriptProperties)) {
	return 'Could not load OrphoManager class!';
}

// Подключаем jGrowl. Если уже используется, то нужно закомментировать
$modx->regClientCSS($OrphoMan->config['cssUrl'].'jquery.jgrowl.css');
$modx->regClientScript($OrphoMan->config['jsUrl'].'jquery.jgrowl.min.js');

$OrphoMan->initialize($modx->context->key);