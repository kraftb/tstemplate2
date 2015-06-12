<?php
namespace ThinkopenAt\Tstemplate2;

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
 * Iterator for iterating over TypoScript configuration arrays
 */
class ConfigurationIterator extends \FilterIterator {

	/**
	 * alreadyProcessed
	 *
	 * @var array
	 */
	protected $alreadyProcessed = array();

	/**
	 * plainKey
	 *
	 * @var mixed
	 */
	protected $plainKey = NULL;
	

	/*
	 * Constructor for an iterator used to iterate over the parts of a TypoScript array
	 *
	 * @param array $typoscriptConfig
	 * @return void
	 */
	public function __construct(array $typoscriptConfig) {
		parent::__construct(new \ArrayIterator($typoscriptConfig));
	}

	/*
	 * Rewinds this iterator.
	 *
	 * @return void
	 */
	public function rewind() {
		$this->alreadyProcessed = array();
		return parent::rewind();
	}

	/**
	 * Determines whether the current element is valid for the iterator
	 *
	 * @return boolean When TRUE gets returned the iterator stops at the current element
	 */
	public function accept() {
		$this->plainKey = rtrim(parent::key(), '.');
		if ($this->alreadyProcessed[$this->plainKey]) {
			return FALSE;
		}
		$this->alreadyProcessed[$this->plainKey] = TRUE;
		return TRUE;
	}

	/**
	 * Returns the key for the current position
	 *
	 * @return mixed The plain key for the current position
	 */
	public function key() {
		return $this->plainKey;
	}

	/**
	 * Returns the value for the current position
	 *
	 * @return mixed The plain key for the current position
	 */
	public function current() {
		$data = $this->getInnerIterator()->getArrayCopy();
		return array(
			'value' => isset($data[$this->plainKey]) ? $data[$this->plainKey] : NULL,
			'config' => is_array($data[$this->plainKey.'.']) ? $data[$this->plainKey.'.'] : NULL,
		);
	}

}

