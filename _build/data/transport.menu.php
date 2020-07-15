<?php

$menus = array();

$tmp = array(
	'orphoman' => array(
		'description' => 'orphoman_menu_desc',
		'action' => 'home',
	),
);

$i = 0;
foreach ($tmp as $k => $v) {
	/* @var modMenu $menu */
	$menu = $modx->newObject('modMenu');
	$menu->fromArray(array_merge(
		array(
			'text' => $k,
			'parent' => 'components',
            'namespace' => PKG_NAME_LOWER,
			'icon' => 'images/icons/plugin.gif',
			'menuindex' => 0,
			'params' => '',
			'handler' => '',
		), $v
	), '', true, true);

	$menus[] = $menu;
}

unset($menu);
return $menus;