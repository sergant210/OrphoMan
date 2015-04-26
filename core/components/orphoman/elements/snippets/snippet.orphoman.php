<?php
/** @var array $scriptProperties */
/** @var OrphoMan $OrphoManager */
if (!$OrphoMan = $modx->getService('orphoman', 'OrphoManager', $modx->getOption('orphoman_core_path', null, $modx->getOption('core_path') . 'components/orphoman/') . 'model/orphoman/', $scriptProperties)) {
	return 'Could not load OrphoManager class!';
}
$OrphoMan->initialize($modx->context->key);

//Показываем кнопку //Show the button "Found a mistake"
$tpl = $modx->getChunk('orphoman.foundMistake.btn');
$modx->regClientHTMLBlock($tpl);
// Подключаем jGrowl. Если уже используется, то нужно закомментировать //Register jGrowl. if it's already registered comment it
$modx->regClientCSS($OrphoMan->config['cssUrl'].'jquery.jgrowl.css');
$modx->regClientScript($OrphoMan->config['jsUrl'].'jquery.jgrowl.min.js');
