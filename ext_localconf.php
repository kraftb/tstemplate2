<?php
defined('TYPO3_MODE') or die('Access denied.');

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tstemplate2']['functions'] = array(
	'infoModify' => array(
		'label' => 'LLL:EXT:tstemplate2/Resources/Private/Language/locallang.xlf:infoModify',
		'extension' => 'tstemplate2',
		'controller' => 'InfoModify',
		'action' => 'view',
	),
	'objectBrowser' => array(
		'label' => 'LLL:EXT:tstemplate2/Resources/Private/Language/locallang.xlf:objectBrowser',
		'extension' => 'tstemplate2',
		'controller' => 'ObjectBrowser',
		'action' => 'view',
	)
);

