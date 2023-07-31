<?php

namespace WeDevelop\SiteTreeButtons;

use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldAddNewButton;
use SilverStripe\Control\Controller;
use SilverStripe\View\ArrayData;
use SilverStripe\Control\Director;
use SilverStripe\View\SSViewer;

class GridFieldAddNewSiteTreeItemButton extends GridFieldAddNewButton
{
	protected int $parentID;

    public function __construct(string $targetFragment = 'buttons-before-left')
    {
        parent::__construct($targetFragment);
    }

	public function getParentID(): int
    {
		if (isset($this->parentID) && $this->parentID instanceof SiteTree) {
            return $this->parentID;
        }

		return Controller::curr()->getRequest()->param('ID');
	}

	public function setParentID(int $parentID): self
    {
		$this->parentID = $parentID;
		return $this;
	}

    /**
     * @param GridField $gridField
     * @return array
     */
	public function getHTMLFragments($gridField)
    {
		if(!$this->buttonName) {
			$objectName = singleton($gridField->getModelClass())->i18n_singular_name();
			$this->buttonName = _t('GridField.Add', 'Add {name}', array('name' => $objectName));
		}

		$data = new ArrayData([
            'NewLink' => sprintf("admin/pages/add/AddForm/?action_doAdd=1&ParentID=%u&PageType=%s&SecurityID=%s", $this->getParentID(), str_replace('/','\'', $gridField->getModelClass()), $gridField->getForm()->getSecurityToken()->getValue()),
			'ButtonName' => $this->buttonName,
        ]);


        $templates = SSViewer::get_templates_by_class($this);

		return [
            $this->targetFragment => $data->renderWith($templates)
        ];
	}

}
