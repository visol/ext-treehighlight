<?php

namespace Visol\Treehighlight\Event\Listener;

use TYPO3\CMS\Backend\Controller\Event\AfterPageTreeItemsPreparedEvent;
use TYPO3\CMS\Backend\Dto\Tree\Label\Label;
use TYPO3\CMS\Backend\Dto\Tree\Status\StatusInformation;
use TYPO3\CMS\Core\Authentication\BackendUserAuthentication;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Localization\LanguageService;
use TYPO3\CMS\Core\Type\ContextualFeedbackSeverity;
use TYPO3\CMS\Core\Utility\GeneralUtility;

final class HighlightPageTreeEditRights
{
    public function __invoke(AfterPageTreeItemsPreparedEvent $event): void
    {
        $items = $event->getItems();
        foreach ($items as &$item) {
            // admin users don't need indication - they have access to all pages anyway
            if (!$this->getBackendUser()->isAdmin()) {

                $backendUserGroups = $this->getBackendUser()->userGroupsUID;

                if (in_array($item['_page']['perms_groupid'], $backendUserGroups) || (int) $item['_page']['perms_userid'] === $this->getBackendUser()->user['uid']) {
                    // user has access by group permissions or is the owner of the page
                    $labelTitle = $this->getLanguageService()->translateLabel(
                        input: 'LLL:EXT:beuser/Resources/Private/Language/locallang_mod_permission.xlf:mlang_labels_tablabel',
                        fallback: 'Edit Page Permissions'
                    );
                    $labelGranted = $this->getLanguageService()->translateLabel(
                        input: 'LLL:EXT:beuser/Resources/Private/Language/locallang_mod_permission.xlf:A_Granted',
                        fallback: 'Access granted'
                    );
                    // further styling and overrides by treehighlight/Resources/Public/Stylesheets/Backend/pageTree.css
                    $item['labels'][] = new Label(
                        label: $labelTitle . ': ' . $labelGranted,
                        color: '#188978',
                        priority: 1
                    );
                } else {
                    $labelTitle = $this->getLanguageService()->translateLabel(
                        input: 'LLL:EXT:beuser/Resources/Private/Language/locallang_mod_permission.xlf:mlang_labels_tablabel',
                        fallback: 'Edit Page Permissions'
                    );
                    $labelGranted = $this->getLanguageService()->translateLabel(
                        input: 'LLL:EXT:beuser/Resources/Private/Language/locallang_mod_permission.xlf:A_Denied',
                        fallback: 'Access denied'
                    );

                    $item['statusInformation'][] = new StatusInformation(
                        label: $labelTitle . ': ' . $labelGranted,
                        severity: ContextualFeedbackSeverity::WARNING,
                        priority: 0,
                        icon: 'actions-lock',
                        overlayIcon: '',
                    );
                }
            }
        }
        $event->setItems($items);
    }

    protected function getBackendUser(): BackendUserAuthentication
    {
        return $GLOBALS['BE_USER'];
    }

    protected function getBackgroundColor(): string
    {
        $extensionConfiguration = GeneralUtility::makeInstance(ExtensionConfiguration::class);
        return (string) $extensionConfiguration->get('treehighlight', 'backgroundColor');
    }

    protected function getLanguageService(): LanguageService
    {
        return $GLOBALS['LANG'];
    }
}
