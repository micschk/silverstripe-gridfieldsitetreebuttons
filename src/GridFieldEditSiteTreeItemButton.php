<?php

namespace WeDevelop\SiteTreeButtons;

use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldEditButton;
use SilverStripe\ORM\DataObject;
use SilverStripe\View\ArrayData;
use SilverStripe\Control\Controller;
use SilverStripe\Control\Director;
use SilverStripe\View\SSViewer;


final class GridFieldEditSiteTreeItemButton extends GridFieldEditButton
{
    /**
     * @param GridField $gridField
     * @param SiteTree $record
     * @param string $columnName
     * @return \SilverStripe\ORM\FieldType\DBHTMLText|string|null
     */
    public function getColumnContent($gridField, $record, $columnName)
    {
        if (!$record->canEdit()) {
            return null;
        }

        $data = new ArrayData([
            'Link' => $record->CMSEditLink(),
            'ExtraClass' => $this->getExtraClass(),
        ]);

        $templates = SSViewer::get_templates_by_class($this);

        return $data->renderWith($templates);
    }
}
