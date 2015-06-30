<?php
/**
 * This component provides a button for opening the default add new form for SiteTree items (Pages).
 */
class GridFieldAddNewSiteTreeItemButton extends GridFieldAddNewButton {

	/** @var int */
	protected $parentID;


	/**
	 * Use the specified parent ID. If not set, default to the current page.
	 *
	 * TODO: Should probably perform a check to ensure that this is actually an instance of SiteTree and not some other random DataObject.
	 *
	 * @return int
	 */
	public function getParentID() {
		if (isset($this->parentID)) return $this->parentID;
		return Controller::curr()->getRequest()->param('ID');
	}


	/**
	 * Allow user to customize the parent page ID.
	 *
	 * @param	$parentID
	 * @return	$this
	 */
	public function setParentID($parentID) {
		$this->parentID = (int) $parentID;
		return $this;
	}


	public function getHTMLFragments($gridField) {
		
		if(!$this->buttonName) {
			// provide a default button name, can be changed by calling {@link setButtonName()} on this component
			$objectName = singleton($gridField->getModelClass())->i18n_singular_name();
			$this->buttonName = _t('GridField.Add', 'Add {name}', array('name' => $objectName));
		}
		
		$ParentID = $this->getParentID();

		$data = new ArrayData(array(
			//'NewLink' => Controller::join_links($gridField->Link('item'), 'new'),
			'NewLink' => Controller::join_links(Director::baseURL(),'/admin/pages/add/AddForm/', 
					'?action_doAdd=1&ParentID='.$ParentID.'&PageType='.
					$gridField->getModelClass().'&SecurityID='.$gridField->getForm()->getSecurityToken()->getValue()),
			'ButtonName' => $this->buttonName,
		));

		return array(
			$this->targetFragment => $data->renderWith('GridFieldAddNewbutton'),
		);
	}

}
