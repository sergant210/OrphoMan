<?php

$properties = array();

$tmp = array(
	'min' => array(
		'type' => 'numberfield',
		'value' => 5,
	),
	'max' => array(
		'type' => 'numberfield',
		'value' => 100,
	),
    'tpl' => array(
        'type' => 'textfield',
        'value' => 'orphoman.confirm.dlg',
    ),
    'tplButton' => array(
        'type' => 'textfield',
        'value' => 'orphoman.foundMistake.btn',
    ),
    'loadjGrowl' => array(
        'xtype' => 'combo-boolean',
        'value' => true,
    ),
);

foreach ($tmp as $k => $v) {
	$properties[] = array_merge(
		array(
			'name' => $k,
			'desc' => PKG_NAME_LOWER . '_prop_' . $k,
			'lexicon' => PKG_NAME_LOWER . ':properties',
		), $v
	);
}

return $properties;