Sitetree Buttons for GridField
==============================

Modifies GridFields & GridField detail forms to use standard page edit form (with versioning, history & settings).

Best used in combination with:
 * [silverstripe-excludechildren module to hide pages from the sitetree](https://github.com/micschk/silverstripe-excludechildren)

Or use/subclass the preconfigured GridfieldPages module, which contains both the excludechildren module and this sitetreebuttons module:
* [silverstripe-gridfieldpages](https://github.com/micschk/silverstripe-gridfieldpages)


## Screenshot
*Manage (add & edit) SiteTree items from a GridField:*
![](images/screenshots/holderscreen.png)

## Usage

In GridFieldConfig, replace 
	GridFieldAddNewButton('toolbar-header-right') 
with
	GridFieldAddNewSiteTreeItemButton('toolbar-header-right')
and 
	new GridFieldDetailForm() 
with 
	GridFieldEditSiteTreeItemButton()

Like this:

	$gfconf = GridFieldConfig_RecordEditor::create();
	$gfconf->removeComponentsByType('GridFieldAddNewButton');
	$gfconf->addComponent(new GridFieldAddNewSiteTreeItemButton('toolbar-header-right'));
	$gfconf->removeComponentsByType('GridFieldAddNewButton');
	$gfconf->addComponent(new GridFieldEditSiteTreeItemButton());

## Requirements
SilverStripe 3.0 or higher

## Pro tip

Use/subclass the prefabricated GridfieldPages module as a all-in-one base:
* [silverstripe-gridfieldpages](https://github.com/micschk/silverstripe-gridfieldpages)