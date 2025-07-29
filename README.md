treehighlight for TYPO3 CMS
===========================

In big TYPO3 installations with many users that have access to several parts of the websites, using DB mounts for every part of the site a user has access to can be confusing for users. In this case it may be better to display all pages to the users (show permissions for everyone) but only grant rights to certain pages of the installation.

The main disadvantage is that the user doesn't know which pages he can edit. This extensions checks if a user is the owner of a page or has permission to a page because he is a member of the group assigned to the page. In this case, it adds a green square in front of the page title in the page tree.

The indicator is not displayed for admin users since they have access to all pages.

The provide patch must be applied in you site package by adding the following to your main `composer.json` file:

```
	"extra": {
		"patches": {
			"typo3/cms-backend": {
				"[FEATURE]: Add edit right label to page tree": "vendor/visol/treehighlight/patches/typo3-cms-backend-add-after-tree-initialized-event.patch"
			}
		}
	},
```

For better visual distinction, the tree item parent is styled and overwritten by the additional stylesheet
[Resources/Public/Stylesheets/Backend/pageTree.css](./Resources/Public/Stylesheets/Backend/pageTree.css). Add `"visol/treehighlight": "*"` to the require block of your site package composer.json, to ensure the proper loading order.

```
	"require": {
		"visol/treehighlight": "*"
	},
	
```

> In theory, more labels could be added by other extensions. All added label titles are displayed in the tooltip of the item, but the color of the one with the highest priority will be used.

## Background information

https://docs.typo3.org/m/typo3/reference-coreapi/13.4/en-us/ApiOverview/Events/Events/Backend/AfterPageTreeItemsPreparedEvent.html



## Compatibility and Maintenance

This package is currently maintained for the following versions:

| TYPO3 Version | Package Version | Branch | Maintained |
|---------------|-----------------|--------|------------|
| TYPO3 13.4.x  | 3.x             | master | Yes        |
| TYPO3 11.5.x  | 2.x             | -      | No         |
| TYPO3 8.7.x   | 1.1.x           | -      | No         |
