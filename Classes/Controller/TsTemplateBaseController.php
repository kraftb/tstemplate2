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


use \TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * TsTemplateBase controller
 */
abstract class TsTemplateBaseController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * The UID of the current page as passed to the
	 * backend module
	 *
	 * @var integer
	 */
	protected $currentPage = 0;

	/**
	 * The currently shown/edited template
	 *
	 * @var \ThinkopenAt\Tstemplate2\Domain\Model\TyposcriptTemplate
	 */
	protected $currentTemplate = NULL;

	/**
	 * The TypoScriptTemplate repository
	 * 
	 * @var \ThinkopenAt\Tstemplate2\Domain\Repository\TyposcriptTemplateRepository
	 * @inject
	 */
	protected $typoscriptTemplateRepository = NULL;


	public function initializeAction() {
		$this->currentPage = intval(GeneralUtility::_GP('id'));
		$this->typoscriptTemplateRepository->setStoragePage($this->currentPage);
		$this->currentTemplate = $this->typoscriptTemplateRepository->findFirst();
	}


	/**
	 * Assigns common TsTemplateController variables
	 *
	 * @return void
	 */
	public function assignCommon() {
		$this->view->assign('currentTemplate', $this->currentTemplate);
		$this->view->assign('availableTemplates', $this->typoscriptTemplateRepository->findAll());
		$this->view->assign('menu', $this->getMenu());
	}

	/**
	 * Generate the menu
	 *
	 * @return array Menu items
	 */
	protected function getMenu() {
		$menuItems = $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tstemplate2']['functions'];
		return $menuItems;
	}

}

