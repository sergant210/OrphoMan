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