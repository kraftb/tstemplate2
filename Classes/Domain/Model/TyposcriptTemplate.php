<?php
namespace ThinkopenAt\Tstemplate2\Domain\Model;

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
 * TyposcriptTemplate
 */
class TyposcriptTemplate extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * The title of a TypoScript template
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $title = '';

	/**
	 * The site title of a TypoScript template
	 *
	 * @var string
	 */
	protected $sitetitle = '';

	/**
	 * Whether this is a root template
	 *
	 * @var boolean
	 */
	protected $root = FALSE;

	/**
	 * Whether to clear constants/config of parent templates
	 *
	 * @var integer
	 * @validate Integer, NumberRange(minimum = 0, maximum = 3)
	 */
	protected $clear = 0;

	/**
	 * A comma separated list of static templates being included
	 *
	 * @var string
	 */
	protected $includeStaticFile = '';

	/**
	 * TypoScript constants field
	 *
	 * @var string
	 */
	protected $constants = '';

	/**
	 * TypoScript setup field
	 *
	 * @var string
	 */
	protected $setup = '';

	/**
	 * A description for the TypoScript template
	 *
	 * @var string
	 */
	protected $description = '';

	/**
	 * includeStaticAfterBasedOn
	 *
	 * @var boolean
	 */
	protected $includeStaticAfterBasedOn = FALSE;

	/**
	 * A value in the range of 0-3 defining when static templates from
	 * extensions (includeStaticFile) should get included in relation
	 * to this template.
	 *
	 * @var integer
	 * @validate Integer, NumberRange(minimum = 0, maximum = 5)
	 */
	protected $staticFileMode = 0;

	/**
	 * The TypoScript template which will be used instead of this
	 * one for pages on the next tree level.
	 *
	 * @var \ThinkopenAt\Tstemplate2\Domain\Model\TyposcriptTemplate
	 */
	protected $nextLevel = NULL;

	/**
	 * The basis templates for this TypoScript template
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ThinkopenAt\Tstemplate3\Domain\Model\TyposcriptTemplate>
	 */
	protected $basedOn = NULL;

	/**
	 * Returns the title
	 *
	 * @return string $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Sets the title
	 *
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Returns the sitetitle
	 *
	 * @return string $sitetitle
	 */
	public function getSitetitle() {
		return $this->sitetitle;
	}

	/**
	 * Sets the sitetitle
	 *
	 * @param string $sitetitle
	 * @return void
	 */
	public function setSitetitle($sitetitle) {
		$this->sitetitle = $sitetitle;
	}

	/**
	 * Returns the root
	 *
	 * @return boolean $root
	 */
	public function getRoot() {
		return $this->root;
	}

	/**
	 * Sets the root
	 *
	 * @param boolean $root
	 * @return void
	 */
	public function setRoot($root) {
		$this->root = $root;
	}

	/**
	 * Returns the boolean state of root
	 *
	 * @return boolean
	 */
	public function isRoot() {
		return $this->root;
	}

	/**
	 * Returns the clear
	 *
	 * @return integer $clear
	 */
	public function getClear() {
		return $this->clear;
	}

	/**
	 * Sets the clear
	 *
	 * @param integer $clear
	 * @return void
	 */
	public function setClear($clear) {
		$this->clear = $clear;
	}

	/**
	 * Returns the includeStaticFile
	 *
	 * @return string $includeStaticFile
	 */
	public function getIncludeStaticFile() {
		return $this->includeStaticFile;
	}

	/**
	 * Sets the includeStaticFile
	 *
	 * @param string $includeStaticFile
	 * @return void
	 */
	public function setIncludeStaticFile($includeStaticFile) {
		$this->includeStaticFile = $includeStaticFile;
	}

	/**
	 * Returns the constants
	 *
	 * @return string $constants
	 */
	public function getConstants() {
		return $this->constants;
	}

	/**
	 * Sets the constants
	 *
	 * @param string $constants
	 * @return void
	 */
	public function setConstants($constants) {
		$this->constants = $constants;
	}

	/**
	 * Returns the config
	 *
	 * @return string $config
	 */
	public function getConfig() {
		return $this->config;
	}

	/**
	 * Sets the config
	 *
	 * @param string $config
	 * @return void
	 */
	public function setConfig($config) {
		$this->config = $config;
	}

	/**
	 * Returns the description
	 *
	 * @return string $description
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Sets the description
	 *
	 * @param string $description
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * Returns the includeStaticAfterBasedOn
	 *
	 * @return string $includeStaticAfterBasedOn
	 */
	public function getIncludeStaticAfterBasedOn() {
		return $this->includeStaticAfterBasedOn;
	}

	/**
	 * Sets the includeStaticAfterBasedOn
	 *
	 * @param string $includeStaticAfterBasedOn
	 * @return void
	 */
	public function setIncludeStaticAfterBasedOn($includeStaticAfterBasedOn) {
		$this->includeStaticAfterBasedOn = $includeStaticAfterBasedOn;
	}

	/**
	 * Returns the staticFileMode
	 *
	 * @return integer $staticFileMode
	 */
	public function getStaticFileMode() {
		return $this->staticFileMode;
	}

	/**
	 * Sets the staticFileMode
	 *
	 * @param integer $staticFileMode
	 * @return void
	 */
	public function setStaticFileMode($staticFileMode) {
		$this->staticFileMode = $staticFileMode;
	}

	/**
	 * Returns the nextLevel
	 *
	 * @return \ThinkopenAt\Tstemplate3\Domain\Model\TyposcriptTemplate $nextLevel
	 */
	public function getNextLevel() {
		return $this->nextLevel;
	}

	/**
	 * Sets the nextLevel
	 *
	 * @param \ThinkopenAt\Tstemplate3\Domain\Model\TyposcriptTemplate $nextLevel
	 * @return void
	 */
	public function setNextLevel(\ThinkopenAt\Tstemplate3\Domain\Model\TyposcriptTemplate $nextLevel) {
		$this->nextLevel = $nextLevel;
	}

	/**
	 * Returns the basedOn
	 *
	 * @return \ThinkopenAt\Tstemplate3\Domain\Model\TyposcriptTemplate $basedOn
	 */
	public function getBasedOn() {
		return $this->basedOn;
	}

	/**
	 * Sets the basedOn
	 *
	 * @param \ThinkopenAt\Tstemplate3\Domain\Model\TyposcriptTemplate $basedOn
	 * @return void
	 */
	public function setBasedOn(\ThinkopenAt\Tstemplate3\Domain\Model\TyposcriptTemplate $basedOn) {
		$this->basedOn = $basedOn;
	}

}
