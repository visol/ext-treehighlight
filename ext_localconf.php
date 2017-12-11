<?php

if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

/* xclass for typolink page browser */
$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects']['TYPO3\CMS\Backend\Tree\Pagetree\PagetreeNode'] = [
	'className' => \Visol\Treehighlight\XClass\PagetreeNode::class
];
