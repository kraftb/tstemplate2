<?php
namespace ThinkopenAt\Tstemplate2\Domain\Repository;

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
 * The repository for TyposcriptTemplates
 */
class TyposcriptTemplateRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	/**
	 * Initializes the repository by making some default settings
	 *
	 * @return void
	 */
	public function initializeObject() {
		$this->setDefaultOrderings(array(
			'sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING,
		));
	}

	/**
	 * Sets the storage page to use when retrieving domain models
	 *
	 * @param integer $storagePage: The page from which to retrieve domain models
	 * @return void
	 */
	public function setStoragePage($storagePage) {
		$querySettings = $this->createQuery()->getQuerySettings();
		$querySettings->setStoragePageIds(array($storagePage));
		$this->setDefaultQuerySettings($querySettings);
	}

	/**
	 * Finds the first template according to the current settings.
	 *
	 * @return \ThinkopenAt\Tstemplate2\Domain\Model\TyposcriptTemplate The first template found
	 */
	public function findFirst() {
		return $this->findAll()->getFirst();
	}
	
}

