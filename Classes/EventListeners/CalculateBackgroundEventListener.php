<?php

namespace Visol\Treehighlight\EventListeners;


use TYPO3\CMS\Backend\Controller\Event\AfterTreeItemInitializedEvent;
use TYPO3\CMS\Core\Authentication\BackendUserAuthentication;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class CalculateBackgroundEventListener
{

    public function __invoke(AfterTreeItemInitializedEvent $event): void
    {

        // admin users don't need indication - they have access to all pages anyway
        if (!$this->getBackendUser()->isAdmin()) {
            $page = $event->getPage();
            $backendUserGroups = $this->getBackendUser()->userGroupsUID;

            if (in_array($page['perms_groupid'], $backendUserGroups) || (int)$page['perms_userid'] === $this->getBackendUser()->user['uid']) {
                // user has access by group permissions or is the owner of the page
                $item = $event->getItem();
                $item['backgroundColor'] = $this->getBackgroundColor();
                $event->setItem($item);
            }
        }
    }

    protected function getBackendUser(): BackendUserAuthentication
    {
        return $GLOBALS['BE_USER'];
    }

    protected function getBackgroundColor(): string
    {
        $extensionConfiguration = GeneralUtility::makeInstance(ExtensionConfiguration::class);
        return (string)$extensionConfiguration->get('treehighlight', 'backgroundColor');
    }
}
