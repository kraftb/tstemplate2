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
 * Renderer for unordered lists
 *
 * @author Bernhard Kraft <kraftb@think-open.at>
 * @author Steffen Kamper <steffen@typo3.org>
 * @author Steffen Ritter <info@steffen-ritter.net>
 */
class ExtJsJsonTreeRenderer extends \TYPO3\CMS\Backend\Tree\Renderer\ExtJsJsonTreeRenderer {

	/**
	 * Get node array
	 *
	 * @param \TYPO3\CMS\Backend\Tree\TreeRepresentationNode $node
	 * @return array
	 */
	protected function getNodeArray(\TYPO3\CMS\Backend\Tree\TreeRepresentationNode $node) {
		$nodeArray = array(
			'iconCls' => $node->getIcon(),
			'text' => $node->getLabel(),
			'leaf' => !$node->hasChildNodes(),
			'id' => $node->getId(),
			'uid' => $node->getId()
		);

		return $nodeArray;
	}

	/**
	 * Renders a node collection recursive or just a single instance
	 *
	 * @param \TYPO3\CMS\Backend\Tree\TreeNodeCollection $node
	 * @param bool $recursive
	 * @return string
	 */
	public function renderTree(\TYPO3\CMS\Backend\Tree\AbstractTree $tree, $recursive = TRUE) {
		$this->recursionLevel = 0;
		$renderedRootNode = $this->renderNode($tree->getRoot(), $recursive);
		// Do not return the root node itself.
		return $renderedRootNode['children'];
	}

}

