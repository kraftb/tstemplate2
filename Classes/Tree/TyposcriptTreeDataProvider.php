<?php
namespace ThinkopenAt\Tstemplate2\Tree;

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


/**
 * Data provider which can access the TypoScript tree for a passed template
 */
class TyposcriptTreeDataProvider extends \TYPO3\CMS\Backend\Tree\AbstractTreeDataProvider {

	/**
	 * The object manager instance
	 *
	 * @var \TYPO3\CMS\Extbase\Object\ObjectManager
	 * @inject
	 */
	protected $objectManager = NULL;

	/**
	 * The type of tree nodes
	 *
	 * @var string
	 */
	protected $nodeType = \ThinkopenAt\Tstemplate2\Tree\TyposcriptTreeNode::class;

	/**
	 * The extended template service instance which is used
	 * for retrieving the parsed TypoScript constants/setup
	 *
	 * @var \TYPO3\CMS\Core\TypoScript\ExtendedTemplateService
	 * @inject
	 */
	protected $templateService = NULL;

	/**
	 * The page repository. Required for fetching the rootline of the current page.
	 *
	 * @var \TYPO3\CMS\Frontend\Page\PageRepository
	 * @inject
	 */
	protected $pageRepository = NULL;

	/**
	 * Root Node
	 *
	 * @var \ThinkopenAt\Tstemplate2\Tree\TyposcriptTreeNode
	 * @inject
	 */
	protected $rootNode = NULL;

	/**
	 * Poor mans constructor
	 *
	 * @return void
	 */
	public function initializeObject() {
		// Do not log time-performance information
		$this->templateService->tt_track = FALSE;
		$this->templateService->init();
	}

	/**
	 * Parses the requested TypoScript data into an internal cache variable
	 *
	 * @param \ThinkopenAt\Tstemplate2\Domain\Model\TyposcriptTemplate $template: The template from which to load TypoScript
	 * @param array $type: Can contain the values "setup" and/or "constants"
	 * @return void
	 */
	public function parseTyposcript(\ThinkopenAt\Tstemplate2\Domain\Model\TyposcriptTemplate $template, array $type) {

		// Gets the rootLine
		$rootLine = $this->pageRepository->getRootLine($template->getPid());
		// This generates the constants/config + hierarchy info for the template.
		$this->templateService->runThroughTemplates($rootLine, $template->getUid());

//		$this->templateService->matchAlternative = $this->pObj->MOD_SETTINGS['tsbrowser_conditions'];
		$this->templateService->matchAlternative = array();
		$this->templateService->matchAlternative[] = str_repeat('dummy', 11);
		// This is just here to make sure that at least one element is in the array so that the tsparser actually uses this array to match.
		/*
			'ts_browser_const' => array(
				'0' => $lang->getLL('plainSubstitution'),
				'subst' => $lang->getLL('substitutedGreen'),
				'const' => $lang->getLL('unsubstitutedGreen')
			),
		$this->templateService->constantMode = $this->pObj->MOD_SETTINGS['ts_browser_const'];
		*/
		$this->templateService->constantMode = '0';

		/*
		if ($this->pObj->sObj && $templateService->constantMode) {
			$templateService->constantMode = 'untouched';
		}
		 */

//		$this->templateService->regexMode = $this->pObj->MOD_SETTINGS['ts_browser_regexsearch'];
		$this->templateService->regexMode = '';

//		$this->templateService->fixedLgd = $this->pObj->MOD_SETTINGS['ts_browser_fixedLgd'];
		$this->templateService->fixedLgd = 0;

		$this->templateService->linkObjects = TRUE;
		$this->templateService->ext_regLinenumbers = TRUE;

		$this->templateService->ext_regComments = 0;
		//		$this->templateService->ext_regComments = $this->pObj->MOD_SETTINGS['ts_browser_showComments'];

//		$this->templateService->bType = $bType; // or 'const'
		$this->templateService->bType = 'setup';

		/*
		// Break points
		if ($this->pObj->MOD_SETTINGS['ts_browser_type'] == 'const') {
			$templateService->ext_constants_BRP = (int)GeneralUtility::_GP('breakPointLN');
		} else {
			$templateService->ext_config_BRP = (int)GeneralUtility::_GP('breakPointLN');
		}
		 */

		$this->templateService->generateConfig();

/*
		if ($bType == 'setup') {
			$theSetup = $templateService->setup;
		} else {
			$theSetup = $templateService->setup_constants;
		}
 */

		$this->rootNode->setId('[ROOT]');
		$this->rootNode->setLabel('[ROOT]');
		if (is_array($this->templateService->setup)) {
			$this->convertTyposcriptArrayToTree($this->rootNode, $this->templateService->setup);
		}
	}

	/**
	 * Converts the passed TypoScript array to child nodes of the passed node
	 * and calls itself recursively for TypoScript sub elements.
	 *
	 * @param \ThinkopenAt\Tstemplate2\Tree\TyposcriptTreeNode $node
	 * @param array $typoscriptData Sub elements which should be set within the passed node.
	 * @return \TYPO3\CMS\Backend\Tree\TreeNodeCollection
	 */
	protected function convertTyposcriptArrayToTree(\ThinkopenAt\Tstemplate2\Tree\TyposcriptTreeNode $node, array $typoscriptData) {
		// Create a node collection and assign it to the current node.
		$nodeCollection = $this->objectManager->get(\TYPO3\CMS\Backend\Tree\TreeNodeCollection::class);
		$node->setChildNodes($nodeCollection);

		// Iterate over typoscript data
		$iterator = $this->objectManager->get(\ThinkopenAt\Tstemplate2\ConfigurationIterator::class, $typoscriptData);
		foreach ($iterator as $key => $data) {
			if (substr($key, -3) === '.ln') {
				continue;
			}

			// Create new child node ...
			$childNode = $this->objectManager->get($this->nodeType);

			// add it to the node collection ...
			$nodeCollection[] = $childNode;

			// and set parent and ID.
			$childNode->setParentNode($node);
			$childNode->setId($key);

			$label = '[' . $key . ']';

			// If there is a value (typoscriptLabel = value) then set it in the childNode
			if ($data['value'] !== NULL) {
				$label .= ' = <strong>' . $data['value'] . '</strong>';
			}
			$childNode->setLabel($label);

			// If there are any subelements (typoscriptLabel.subelement = subvalue) call
			// this method recursively
			if ($data['config'] !== NULL) {
				$this->convertTyposcriptArrayToTree($childNode, $data['config']);
			}
		}
	}

	/**
	 * Returns the root node
	 *
	 * @return \ThinkopenAt\Tstemplate2\Tree\TyposcriptTreeNode
	 */
	public function getRoot() {
		return $this->rootNode;
	}

	/**
	 * Fetches the subnodes of the given node
	 *
	 * @param \TYPO3\CMS\Backend\Tree\TreeNode $node
	 * @return \TYPO3\CMS\Backend\Tree\TreeNodeCollection
	 */
	public function getNodes(\TYPO3\CMS\Backend\Tree\TreeNode $node) {
		return $node->getChildNodes();
	}

}

