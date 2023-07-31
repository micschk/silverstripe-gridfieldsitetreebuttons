Sitetree Buttons for GridField
==============================
Modifies GridFields & GridField detail forms to use standard page edit form (with versioning, history & settings).

## Requirements
* See `composer.json` requirements

## Installation
```
composer require wedevelopnl/silverstripe-gridfieldsitetreebuttons
```

After installation, run a `dev/build` with flush to complete the installation

## Usage
In `GridFieldConfig`, replace `GridFieldAddNewButton('toolbar-header-right')` with `GridFieldAddNewSiteTreeItemButton('toolbar-header-right')` and `new GridFieldDetailForm()` with `GridFieldEditSiteTreeItemButton()`

Example
```php
$gridFieldConfig = GridFieldConfig_RecordEditor::create();
$gridFieldConfig->removeComponentsByType(GridFieldAddNewButton::class);
$gridFieldConfig->addComponent(new GridFieldAddNewSiteTreeItemButton('toolbar-header-right'));
$gridFieldConfig->removeComponentsByType(GridFieldAddNewButton::class);
$gridFieldConfig->addComponent(new GridFieldEditSiteTreeItemButton());
```

## License
See [License](LICENSE)

## Maintainers
* [WeDevelop](https://www.wedevelop.nl/) <development@wedevelop.nl>

## Development and contribution
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.\
See read our [contributing](CONTRIBUTING.md) document for more information.

## Development and contribution
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.
See read our [contributing](CONTRIBUTING.md) document for more information.
