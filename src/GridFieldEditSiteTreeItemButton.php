<?php

namespace Restruct\Silverstripe\SiteTreeButtons;

use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldEditButton;
use SilverStripe\ORM\DataObject;
use SilverStripe\View\ArrayData;
use SilverStripe\Control\Controller;
use SilverStripe\Control\Director;
use SilverStripe\View\SSViewer;


class GridFieldEditSiteTreeItemButton
    extends GridFieldEditButton
{
    /**
     * @param GridField $gridField
     * @param DataObject $record
     * @param string $columnName
     * @return string The HTML for the column
     */
    public function getColumnContent($gridField, $record, $columnName)
    {
        // Permission checks are left to GridFieldDetailForm by GridFieldEditButton::getColumnContent
        // But, in this case we have no editform as we're linking to the CMS page section
        if (!$record->canEdit()) {
            return '';
        }

        $data = new ArrayData([
//            'Link' => Controller::join_links($gridField->Link('item'), $record->ID, 'edit'),
            'Link' => Controller::join_links(Director::baseURL(), '/admin/pages/edit/show/', $record->ID),
            'ExtraClass' => $this->getExtraClass()
        ]);

        $templates = SSViewer::get_templates_by_class($this);
        return $data->renderWith($templates);
    }
}