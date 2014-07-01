<?php
namespace Visol\Treehighlight\XClass;

/**
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
 * Node designated for the page tree
 *
 * @author Stefan Galinski <stefan.galinski@gmail.com>
 */
class PagetreeNode extends \TYPO3\CMS\Backend\Tree\Pagetree\PagetreeNode {

	/**
	 * Returns the node in an array representation that can be used for serialization
	 *
	 * @param boolean $addChildNodes
	 * @return array
	 */
	public function toArray($addChildNodes = TRUE) {
		$arrayRepresentation = parent::toArray();
		$arrayRepresentation['id'] = $this->calculateNodeId();
		$arrayRepresentation['realId'] = $this->getId();
		$arrayRepresentation['nodeData']['id'] = $this->getId();
		$arrayRepresentation['readableRootline'] = $this->getReadableRootline();
		$arrayRepresentation['nodeData']['readableRootline'] = $this->getReadableRootline();
		$arrayRepresentation['nodeData']['mountPoint'] = $this->getMountPoint();
		$arrayRepresentation['nodeData']['workspaceId'] = $this->getWorkspaceId();
		$arrayRepresentation['nodeData']['isMountPoint'] = $this->isMountPoint();
		$arrayRepresentation['nodeData']['backgroundColor'] = $this->calculateBackgroundColor();
		$arrayRepresentation['nodeData']['serializeClassName'] = get_class($this);
		return $arrayRepresentation;
	}

	/**
	 * Calculate background color from user permissions
	 *
	 * @return string
	 */
	public function calculateBackgroundColor() {

		/** @var \TYPO3\CMS\Core\Authentication\BackendUserAuthentication $backendUser */
		$backendUser = $GLOBALS['BE_USER'];

		if ($backendUser->isAdmin()) {
			// admin users don't need indication - they have access to all pages anyway
			return 'transparent';
		} else {
			//page = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord($parameters[0], $parameters[1]);
			$page = $this->getRecord();
			$backendUserGroups = $backendUser->userGroupsUID;
			if (in_array($page['perms_groupid'], $backendUserGroups) || (int)$page['perms_userid'] === $backendUser->user['uid']) {
				// user has access by group permissions or is the owner of the page
				return 'rgba(212,236,212,0.6)';
			} else {
				// no access
				return 'transparent';
			}
		}

	}

}
