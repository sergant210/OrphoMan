<?php
/** @var array $scriptProperties */
/** @var OrphoMan $OrphoManager */
if (!$OrphoMan = $modx->getService('orphoman', 'OrphoManager', $modx->getOption('orphoman_core_path', null, $modx->getOption('core_path') . 'components/orphoman/') . 'model/orphoman/', $scriptProperties)) {
	return 'Could not load OrphoMan class!';
}
$OrphoMan->initialize($modx->context->key);