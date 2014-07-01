<?php

if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

// The hook only allows to change the label which isn't flexible enough, therefore we don't use it for the moment
//$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['GLOBAL']['recStatInfoHooks']['treeHighlight'] = 'Visol\Treehighlight\Hooks\PageTreeHook->indicateWritePermissions';

/* xclass for typolink page browser */
$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects']['TYPO3\CMS\Backend\Tree\Pagetree\PagetreeNode'] = array(
	'className' => 'Visol\\Treehighlight\\XClass\\PagetreeNode',
);
