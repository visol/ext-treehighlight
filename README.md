treehighlight for TYPO3 CMS
===========================

In large sites, using DB mounts for granting edit rights, can lead to a random number of detached and multiplied entries in the file tree, which can become quite confusing for editors, having access to many different tree sections. In such cases **displaying all pages to all users** (show permissions for everyone) and **only granting edit rights to selected pages** is a sleek solution.

To make those rights visible in the page tree, visol/treehighlight adds a colored label to all editable pages by `TYPO3\CMS\Backend\Dto\Tree\Label\Label` and, on pages without edit rights, a look icon by `TYPO3\CMS\Backend\Dto\Tree\Status\StatusInformation`.

The label and its parent are styled and overwritten by [Resources/Public/Stylesheets/Backend/pageTree.css](./Resources/Public/Stylesheets/Backend/pageTree.css).

#### Sidenotes

* The indicator is not visible for admin users
* The stylesheet overrides all labels having the inline style attribute `style="background-color:#188978"` set in HighlightPageTreeEditRights.

#### Known issues

* Since non editable pages may have editable subpages, the lock icon might be misleading at first glance. Feel free to submit a pull request to improve this.

#### Background information

https://docs.typo3.org/m/typo3/reference-coreapi/13.4/en-us/ApiOverview/Events/Events/Backend/AfterPageTreeItemsPreparedEvent.html


## Compatibility and Maintenance

Available versions:

| TYPO3 Version | Package Version | Branch | Maintained |
|---------------|-----------------|--------|------------|
| TYPO3 13.4.x  | 3.x             | master | Yes        |
| TYPO3 11.5.x  | 2.x             | -      | No         |
| TYPO3 8.7.x   | 1.1.x           | -      | No         |
