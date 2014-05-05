treehighlight for TYPO3 CMS
===========================

In big TYPO3 installations with many users that have access to several parts of the websites, using DB mounts for every part of the site a user has access to can be confusing for users. In this case it may be better to display all pages to the users (show permissions for everyone) but only grant rights to certain pages of the installation.

The main disadvantage is that the user doesn't know which pages he can edit. This extensions checks if a user is the owner of a page or has permission to a page because he is a member of the group assigned to the page. In this case, it adds a green square in front of the page title in the page tree.

The indicator is not displayed for admin users since they have access to all pages.

