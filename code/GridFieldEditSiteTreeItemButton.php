<?php

class GridFieldEditSiteTreeItemButton extends GridFieldEditButton {

	/**
	 *
	 * @param GridField $gridField
	 * @param DataObject $record
	 * @param string $columnName
	 * @return string - the HTML for the column 
	 */
	public function getColumnContent($gridField, $record, $columnName) {
		if (!$record->canEdit()) {
			return;
		}
		$data = new ArrayData(array(
			//'Link' => Controller::join_links($gridField->Link('item'), $record->ID, 'edit')
			//'Link' => "admin/pages/edit/show/$record->ID"
			'Link' => Controller::join_links(Director::baseURL(), '/admin/pages/edit/show/', $record->ID)
		));
		return $data->renderWith('GridFieldEditButton');
	}

}