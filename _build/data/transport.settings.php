<?php

$settings = array();

$tmp = array(
	'highlight' => array(
		'xtype' => 'combo-boolean',
		'value' => true,
		'area' => 'orphoman.main',
	),
	'tpl' => array(
		'xtype' => 'textfield',
		'value' => '<span class="error_text">{text}</span>',
		'area' => 'orphoman.main',
	),
	'mail_to' => array(
		'xtype' => 'textfield',
		'value' => '',
		'area' => 'orphoman.main',
	),
	'email_subject' => array(
		'xtype' => 'textfield',
		'value' => 'На сайте обнаружена орфографическая ошибка',
		'area' => 'orphoman.main',
	),
	'email_body' => array(
		'xtype' => 'textfield',
		'value' => 'На странице <a href="{id}">{pagetitle}</a> найдена ошибка - "{error}".',
		'area' => 'orphoman.main',
	),
	'auto_delete' => array(
		'xtype' => 'combo-boolean',
		'value' => true,
		'area' => 'orphoman.main',
	),

);

foreach ($tmp as $k => $v) {
	/* @var modSystemSetting $setting */
	$setting = $modx->newObject('modSystemSetting');
	$setting->fromArray(array_merge(
		array(
			'key' => PKG_NAME_LOWER.'.'.$k,
			'namespace' => PKG_NAME_LOWER,
		), $v
	), '', true, true);

	$settings[] = $setting;
}

unset($tmp);
return $settings;
