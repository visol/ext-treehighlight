<?php

namespace Visol\Treehighlight\Backend\EventListener;


use TYPO3\CMS\Backend\Controller\Event\AfterPageTreeItemsPreparedEvent;
use TYPO3\CMS\Backend\Dto\Tree\Label\Label;
use TYPO3\CMS\Core\Attribute\AsEventListener;
use TYPO3\CMS\Core\Authentication\BackendUserAuthentication;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Localization\LanguageService;
use TYPO3\CMS\Core\Utility\GeneralUtility;

#[AsEventListener(
    identifier: 'treehighlight/backend/hilight-editable-pages',
)]
final readonly class HighlightPageTreeEditRightsEventListener
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

                    $item['labels'][] = new Label(
                        label: $labelTitle . ': ' . $labelGranted,
                        color: $this->getBackgroundColor(),
                        priority: 1
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
