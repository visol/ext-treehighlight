<?php

if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['GLOBAL']['recStatInfoHooks']['treeHighlight'] = 'EXT:treehighlight/Classes/Hooks/PageTreeHook.php:Visol\TreeHighlight\Hooks\PageTreeHook->overrideBackgroundColor';
