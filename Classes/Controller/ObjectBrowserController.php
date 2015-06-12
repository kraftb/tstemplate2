<?php
namespace ThinkopenAt\Tstemplate2\Controller;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Tree\TableConfiguration\TreeDataProviderFactory;

/**
 * ObjectBrowser controller
 */
class ObjectBrowserController extends TsTemplateBaseController {

	/**
	 * The tree data provider instance
	 *
	 * @var ThinkopenAt\Tstemplate2\Tree\TyposcriptTreeDataProvider
	 * @inject
	 */
	protected $treeDataProvider = NULL;

	/**
	 * The tree renderer
	 *
	 * var \TYPO3\CMS\Backend\Tree\Renderer\UnorderedListTreeRenderer
	 * var \TYPO3\CMS\Backend\Tree\Renderer\ExtJsJsonTreeRenderer
	 *
	 * @var \ThinkopenAt\Tstemplate2\Tree\ExtJsJsonTreeRenderer
	 * @inject
	 */
	protected $treeRenderer = NULL;

	/**
	 * The tree instance itself
	 *
	 * @var \TYPO3\CMS\Core\Tree\TableConfiguration\TableConfigurationTree
	 * @inject
	 */
	protected $tree = NULL;
			
	/**
	 * Show the object browser
	 *
	 * @param \ThinkopenAt\Tstemplate2\Domain\Model\TyposcriptTemplate $currentTemplate: The currently shown template
	 * @return void
	 */
	public function viewAction(\ThinkopenAt\Tstemplate2\Domain\Model\TyposcriptTemplate $currentTemplate = NULL) {
		// This is needed in "getTreeData"
		if ($currentTemplate !== NULL) {
			$this->currentTemplate = $currentTemplate;
		}

		// Retrieve the tree data (TypoScript setup and/or constants) and
		// initialize javascript
		$pageRenderer = $GLOBALS['TBE_TEMPLATE']->getPageRenderer();
		$treeData = $this->getTreeData();
		$this->workOnPagerenderer($treeData);

		// Assign common view variables
		$this->assignCommon();
	}
	
	protected function getTreeData() {
		// Set up the tree data provider
		$this->treeDataProvider->parseTyposcript($this->currentTemplate, array('setup'));

		// Assign the treeDataProvider and treeRenderer to the tree instance
		$this->tree->setDataProvider($this->treeDataProvider);
		$this->tree->setNodeRenderer($this->treeRenderer);

		// Let the tree get rendered
		return json_encode($this->tree->render());
	}

	protected function workOnPagerenderer($treeData) {
		/** @var $pageRenderer \TYPO3\CMS\Core\Page\PageRenderer */
		$pageRenderer = $GLOBALS['TBE_TEMPLATE']->getPageRenderer();
//		$pageRenderer->addInlineLanguageLabelFile(ExtensionManagementUtility::extPath('lang') . 'locallang_csh_corebe.xlf', 'tcatree');
		$pageRenderer->loadExtJs();
		$pageRenderer->addJsFile('sysext/backend/Resources/Public/JavaScript/tree.js');

		$jsPath = ExtensionManagementUtility::extRelPath('tstemplate2') . 'Resources/Public/JavaScript/';
		$jsFile = $jsPath . 'TyposcriptTree.js';
		$pageRenderer->addJsFile($jsFile);

		$cssPath = ExtensionManagementUtility::extRelPath('tstemplate2') . 'Resources/Public/Css/';
		$cssFile = $cssPath . 'Tree.css';
		$pageRenderer->addCssFile($cssFile);

		$pageRenderer->addExtOnReadyCode('
			TYPO3.Components.Tree.StandardTreeItemData["TypoScriptObjectBrowser"] = ' . $treeData . ';
			initTyposcriptTree();
		');
	}

}

