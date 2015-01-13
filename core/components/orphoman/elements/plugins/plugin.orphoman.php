<?php
switch ($modx->event->name) {
	case 'OnWebPagePrerender':
		$highlight = $modx->getOption('orphoman.highlight',null,1);
		if ($highlight && $modx->user->hasSessionContext('mgr')) {
			/*
			$modx->addPackage('orphoman',MODX_CORE_PATH.'components/orphoman/model/');
			*/
			if (!$OrphoMan = $modx->getService('orphoman', 'OrphoManager', $modx->getOption('orphoman_core_path', null, $modx->getOption('core_path') . 'components/orphoman/') . 'model/orphoman/')) {
				$modx->log(modx::LOG_LEVEL_ERROR, ' The plugin could not load OrphoMan class!');
			} else {
				$output = &$modx->resource->_output;
				$OrphoMan->highlight($output,$modx->resource->id);
			}
		}
		break;
}