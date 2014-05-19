<?php
/**
 * This component provides a button for opening the default add new form for SiteTree items (Pages).
 *
 * @package framework
 * @subpackage gridfield
 */
class GridFieldAddNewSiteTreeItemButton implements GridField_HTMLProvider {

	protected $targetFragment;

	protected $buttonName;

	public function setButtonName($name) {
		$this->buttonName = $name;
		return $this;
	}

	public function __construct($targetFragment = 'before') {
		$this->targetFragment = $targetFragment;
	}

	public function getHTMLFragments($gridField) {
		if(!$this->buttonName) {
			// provide a default button name, can be changed by calling {@link setButtonName()} on this component
			$objectName = singleton($gridField->getModelClass())->i18n_singular_name();
			$this->buttonName = _t('GridField.Add', 'Add {name}', array('name' => $objectName));
		}
		//http://localhost/askoschoenberg.nl/site/admin/pages/add/AddForm/?action_doAdd=1&ParentID=30&PageType=Page&SecurityID=b5de13b28bb75a91fec3901cf6ca4f48788e01da
		//http://localhost/askoschoenberg.nl/site/admin/pages/add/AddForm/?action_doAdd=1&ParentID=16&PageType=NewsArticle&SecurityID=b5de13b28bb75a91fec3901cf6ca4f48788e01da
		$ParentID = Controller::curr()->getRequest()->param('ID');
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
