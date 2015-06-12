<?php
defined('TYPO3_MODE') or die('Access denied.');

if (TYPO3_MODE === 'BE') {

	/**
	 * Registers the TS-Template2 backend module
	 */
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
		'ThinkopenAt.' . $_EXTKEY,
		'web', // Make module a submodule of 'user'
		'tstemplate2', // Submodule key
		'', // Position
		array(
			'ObjectBrowser' => 'view',
			'InfoModify' => 'view',
		),
		array(
			'access' => 'admin',
			'icon'   => 'EXT:' . $_EXTKEY . '/ext_icon.gif',
			'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_mod.xlf',
		)
	);

}

/*
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addExtJSModule(
	$_EXTKEY,
	'web',
	'tstemplate2',
	'',
	array(
		'access' => 'admin',
		'icon' => 'EXT:tstemplate2/Resources/Public/Images/Backend/TypoScriptTemplateModule.png',
		'labels' => 'LLL:EXT:tstemplate2/Resources/Private/Language/locallang_mod.xlf',
		'jsFiles' => array(
			'EXT:tstemplate2/Resources/Public/JavaScript/TypoScriptTemplateModule.js'
		)
	)
);
*/

