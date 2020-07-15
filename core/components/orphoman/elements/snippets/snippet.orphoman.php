<?php
/** @var array $scriptProperties */
/** @var OrphoMan $OrphoManager */
if (!$OrphoMan = $modx->getService('orphoman', 'OrphoManager', $modx->getOption('orphoman_core_path', null, $modx->getOption('core_path') . 'components/orphoman/') . 'service/', $scriptProperties)) {
    return 'Could not load OrphoManager class!';
}
$OrphoMan->initialize($modx->context->key);