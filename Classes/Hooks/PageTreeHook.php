<?php
/**
 * @author	Lorenz Ulrich <lorenz.ulrich@visol.ch>
 * @package TYPO3
 */
namespace Visol\Treehighlight\Hooks;

class PageTreeHook {

	public function indicateWritePermissions($parameters, $fakeParentObject) {

		/** @var \TYPO3\CMS\Core\Authentication\BackendUserAuthentication $backendUser */
		$backendUser = $GLOBALS['BE_USER'];

		if ($backendUser->isAdmin()) {
			// admin users don't need indication - they have access to all pages anyway
			return '';
		} else {
			$page = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord($parameters[0], $parameters[1]);
			$backendUserGroups = $backendUser->userGroupsUID;
			if (in_array($page['perms_groupid'], $backendUserGroups) || (int)$page['perms_userid'] === $backendUser->user['uid']) {
				// user has access by group permissions or is the owner of the page
				return '<span title="Schreibberechtigung" style="float: left; display: inline-block; line-height: 12px; color: #009136;">■</span>';
			} else {
				// no access
				return '';
			}
		}

	}

}
?>
