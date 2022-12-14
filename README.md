treehighlight for TYPO3 CMS
===========================

In big TYPO3 installations with many users that have access to several parts of the websites, using DB mounts for every part of the site a user has access to can be confusing for users. In this case it may be better to display all pages to the users (show permissions for everyone) but only grant rights to certain pages of the installation.

The main disadvantage is that the user doesn't know which pages he can edit. This extensions checks if a user is the owner of a page or has permission to a page because he is a member of the group assigned to the page. In this case, it adds a green square in front of the page title in the page tree.

The indicator is not displayed for admin users since they have access to all pages.

Beware a patch must be applied in TYPO3 v11

```
	"extra": {
		"patches": {
			"typo3/cms-backend": {
				"[FEATURE]: Add new event after tree item initialized": "typo3-cms-backend-add-after-tree-initialized-event.patch"
			}
		}
	},
```

## Compatibility and Maintenance

This package is currently maintained for the following versions:

| TYPO3 Version         | Package Version | Branch  | Maintained    |
|-----------------------|-----------------|---------|---------------|
| TYPO3 11.5.x          | 2.x             | master  | Yes           |
| TYPO3 8.7.x           | 1.1.x           | -       | No            |
